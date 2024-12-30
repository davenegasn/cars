<?php

namespace Database\Seeders;

use App\Api\WordPressApi;
use App\Models\Brand;
use App\Services\WordpressService;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;


class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wpService = new WordpressService();

        $wpService->syncBrands();
    }
}
