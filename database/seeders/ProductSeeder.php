<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();

        $categories = ProductCategory::all();

        foreach ($categories as $category) {
            Product::create([
                'name' => $faker->name,
                'price' => $faker->numberBetween(1, 1000),
                'description' => $faker->sentence,
                'category_id' => $category->id,
            ]);

            Product::create([
                'name' => $faker->name,
                'price' => $faker->numberBetween(1, 1000),
                'description' => $faker->sentence,
                'category_id' => $category->id,
            ]);

            Product::create([
                'name' => $faker->name,
                'price' => $faker->numberBetween(1, 1000),
                'description' => $faker->sentence,
                'category_id' => $category->id,
            ]);
        }
    }
}
