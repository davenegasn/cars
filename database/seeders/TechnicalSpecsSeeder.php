<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnicalSpecsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technicalSpecs = [
            'Tracción' => 'traccion',
            'Tipo de Transmisión' => 'tipo-transmision',
            'Asientos' => 'asientos',
            'Kilometraje' => 'kilometraje',
            'Velocidades' => 'velocidades',
            'Motor' => 'motor',
            'Tipo de Combustible' => 'tipo-de-combustible',
            'Carrocería' => 'carroceria',
        ];

        foreach ($technicalSpecs as $key => $value) {
            \App\Models\TechnicalSpec::create([
                'name' => $key,
                'slug' => $value,
            ]);
        }
    }
}
