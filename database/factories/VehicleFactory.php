<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Services\WordpressService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    const VEHICLE_TITLES = [
        '2020 Ford F-150 3.5L EcoBoost Lariat 4WD',
        '2021 Toyota RAV4 Hybrid XSE AWD',
        '2019 Honda CR-V 2.4L EX-L FWD',
        '2022 Jeep Wrangler 2.0T Rubicon 4WD',
        '2021 Nissan Rogue SV AWD',
        '2020 Subaru Outback 2.5i Premium AWD',
        '2022 Volkswagen Tiguan SE R-Line AWD',
        '2021 Ram 1500 5.7L HEMI Laramie 4WD',
        '2023 Kia Sorento SX Prestige AWD',
        '2021 Hyundai Tucson Limited AWD',
        '2020 Mazda CX-5 Grand Touring AWD',
        '2021 Chevrolet Tahoe 5.3L LT 4WD',
        '2022 Ford Explorer XLT AWD',
        '2021 BMW X3 xDrive30i AWD',
        '2020 Audi Q5 Premium Plus Quattro',
        '2022 Lexus RX 350 F Sport AWD',
        '2021 GMC Sierra 1500 Denali 4WD',
        '2020 Volvo XC60 T5 Momentum AWD',
        '2023 Subaru Forester Premium AWD',
        '2022 Honda Pilot Elite AWD',
    ];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => self::VEHICLE_TITLES[array_rand(self::VEHICLE_TITLES)],
            'slug' => fake()->slug(),
            'featured_image' => fake()->imageUrl(),
            'description' => fake()->sentence(),
            'brand_id' => Brand::inRandomOrder()->first()->id
        ];
    }
}

