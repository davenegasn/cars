<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\ImageGallery>
 */
class ImageGalleryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = [];
        
        for ($i = 0; $i < 3; $i++) {
            $images[] = $this->faker->imageUrl();
        }
        
        return [
            'image' => json_encode($images),
            'description' => $this->faker->sentence
        ];
    }
}
