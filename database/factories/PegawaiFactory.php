<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pegawai>
 */
class PegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
           'idpegawai' => $this->faker->bothify('#######'),
           'nama' => $this->faker->name(),
           'tgllahir' => $this->faker->date('Y_m_d'),
           'jekel' => $this->faker->randomElement(['L','P']),
           'alamat' =>  $this->faker->address(),
           'tamatan' =>  $this->faker->word(),
           'jabatan' =>  $this->faker->word(),

       ];
   }
}
