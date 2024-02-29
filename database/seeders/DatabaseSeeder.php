<?php

namespace Database\Seeders;

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
        // User::factory(50)->create();
        // User::factory()->create([
        //     'id_role' => 1,
        //     'name' => 'Admin',
        //     'email' => 'nauvalgunawan5@gmail.com',
        //     'password' => bcrypt('12345678'),
        //     'username' => 'admin',
        // ]);

        // User::factory()->create([
        //     'id_role' => 2,
        //     'name' => 'Kepala Madrasah',
        //     'email' => '',
        //     'password' => bcrypt('12345678'),
        //     'username' => 'kepalamadrasah',
        // ]);
            
        TahunAjaran::factory(10)->create();
    }
}
