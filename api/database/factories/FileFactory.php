<?php

namespace Database\Factories;

use Domains\File\Models\File;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class FileFactory extends Factory
{
    protected $model = File::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'name' => $this->faker->name(),
            'path' => $this->faker->imageUrl(width: 220, height: 220),
            'size' => '200x200',
            'type' => 'image/png',
        ];
    }
}
