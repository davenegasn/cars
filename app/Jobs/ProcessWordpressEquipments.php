<?php

namespace App\Jobs;

use App\Api\WordPressApi;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ProcessWordpressEquipments implements ShouldQueue
{
    use Batchable;
    use Queueable;

    protected $equipments;

    public $tries = 5;

    /**
     * Create a new job instance.
     */
    public function __construct($equipments)
    {
        $this->equipments = $equipments;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $wpApi = new WordPressApi();

        Log::info('Processing WordPress equipments');

        try {
            $wpEquipments = $wpApi->getEquipments();
        } catch (\Exception $e) {
            Log::error('Failed to fetch equipments from WordPress: ' . $e->getMessage());
            $this->releaseWithBackoff(); 
            return;
        }

        $this->equipments->each(function ($equipment) use ($wpEquipments, $wpApi) {
            if (! $wpEquipments->contains('id', $equipment->wp_id)) {
                try {
                    Log::info('Creating equipment: ' . $equipment->id);
                    $newEquipment = $wpApi->createEquipment($equipment);
                    $equipment->update(['wp_id' => $newEquipment['id']]);
                } catch (\Exception $e) {
                    Log::error('Failed to create equipment in WordPress: ' . $e->getMessage());
                    $this->releaseWithBackoff();
                }
            }
        });
    }

    protected function releaseWithBackoff()
    {
        $attempts = $this->attempts();
        $delay = pow(2, $attempts) * 60; // Exponential backoff: 2^attempts * 60 seconds
        $this->release($delay);
    }
}
