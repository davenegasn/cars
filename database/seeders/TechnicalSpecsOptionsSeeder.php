<?php

namespace Database\Seeders;

use App\Models\TechnicalSpec;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnicalSpecsOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technicalSpecsOptions = [
            '4x2' => 'traccion',
            '4x4' => 'traccion',
            'Manual' => 'tipo-transmision',
            'Automática' => 'tipo-transmision',
            'Semi-Automática' => 'tipo-transmision',
            '2 Asientos' => 'asientos',
            '4 Asientos' => 'asientos',
            '5 Asientos' => 'asientos',
            'Gasolina' => 'tipo-de-combustible',
            'Diésel' => 'tipo-de-combustible',
            'Híbrido' => 'tipo-de-combustible',
            'Eléctrico' => 'tipo-de-combustible',
            'Gasolina + GNC' => 'tipo-de-combustible',
            'GLP' => 'tipo-de-combustible',
            'City Car' => 'carroceria',
            'SUV' => 'carroceria',
            'Sedán' => 'carroceria',
            'Hatchback' => 'carroceria',
            'Coupé' => 'carroceria',
            'Convertible' => 'carroceria',
            'Familiar' => 'carroceria',
            'Pickup' => 'carroceria',
            'Furgoneta' => 'carroceria',
            '1500cc' => 'motor',
            '1600cc' => 'motor',
            '1800cc' => 'motor',
            '2000cc' => 'motor',
            '2500cc' => 'motor',
        ];

        foreach ($technicalSpecsOptions as $key => $value) {
            \App\Models\TechnicalSpecsOptions::create([
                'option' => $key,
                'technical_spec_id' => TechnicalSpec::where('slug', $value)->first()->id,
            ]);
        }

    }
}
