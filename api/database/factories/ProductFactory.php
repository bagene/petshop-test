<?php

namespace Database\Factories;

use Domains\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'title' => $this->faker->word(),
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'description' => $this->faker->paragraphs(asText: true),
        ];
    }
}
