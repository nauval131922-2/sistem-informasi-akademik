<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
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
            'blog_category_id' => 1,
            'id_user_for_blog' => 1,
            'blog_title' => 'Selamat datang di Website MI NU Nurul Ulum',
            'blog_image' => 'upload/blog/Selamat-datang-di-Website-MI-NU-Nurul-Ulum-1764017565770192.jpg',
            'excerpt' => 'MI NU Nurul Ulum adalah salah satu satuan pendidikan dengan jenjang MI di Piji, Kec. Dawe, Kab. Kudus, Jawa Tengah. Dalam menjalankan kegiatannya, MI NU Nurul Ulum berada di bawah naungan Kementerian...',
            'blog_description' => '<div>MI NU Nurul Ulum adalah salah satu satuan pendidikan dengan jenjang MI di Piji, Kec. Dawe, Kab. Kudus, Jawa Tengah. Dalam menjalankan kegiatannya, MI NU Nurul Ulum berada di bawah naungan Kementerian Agama. MI NU Nurul Ulum beralamat di Jl. Kudus-Colo Km.09 Piji Siwalan RT 04 RW 03, Piji, Kec. Dawe, Kab. Kudus, Jawa Tengah. MI NU Nurul Ulum memiliki akreditasi A, berdasarkan sertifikat 044/BANSM-JTG/SK/X/2018.</div>',
            // created_at dan updated_at diisi dengan tanggal hari ini
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
