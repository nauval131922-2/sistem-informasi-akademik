<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TahunAjaran>
 */
class TahunAjaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'semester' => $this->faker->randomElement(['Gasal', 'Genap']),
            // contoh tahun ajaran: 2020/2021
            'tahun' => $this->faker->year . '/' . ($this->faker->year + 1),
            'status' => $this->faker->randomElement(['Aktif', 'Nonaktif']),
        ];
    }
}
