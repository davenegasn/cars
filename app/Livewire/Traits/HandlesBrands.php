<?php

namespace App\Livewire\Traits;

use App\Models\Brand;

trait HandlesBrands
{
    public string $newBrandName = '';
    
    public function createBrand(): ?Brand
    {
        if (empty($this->newBrandName)) {
            return null;
        }

        $created = Brand::firstOrCreate([
            'name' => $this->newBrandName
        ]);

        $this->form->brand_id = $created->id;

        $this->reset('newBrandName');

        return $created;
    }
}