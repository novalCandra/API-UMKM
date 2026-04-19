<?php

namespace Database\Factories;

use App\Models\category;
use App\Models\inventory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_inventory' => inventory::factory(),
            'id_category' => category::factory(),
            'nama_barang' => fake()->randomElement(['laptop', 'beras', 'hanphone', 'minyak', 'susu']),
            'harga_barang' =>   fake()->numberBetween(1000, 40000),
            'image' => '/storage/image',
            "image_url" => "https://placehold.co/600x400",
        ];
    }
}
