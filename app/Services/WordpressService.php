<?php 

namespace App\Services;

use App\Api\WordPressApi;
use App\DTO\VehicleDTO;
use App\Models\Brand;
use App\Models\Equipment;
use App\Models\Vehicle;

use Illuminate\Support\Facades\Log;

class WordpressService
{
    const ATTRIBUTE_TO_WP_METABOX = [
        'sold' => 'vendido',
        'price' => 'precio',
        'year' => 'ano-automovil',
        'condition' => 'estado-del-automovil',
        'address' => 'direccion',
        'owners' => 'duenos',
        '_video_youtube' => '_video-youtube',
        '_video_media' => '_video-media',
    ];

    public function __construct()
    {
        // 
    }

    public function getVehicles()
    {
        $wpApi = new WordPressApi();

        return $wpApi->getVehicles();
    }

    public function syncVehicles(): void
    {
        $vehicles = $this->getVehicles();
        
        $vehicles->each(function ($vehicle) {
            $wpBrandId = array_shift($vehicle['marcas-of']) ?? null;

            if (!$wpBrandId) {
                Log::error('Brand not found', ['id' => $vehicle['marcas-of']]);
                return;
            }

            try {
                $brand = Brand::where('wp_id', $wpBrandId)->firstOrFail();
            } catch (\Exception $e) {
                Log::error('Brand not found', ['id' => $wpBrandId]);
                return;
            }

            Vehicle::upsert([
                'title' => $vehicle['title']['rendered'],
                'slug' => $vehicle['slug'],
                'wp_link' => $vehicle['link'],
                'wp_featured_media_id' => $vehicle['featured_media'],
                'wp_id' => $vehicle['id'],
                'wp_status' => $vehicle['status'],
                'brand_id' => $brand->id,
                'user_id' => 1,
            ], uniqueBy: ['wp_id'], update: ['title', 'slug', 'wp_link', 'wp_status']);
            
            try {
                $created = Vehicle::where('wp_id', $vehicle['id'])->firstOrFail();
            } catch (\Exception $e) {
                Log::error('Vehicle not found', ['id' => $vehicle['id']]);
                return;
            }
            
            if (!isset($vehicle['meta']) || empty($vehicle['meta'])) {
                return;
            }

            $metabox = $vehicle['meta'];

            $created->attributes()->updateOrCreate([
                'sold' => $metabox['precio'] == 'Vendido' ? true : false,
                'price' => $metabox['precio'] ?? null,
                //'year' => $metabox['ano-automovil'] ?? null,
                'condition' => $metabox['estado-del-automovil'] ?? null,
                'address' => $metabox['direccion'] ?? null,
                'owners' => $metabox['duenos'] ?? null,
                '_video_youtube' => $metabox['_video-youtube'] ?? null,
                '_video_media' => $metabox['_video-media'] ?? null
            ]);
        });
    }

    public function createVehicle(Vehicle $vehicle)
    {
        $wpApi = new WordPressApi();

        $vehicleRequest = VehicleDTO::fromVehicle($vehicle);

        dump($vehicleRequest->toArray());

        //$wpApi->sendVehicle(new VehicleRequest)
    }

    public function getEquipments()
    {
        $wpApi = new WordPressApi();

        return $wpApi->getEquipments();
    }

    public function syncEquipment(): void
    {
        $wpApi = new WordPressApi();

        $equipments = $wpApi->getEquipments();

        $equipments->each(function ($equipment) {
            Equipment::upsert([
                'name' => $equipment['name'],
                'description' => $equipment['description'],
                'slug' => $equipment['slug'],
                'wp_id' => $equipment['id']
            ], uniqueBy: ['slug'], update: ['name', 'description', 'wp_id']);
        });
    }

    public function getBrands()
    {
        $wpApi = new WordPressApi();

        return $wpApi->getBrands();
    }

    public function syncBrands(): void
    {
        $brands = $this->getBrands();
        
        $brands->each(function ($brand) {
            Brand::upsert([
                'name' => $brand['name'],
                'slug' => $brand['slug'],
                'description' => $brand['description'],
                'link' => $brand['link'],
                'wp_id' => $brand['id']
            ], uniqueBy: ['slug'], update: ['name', 'description', 'link', 'wp_id']);
        });
    }

    
}