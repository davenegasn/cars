<?php

namespace App\Livewire\Traits;

use App\Models\Equipment;

trait HandlesEquipments
{
    public string $newEquipment = '';

    public array $equipmentOptions = [];
    
    public function setEquipments()
    {
        $this->equipmentOptions = Equipment::all()->toArray();
    }

    public function createEquipment()
    {
        if (empty($this->newEquipment)) {
            return;
        }

        $created = Equipment::firstOrCreate([
            'name' => $this->newEquipment
        ]);

        $this->equipmentOptions[] = $created->toArray();

        $this->reset('newEquipment');
    }
}