<?php

namespace App\Livewire\Forms;

use App\Models\Vehicle;
use App\Services\VehicleService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Form;


class VehicleForm extends Form
{
    public ?Vehicle $vehicle;
    public $title  = '';
    public string $slug = '';
    public $featured_image  = null;
    public $description = null;
    public $brand_id = null;
    public $sold = 0;
    public $price = null;
    public $year_id = null;
    public $condition = null;
    public $address = null;
    public $owners = null;
    public $_video_youtube = null;
    public $_video_media = null;
    public $image;

    public $traccion = null;
    public $tipo_transmision = null;
    public $asientos = null;
    public $kilometraje = null;
    public $velocidades = null;
    public $motor = null;
    public $tipo_combustible = null;
    public $carroceria = null;

    public array $equipment = [];

    public function setVehicle(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;

        $this->title = $vehicle->title ?? null;
        $this->featured_image = $vehicle->featured_image ?? null;
        $this->slug = $vehicle->slug ?? null;
        $this->description = $vehicle->description ?? null;
        $this->brand_id = $vehicle->brand_id ?? null;
        $this->sold = $vehicle->attributes->sold ?? 0;
        $this->price = $vehicle->attributes->price ?? null;
        $this->year_id = $vehicle->attributes->year_id ?? null;
        $this->condition = $vehicle->attributes->condition ?? null;
        $this->address = $vehicle->attributes->address ?? null;
        $this->owners = $vehicle->attributes->owners ?? null;
        $this->_video_youtube = $vehicle->attributes->_video_youtube ?? null;
        $this->_video_media = $vehicle->attributes->_video_media ?? null;

        $this->traccion = $vehicle->attributes->traccion ?? null;
        $this->tipo_transmision = $vehicle->attributes->tipo_transmision ?? null;
        $this->asientos = $vehicle->attributes->asientos ?? null;
        $this->kilometraje = $vehicle->attributes->kilometraje ?? null;
        $this->velocidades = $vehicle->attributes->velocidades ?? null;
        $this->motor = $vehicle->attributes->motor ?? null;
        $this->tipo_combustible = $vehicle->attributes->tipo_combustible ?? null;
        $this->carroceria = $vehicle->attributes->carroceria ?? null;

        $this->equipment = $vehicle->equipments->pluck('id')->toArray() ?? [];
    }
  
    public function store() 
    {
        $this->validate();

        $vehicleService = new VehicleService();

        $this->slug = Str::slug($this->title);

        if ($this->image) {
            $this->featured_image = $this->image->storePublicly('vehicle_images', ['disk' => 'public']);
        }
       
        $vehicle = Auth::user()->vehicles()->create($this->only(['title', 'description', 'brand_id', 'featured_image']));

        $vehicle->attributes()->create($this->only([
            'sold',
            'price',
            'year_id',
            'condition',
            'address',
            'owners',
            '_video_youtube',
            '_video_media',
            'traccion',
            'tipo_transmision',
            'asientos',
            'kilometraje',
            'velocidades',
            'motor',
            'tipo_combustible',
            'carroceria',
        ]));

        if (!empty($this->equipment)) {
            $this->vehicle->equipments()->sync($this->equipment);
        }

        $vehicleService->handleCreated($vehicle);
        
        $this->reset(); 
    }

    public function update() 
    {
        $this->validate();

        $vehicleService = new VehicleService();

        if ($this->image) {
            $this->featured_image = $this->image->storePublicly('vehicle_images', ['disk' => 'public']);
        }

        $this->vehicle->update($this->only(['title', 'description', 'brand_id', 'featured_image']));

        $this->vehicle->attributes()->update($this->only([
            'sold',
            'price',
            'year_id',
            'condition',
            'address',
            'owners',
            '_video_youtube',
            '_video_media',
            'traccion',
            'tipo_transmision',
            'asientos',
            'kilometraje',
            'velocidades',
            'motor',
            'tipo_combustible',
            'carroceria',
        ]));
        

        if (!empty($this->equipment)) {
            $this->vehicle->equipments()->sync($this->equipment);
        }

        $vehicleService->handleUpdated($this->vehicle);

        $this->reset(); 
    }

    

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:1024',
            'description' => 'nullable|string',
            'brand_id' => 'required|exists:brands,id',
            'sold' => 'required|in:0,1',
            'price' => 'nullable|string|max:255',
            'year_id' => 'nullable|exists:years,id',
            'condition' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'owners' => 'nullable|string|max:255',
            '_video_youtube' => 'nullable|string|max:255',
            '_video_media' => 'nullable|string|max:255',
        ];
    }
}
