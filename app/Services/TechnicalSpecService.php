<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Models\TechnicalSpec;

class TechnicalSpecService
{
    public static function getOptions(string $slug)
    {
        $technicalSpec = TechnicalSpec::where('slug', $slug)->first();

        return $technicalSpec->options->pluck('option', 'id')->toArray();
    }
    
    public function create(string $name, string $slug)
    {
        $created = TechnicalSpec::firstOrCreate([
            'name' => $name,
            'slug' => $slug
        ]);

        return $created;
    }

    public function createOption(string $parentSlug, string $option)
    {
        $technicalSpec = $this->getBySlug($parentSlug);

        $created = $technicalSpec->options()->firstOrCreate([
            'option' => $option
        ]);

        return $created;
    }

    public function getBySlug(string $slug)
    {
        return TechnicalSpec::where('slug', $slug)->first();
    }

}
