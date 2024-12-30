<?php

namespace App\Livewire\Traits;

use App\Models\Brand;
use App\Services\TechnicalSpecService;

trait HandlesTechnicalSpecs
{
    public array $traccionOptions = [];
    public array $tipoTransmisionOptions = [];
    public array $asientosOptions = [];
    public array $carroceriaOptions = [];
    public array $tipoCombustibleOptions = [];

    public string $newOption = '';

    public function setSpecs()
    {
        $this->traccionOptions = TechnicalSpecService::getOptions('traccion');
        $this->tipoTransmisionOptions = TechnicalSpecService::getOptions('tipo-transmision');
        $this->asientosOptions = TechnicalSpecService::getOptions('asientos');
        $this->carroceriaOptions = TechnicalSpecService::getOptions('carroceria');
        $this->tipoCombustibleOptions = TechnicalSpecService::getOptions('tipo-de-combustible');
    }
    
    public function createOption($parent)
    {
        $option = (new TechnicalSpecService)->createOption($parent, $this->newOption);

        $this->traccionOptions[] = $option;
    }
}