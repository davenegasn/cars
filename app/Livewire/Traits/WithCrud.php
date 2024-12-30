<?php 
namespace App\Livewire\Traits;

use App\Services\TechnicalSpecService;

use Livewire\Attributes\Computed;

trait WithCrud
{
    use HandlesEquipments, HandlesBrands, HandlesTechnicalSpecs;

    
    public string $newTractionName = '';



    #[Computed]
    public function populateOptions()
    {
        $this->setSpecs();
        $this->setEquipments();
    }

    
    
  

    public function removeImage()
    {
        $this->form->image = null;
    }
}