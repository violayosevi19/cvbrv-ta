<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produk>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
           'kodeproduk' => $this->faker->bothify('#######'),
           'namaproduk' => $this->faker->word(),
           'satuan' => $this->faker->numberBetween(0, 100),
           'harga' => $this->faker->randomFloat(2),
           'stock' => $this->faker->numberBetween(0, 100),
           'jenisproduk_id' =>  mt_rand(1,2)
        ];
    }
}
