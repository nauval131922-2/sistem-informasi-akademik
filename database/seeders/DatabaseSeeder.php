<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Jabatan;
use App\Models\Kelas;
use App\Models\ProfilSekolah;
use App\Models\SambutanKepalaMadrasah;
use App\Models\User;
use App\Models\TahunAjaran;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Jabatan::factory()->create([
            'id' => 1,
            'nama' => 'Admin',
        ]);

        Jabatan::factory()->create([
            'id' => 2,
            'nama' => 'Kepala Madrasah',
        ]);

        Jabatan::factory()->create([
            'id' => 3,
            'nama' => 'Guru Wali',
        ]);

        Jabatan::factory()->create([
            'id' => 4,
            'nama' => 'Guru Mata Pelajaran',
        ]);

        Jabatan::factory()->create([
            'id' => 5,
            'nama' => 'Siswa',
        ]);

        Kelas::factory()->create([
            'id' => 1,
            'nama' => 'Kelas 1',
        ]);

        Kelas::factory()->create([
            'id' => 2,
            'nama' => 'Kelas 2',
        ]);

        Kelas::factory()->create([
            'id' => 3,
            'nama' => 'Kelas 3',
        ]);

        Kelas::factory()->create([
            'id' => 4,
            'nama' => 'Kelas 4',
        ]);

        Kelas::factory()->create([
            'id' => 5,
            'nama' => 'Kelas 5',
        ]);

        Kelas::factory()->create([
            'id' => 6,
            'nama' => 'Kelas 6',
        ]);

        BlogCategory::factory()->create([
            'id' => 1,
            'blog_category' => 'Umum',
        ]);

        // User::factory(50)->create();
        User::factory()->create([
            'id_role' => 1,
            'name' => 'Admin',
            'email' => 'nauvalgunawan5@gmail.com',
            'password' => bcrypt('12345678'),
            'username' => 'admin',
            'id_mapel' => null,
        ]);



        // User::factory()->create([
        //     'id_role' => 2,
        //     'name' => 'Kepala Madrasah',
        //     'email' => '',
        //     'password' => bcrypt('12345678'),
        //     'username' => 'kepalamadrasah',
        // ]);

        // TahunAjaran::factory(10)->create();

        Blog::factory(1)->create();

        SambutanKepalaMadrasah::factory(1)->create();

        ProfilSekolah::factory(1)->create();
    }
}
