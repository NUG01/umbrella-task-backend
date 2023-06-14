<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Image;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        ProductCategory::create([
            'name' => 'Category',
        ]);

        for ($i = 0; $i < 10000; $i++) {
            $product =  Product::create([
                'name' => 'Name',
                'description' => 'description',
                'price' => $i * 2,
                'product_categories_id' => [1],
            ]);
            Image::create([
                'product_id' => $product->id,
                'path' => 'assets/umbrella.jpg',
            ]);
        }
    }
}
