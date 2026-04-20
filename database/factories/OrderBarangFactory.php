<?php

namespace Database\Factories;

use App\Models\barang;
use App\Models\order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderBarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_order' => order::factory(),
            'id_barang' => barang::factory(),
            "status" => fake()->randomElement(['approve', 'running', 'reject'])
        ];
    }
}
