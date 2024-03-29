<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductCategory::create([
            'name' => 'Category 1',
        ]);

        ProductCategory::create([
            'name' => 'Category 2',
        ]);

        ProductCategory::create([
            'name' => 'Category 3',
        ]);

    }
}
