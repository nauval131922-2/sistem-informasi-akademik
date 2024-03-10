<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // return [
        //     'name' => $this->faker->name(),
        //     'email' => $this->faker->unique()->safeEmail,
        //     'password' => bcrypt('12345678'), // password
        //     // 'id_role' => 5,
        //     'id_role' => rand(4, 5), // random 4 or 5 (guru or siswa
        //     // jika id_role 5 (siswa) maka id_kelas diisi random 1-6
        //     // jika id_role 4 (guru) maka id_kelas diisi null dan id_mapel diisi random 1-8
        //     // 'id_kelas' => rand(1, 6),
        //     // 'id_mapel' => null,
        //     'username' => $this->faker->unique()->userName,
        // ];

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('12345678'), // password
            'id_role' => rand(4, 5), // random 4 or 5 (guru or siswa)
            // jika id_role 5 (siswa) maka id_kelas diisi random 1-6
            // jika id_role 4 (guru) maka id_kelas diisi null dan id_mapel diisi random 1-8
            'id_kelas' => function (array $attributes) {
                return $attributes['id_role'] == 5 ? rand(1, 6) : null;
            },
            'id_mapel' => function (array $attributes) {
                return $attributes['id_role'] == 4 ? rand(1, 8) : null;
            },
            'username' => $this->faker->unique()->userName,
        ];

    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
