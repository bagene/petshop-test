<?php

namespace Database\Seeders;

use Database\Factories\CategoryFactory;
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
        Category::factory()
            ->has(
                Product::factory()->count(10)
            )
            ->count(10)
            ->create();
    }
}
