<?php

namespace App\Livewire;

use App\Livewire\Forms\VehicleForm;
use App\Livewire\Traits\WithCrud;
use App\Models\Brand;
use App\Models\Equipment;
use App\Models\Vehicle;
use App\Services\TechnicalSpecService;
use Livewire\Component;
use Livewire\WithFileUploads;


class VehicleEdit extends Component
{
    use WithFileUploads;
    use WithCrud;

    public Vehicle $vehicle;
    public VehicleForm $form;

    public function mount($id)
    {
        $this->vehicle = Vehicle::findOrFail($id);

        $this->populateOptions();

        $this->form->setVehicle($this->vehicle);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirect('/dashboard');
    }

    public function render()
    {
        return view('livewire.vehicle-form', [
            'edit' => true
        ]);
    }
}
