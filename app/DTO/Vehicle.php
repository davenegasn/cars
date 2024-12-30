<?php 
namespace App\DTO;

use App\Models\Vehicle;

readonly class VehicleDTO
{
    public function __construct(
        public $title,
        public $description,
        public $status,
        public $meta,
        public $marcas_of,
        public $equipamiento,
       
    ) {}

    public static function fromVehicle(Vehicle $vehicle)
    {
        return new self(
            $vehicle->title,
            $vehicle->description,
            'publish',
            [
                "precio" => $vehicle->price,
                "ano-automovil" => $vehicle->year,
                "estado-del-automovil" => $vehicle->condition,
                "direccion" => $vehicle->address,
                "duenos" => $vehicle->owners,
                "_video-youtube" => $vehicle->_video_youtube,
                "_video-media" => $vehicle->_video_media,
                'traccion'  => $vehicle->traccion,
                'tipo-transmision' => $vehicle->tipo_transmision,
                'asientos' => $vehicle->asientos ?? null,
                'kilometraje' => $vehicle->kilometraje ?? null,
                'velocidades' => $vehicle->velocidades ?? null,
                'motor' => $vehicle->motor ?? null,
                'tipo-de-combustible' => $vehicle->tipo_combustible ?? null,
                'carroceria' => $vehicle->carroceria ?? null,
            ],
            $vehicle->brand_id,
            $vehicle->equipamiento,
            $vehicle->ano_del_automovil,
            $vehicle->detalle_modelo,
            
        );
    }

    public function toArray()
    {
        return [
            'title' => $this->title,
            'content' => $this->description,
            'status' => $this->status,
            'meta' => [
                'ano-automovil' => $this->year->year ?? null, 
                'precio' => $this->precio ?? 'Vendido',
                'estado-del-automovil' => $this->condition ?? null,
                'direccion' => $this->address ?? null,
                'duenos' => $this->owners ?? null,
                '_video-youtube' => $this->_video_youtube ?? null,
                '_video-media' => $this->_video_media ?? null,
                'traccion'  => $this->traccion ?? null,
                'tipo-transmision' => $this->tipo_transmision ?? null,
                'asientos' => $this->asientos ?? null,
                'kilometraje' => $this->kilometraje ?? null,
                'velocidades' => $this->velocidades ?? null,
                'motor' => $this->motor ?? null,
                'tipo-de-combustible' => $this->tipo_combustible ?? null,
                'carroceria' => $this->carroceria ?? null,

            ],
            'marcas-of' => $this->marcas_of,
            'equipamiento' => $this->equipamiento,
            'ano-del-automovil' => $this->ano_del_automovil,
            'detalle-modelo' => $this->detalle_modelo,
        ];
    }
}