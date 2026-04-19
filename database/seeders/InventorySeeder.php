<?php

namespace Database\Seeders;

use App\Models\inventory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        inventory::factory(10)->create()->count();
    }
}
