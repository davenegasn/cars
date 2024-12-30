<?php

namespace App\Listeners;

use App\Events\VehicleCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class addVehicleToChileautos
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(VehicleCreated $event): void
    {
        $event->vehicle->addToChileautos();
    }
}
