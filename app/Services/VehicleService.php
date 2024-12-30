<?php

namespace App\Services;

use App\Api\WordPressApi;
use App\Jobs\ProcessEditWordpressVehicle;
use App\Jobs\ProcessWordpressBrand;
use App\Jobs\ProcessWordpressEquipments;
use App\Jobs\ProcessWordpressVehicle;
use App\Models\Equipment;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;

class VehicleService
{

    public function getFormatted(Vehicle $vehicle)
    {
        return [
            'title'     => $vehicle->title,
            'content'   => $vehicle->description,
            'inner_id'  => $vehicle->id,
            'meta' => [
                'ano-automovil' => $vehicle->year->year ?? null, 
                'precio' => $vehicle->attributes->price ?? 'Vendido',
                'estado-del-automovil' => $vehicle->attributes->condition ?? null,
                'asientos' => $vehicle->attributes->asientos,
                'motor' => $vehicle->attributes->motor ?? null,
              
                'direccion' => $vehicle->attributes->address ?? null,
                'duenos' => $vehicle->attributes->owners ?? null,
                
                'traccion'  => $vehicle->traccion ?? null,
                'tipo-transmision' => $vehicle->tipo_transmision ?? null,

                'kilometraje' => $vehicle->attributes->kilometraje ?? null,
                'velocidades' => $vehicle->attributes->velocidades ?? null,
               
                'tipo-de-combustible' => $vehicle->attributes->tipo_combustible ?? null,
                'carroceria' => $vehicle->attributes->carroceria ?? null,
                '_video-youtube' => $vehicle->_video_youtube ?? null,
                '_video-media' => $vehicle->_video_media ?? null,

            ],
            'marcas-of' => [$vehicle->brand->wp_id],
            'equipamiento' => $vehicle->equipments->pluck('id')->toArray(),
        ];
    }

    public function handleCreated(Vehicle $vehicle)
    {
        Log::info('Vehicle created: ' . $vehicle->id);

        //vehicle sending to wp = true
        $chain = Bus::batch([
            new ProcessWordpressBrand($vehicle->brand),
            new ProcessWordpressEquipments($vehicle->equipments),
            new ProcessWordpressVehicle($vehicle),

        ])->dispatch();
    }

    public function handleUpdated(Vehicle $vehicle)
    {
        Log::info('Vehicle Updated: ' . $vehicle->id);

        $jobs = [];

        if (! $vehicle->brand->wp_id) {
            $jobs[] = new ProcessWordpressBrand($vehicle->brand);
        }

        if ($vehicle->equipments?->whereNull('wp_id')->count()) {
            $jobs[] = new ProcessWordpressEquipments($vehicle->equipments->whereNull('wp_id'));
        }

        Bus::batch($jobs)->name('WP update')->dispatch();
    }

    public function handleBrands(Vehicle $vehicle)
    {
        $wpApi = new WordPressApi();

        $brands = $wpApi->getBrands();

        if (! $brands->contains('id', $vehicle->brand->wp_id)) {
            $newBrand = $wpApi->createBrand($vehicle->brand);
            $vehicle->brand->update(['wp_id' => $newBrand['id']]);
        }
    }

    public function handleEquipments(Vehicle $vehicle)
    {
        $wpApi = new WordPressApi();
        
        $wpequipments = $wpApi->getEquipments();

        $vehicle->equipments->each(function ($equipment) use ($wpequipments, $wpApi) {
            if (! $wpequipments->contains('id', $equipment->wp_id)) {
                $newEquipment = $wpApi->createEquipment($equipment);
                $equipment->update(['wp_id' => $newEquipment['id']]);
            }
        });
    }
}
