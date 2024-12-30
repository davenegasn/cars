<?php

namespace App\Livewire;

use App\Livewire\Forms\VehicleForm;
use App\Livewire\Traits\WithCrud;
use App\Models\Brand;
use Livewire\Component;
use Livewire\WithFileUploads;

class VehicleCreate extends Component
{
    use WithFileUploads;
    use WithCrud;

    public VehicleForm $form;
    
    public function mount()
    {
        $this->populateOptions();
    }

    public function save()
    {
        $this->form->store();

        return $this->redirect('/dashboard');
    }

    public function render()
    {
        return view('livewire.vehicle-form', [
            'edit' => false
        ]);
    }
}
