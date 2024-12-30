<?php

namespace App\Livewire;

use App\Models\Vehicle;
use Livewire\Component;

class VehicleList extends Component
{
    public $vehicles;

    public function mount()
    {
        $this->vehicles = Vehicle::all();
    }

    public function render()
    {
        return view('livewire.vehicle-list');
    }
}
