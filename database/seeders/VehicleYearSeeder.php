<?php

namespace Database\Seeders;

use App\Models\VehicleYear;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicleYear = new VehicleYear();

        $currentYear = date('Y');
        $startYear = $currentYear - 30;
        
        for ($year = $currentYear; $year >= $startYear; $year--) {
            $vehicleYear->create([
                'year' => $year
            ]);
        }
    }
}
