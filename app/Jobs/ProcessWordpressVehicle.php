<?php

namespace App\Jobs;

use App\Models\Vehicle;
use App\Services\VehicleService;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ProcessWordpressVehicle implements ShouldQueue
{
    use Batchable;
    use Queueable;
    

    protected Vehicle $vehicle;
    protected $vehicleService;


    /**
     * Create a new job instance.
     */
    public function __construct($vehicle)
    {
        $this->vehicle = $vehicle;
        $this->vehicleService = new VehicleService();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $newVehicle = $this->vehicleService->getFormatted($this->vehicle);
        Log::info($newVehicle);

        // $wpApi = new WordPressApi();

        // $newVehicle['id'] = $wpApi->sendVehicle($newVehicle);

        // $vehicle->update(['wp_id' => $newVehicle['id']]);
    }
}
