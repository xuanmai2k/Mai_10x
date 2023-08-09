<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductCategory>
 */
class ProductCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name;
        $slug = Str::slug($name);
        return [
            'name' => $name,
            'slug' => $slug,
            'minimum_limit_age' =>fake()->numberBetween(0,100),
            'maximum_limit_age' =>fake()->numberBetween(0,100),
            'status'=> fake()->numberBetween(0,1)
        ];
    }
}
