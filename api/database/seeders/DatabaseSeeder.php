<?php

namespace Database\Seeders;

use Database\Factories\CategoryFactory;
use Domains\File\Models\File;
use Domains\Product\Models\Category;
use Domains\Product\Models\Product;
use Domains\User\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'email' => 'admin@buckhill.co.uk',
            'password' => bcrypt('admin'),
            'is_admin' => true,
        ]);
        Category::factory()
            ->has(
                Product::factory()->count(10)->afterCreating(
                    function (Product $product) {
                        $image = File::factory()->create();
                        $product->metadata = [
                            'image' => $image->uuid,
                        ];
                        $product->save();
                    }
                )
            )
            ->count(10)
            ->create();
    }
}
