<?php

namespace Database\Seeders;

use App\Models\Table;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tables = [
            ['name' => 'Table 1', 'status' => 0],
            ['name' => 'Table 2', 'status' => 0],
            ['name' => 'Table 3', 'status' => 0],
        ];

        foreach ($tables as $tableData) {
            Table::create($tableData);
        }
    }
}
