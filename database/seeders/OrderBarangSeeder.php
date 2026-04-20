<?php

namespace Database\Seeders;

use App\Models\order_barang;
use App\Models\OrderBarang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderBarang::factory(10)->create()->count();
    }
}
