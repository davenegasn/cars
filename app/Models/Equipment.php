<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Equipment extends Model
{
    /** @use HasFactory<\Database\Factories\EquipmentFactory> */
    use HasFactory;

    protected $table = 'equipments';

    protected $fillable = ['name', 'description', 'slug'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($equipment) {
            if (isset($equipment->name)) {
                $equipment->slug = Str::slug($equipment->name);
            }
        });
    }

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class, 'equipment_vehicles');
    }
}
