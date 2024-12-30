<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\TechnicalSpecsOptions;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Wordpress;
use App\Services\WordpressService;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            VehicleYearSeeder::class,
            BrandSeeder::class,
            TechnicalSpecsSeeder::class,
            TechnicalSpecsOptionsSeeder::class,
        ]);

        $this->createAdmin();

        User::factory(2)
            ->has(Vehicle::factory()->count(3))
            ->create();
    }

    private function createAdmin(): void
    {
        User::factory()
            ->has(Wordpress::factory()->count(1))
            ->create([
                'name' => 'Daniela Venegas',
                'email' => 'davenegasn@gmail.com',
                'password' => bcrypt('password'),
                'is_admin' => true
        ]); 

        $wordpressService = new WordpressService();
        $wordpressService->syncEquipment(); 
        $wordpressService->syncVehicles(); 


    }
}
