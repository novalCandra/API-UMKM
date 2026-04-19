<?php

namespace Database\Factories;

use App\Models\barang;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'total_barang' => fake()->numberBetween(1, 100),
            "stok_barang" => fake()->numberBetween(1, 100)
        ];
    }
}
