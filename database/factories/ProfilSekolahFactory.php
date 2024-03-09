<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProfileSekolah>
 */
class ProfilSekolahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => 1,
            'nama' => 'MI NU Nurul Ulum',
            'alamat' => 'Jl. Kudus-Colo Km.09 Piji Siwalan RT 04 RW 03, Piji, Kec. Dawe, Kab. Kudus, Jawa Tengah.',
            'hp' => null,
            'email' => null,
            'twitter' => null,
            'facebook' => null,
            'instagram' => null,
            'youtube' => null,
            'visi' => '<div><strong>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime in sapiente esse blanditiis, eum vel excepturi provident fuga porro quibusdam dolorem temporibus assumenda, non quod est incidunt debit"</strong></div>',
            'misi' => '<ul><li>Ullamco laboris nisi ut aliquip ex ea commodo consequa</li><li>Duis aute irure dolor in reprehenderit in voluptate velit</li><li>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in</li><li>Ullamco laboris nisi ut aliquip ex ea commodo consequa</li><li>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit. Ullamco laboris nisi ut aliquip ex ea commodo consequa</li></ul>',
            'tujuan' => '<ul><li>Ullamco laboris nisi ut aliquip ex ea commodo consequa</li><li>Duis aute irure dolor in reprehenderit in voluptate velit</li><li>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in</li></ul>',
            'logo' => null,
            // created_at dan updated_at diisi dengan tanggal hari ini
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
