<?php

namespace App\Jobs;

use App\Api\WordPressApi;
use App\Models\Vehicle;
use App\Services\VehicleService;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ProcessEditWordpressVehicle implements ShouldQueue
{
    use Batchable;
    use Queueable;

    private array $vehicle;
    protected $vehicleService;
    protected $wpApi;


    /**
     * Create a new job instance.
     */
    public function __construct(array $vehicle)
    {
        $this->vehicle = $vehicle;
       
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $wpApi = new WordPressApi();
        Log::info($this->vehicle);

        $newVehicle = $wpApi->putVehicle($this->vehicle);

        $vehicle = Vehicle::find($this->vehicle['inner_id']);

        $vehicle->update(['wp_id' => $newVehicle['id']]);

        Log::info('Vehicle updated: ' . $vehicle->toArray());
        
    }
}
