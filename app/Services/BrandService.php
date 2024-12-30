<?php

namespace App\Services;

use App\Models\Brand;

class VehicleService
{
    public function create(string $name, string $slug)
    {
        $brand = Brand::firstOrCreate([
            'name' => $name,
            'slug' => $slug
        ]);

        return $brand;
    }
}
