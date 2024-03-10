<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Ekstrakurikuler;
use App\Models\Jabatan;
use App\Models\JamPelajaran;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Pengumuman;
use App\Models\ProfilSekolah;
use App\Models\SambutanKepalaMadrasah;
use App\Models\User;
use App\Models\TahunAjaran;
use Database\Factories\PengumumanFactory;
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
        // jabatan
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

        // kelas
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

        // blog category
        BlogCategory::factory()->create([
            'id' => 1,
            'blog_category' => 'Umum',
        ]);



        // user admin
        User::factory()->create([
            'id_role' => 1,
            'name' => 'Admin',
            'email' => 'nauvalgunawan5@gmail.com',
            'password' => bcrypt('12345678'),
            'username' => 'admin',
            'id_mapel' => null,
        ]);

        // user kepala madrasah
        User::factory()->create([
            'id_role' => 2,
            'name' => 'Kepala Madrasah',
            'email' => '',
            'password' => bcrypt('12345678'),
            'username' => 'kepala_madrasah',
        ]);

        // mata pelajaran
        MataPelajaran::factory()->create([
            'id' => 1,
            'mata_pelajaran' => 'Pendidikan Agama Islam',
        ]);

        MataPelajaran::factory()->create([
            'id' => 2,
            'mata_pelajaran' => 'Bahasa Indonesia',
        ]);

        MataPelajaran::factory()->create([
            'id' => 3,
            'mata_pelajaran' => 'Matematika',
        ]);

        MataPelajaran::factory()->create([
            'id' => 4,
            'mata_pelajaran' => 'Ilmu Pengetahuan Alam',
        ]);

        MataPelajaran::factory()->create([
            'id' => 5,
            'mata_pelajaran' => 'Ilmu Pengetahuan Sosial',
        ]);

        MataPelajaran::factory()->create([
            'id' => 6,
            'mata_pelajaran' => 'Pendidikan Jasmani, Olahraga, dan Kesehatan',
        ]);

        MataPelajaran::factory()->create([
            'id' => 7,
            'mata_pelajaran' => 'Seni Budaya',
        ]);

        MataPelajaran::factory()->create([
            'id' => 8,
            'mata_pelajaran' => 'Bahasa Inggris',
        ]);

        // user siswa dan guru mapel
        User::factory(50)->create();

        // user guru wali kelas 1
        User::factory()->create([
            'id_role' => 3,
            'name' => 'Guru Wali Kelas 1',
            'id_kelas' => 1, // 'id_kelas' => '1',
            // 'id_mapel' => 1,
            'password' => bcrypt('12345678'),
            'username' => 'guru_wali_kelas_1',
        ]);

        // user guru wali kelas 2
        User::factory()->create([
            'id_role' => 3,
            'name' => 'Guru Wali Kelas 2',
            'id_kelas' => 2, // 'id_kelas' => '2',
            // 'id_mapel' => 2,
            'password' => bcrypt('12345678'),
            'username' => 'guru_wali_kelas_2',
        ]);

        // user guru wali kelas 3
        User::factory()->create([
            'id_role' => 3,
            'name' => 'Guru Wali Kelas 3',
            'id_kelas' => 3, // 'id_kelas' => '3',
            // 'id_mapel' => 3,
            'password' => bcrypt('12345678'),
            'username' => 'guru_wali_kelas_3',
        ]);

        // user guru wali kelas 4
        User::factory()->create([
            'id_role' => 3,
            'name' => 'Guru Wali Kelas 4',
            'id_kelas' => 4, // 'id_kelas' => '4',
            // 'id_mapel' => 4,
            'password' => bcrypt('12345678'),
            'username' => 'guru_wali_kelas_4',
        ]);

        // user guru wali kelas 5
        User::factory()->create([
            'id_role' => 3,
            'name' => 'Guru Wali Kelas 5',
            'id_kelas' => 5, // 'id_kelas' => '5',
            // 'id_mapel' => 5,
            'password' => bcrypt('12345678'),
            'username' => 'guru_wali_kelas_5',
        ]);

        // user guru wali kelas 6
        User::factory()->create([
            'id_role' => 3,
            'name' => 'Guru Wali Kelas 6',
            'id_kelas' => 6, // 'id_kelas' => '6',
            // 'id_mapel' => 6,
            'password' => bcrypt('12345678'),
            'username' => 'guru_wali_kelas_6',
        ]);

        // blog
        Blog::factory(1)->create();

        // sambutan kepala madrasah
        SambutanKepalaMadrasah::factory(1)->create();

        // profil sekolah
        ProfilSekolah::factory(1)->create();

        // ekstrakurikuler
        Ekstrakurikuler::factory()->create([
            'id' => 1,
            'nama' => 'Pramuka',
        ]);

        Ekstrakurikuler::factory()->create([
            'id' => 2,
            'nama' => 'Paskibra',
        ]);

        Ekstrakurikuler::factory()->create([
            'id' => 3,
            'nama' => 'Bulutangkis',
        ]);

        Ekstrakurikuler::factory()->create([
            'id' => 4,
            'nama' => 'Futsal',
        ]);

        Ekstrakurikuler::factory()->create([
            'id' => 5,
            'nama' => 'Basket',
        ]);

        Ekstrakurikuler::factory()->create([
            'id' => 6,
            'nama' => 'Volly',
        ]);

        Ekstrakurikuler::factory()->create([
            'id' => 7,
            'nama' => 'Teater',
        ]);

        Ekstrakurikuler::factory()->create([
            'id' => 8,
            'nama' => 'Paduan Suara',
        ]);

        // jam pelaajaran
        JamPelajaran::factory()->create([
            'id' => 1,
            'jam_ke' => '1',
            'jam_mulai' => '07:00:00',
            'jam_selesai' => '07:29:00',
            'tipe_jam' => 'Pelajaran',
        ]);

        JamPelajaran::factory()->create([
            'id' => 2,
            'jam_ke' => '2',
            'jam_mulai' => '07:30:00',
            'jam_selesai' => '07:59:00',
            'tipe_jam' => 'Pelajaran',
        ]);

        JamPelajaran::factory()->create([
            'id' => 3,
            'jam_ke' => '3',
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '08:29:00',
            'tipe_jam' => 'Pelajaran',
        ]);

        JamPelajaran::factory()->create([
            'id' => 4,
            'jam_ke' => '4',
            'jam_mulai' => '08:30:00',
            'jam_selesai' => '08:44:00',
            'tipe_jam' => 'Istirahat',
        ]);

        JamPelajaran::factory()->create([
            'id' => 5,
            'jam_ke' => '5',
            'jam_mulai' => '08:45:00',
            'jam_selesai' => '09:14:00',
            'tipe_jam' => 'Pelajaran',
        ]);

        JamPelajaran::factory()->create([
            'id' => 6,
            'jam_ke' => '6',
            'jam_mulai' => '09:15:00',
            'jam_selesai' => '09:44:00',
            'tipe_jam' => 'Pelajaran',
        ]);

        JamPelajaran::factory()->create([
            'id' => 7,
            'jam_ke' => '7',
            'jam_mulai' => '09:45:00',
            'jam_selesai' => '10:14:00',
            'tipe_jam' => 'Pelajaran',
        ]);

        JamPelajaran::factory()->create([
            'id' => 8,
            'jam_ke' => '8',
            'jam_mulai' => '10:15:00',
            'jam_selesai' => '10:29:00',
            'tipe_jam' => 'Istirahat',
        ]);

        JamPelajaran::factory()->create([
            'id' => 9,
            'jam_ke' => '9',
            'jam_mulai' => '10:30:00',
            'jam_selesai' => '10:59:00',
            'tipe_jam' => 'Pelajaran',
        ]);

        JamPelajaran::factory()->create([
            'id' => 10,
            'jam_ke' => '10',
            'jam_mulai' => '11:00:00',
            'jam_selesai' => '11:29:00',
            'tipe_jam' => 'Pelajaran',
        ]);

        // pengumuman
        Pengumuman::factory()->create([
            'id' => 1,
            'judul' => 'Judul Pengumuman',
            'isi' => 'Isi Pengumuman',
            'id_role_for_pengumuman' => 1,
        ]);

        Pengumuman::factory()->create([
            'id' => 2,
            'judul' => 'Judul Pengumuman',
            'isi' => 'Isi Pengumuman',
            'id_role_for_pengumuman' => 3,
            'id_kelas_for_pengumuman' => 1,
        ]);

        Pengumuman::factory()->create([
            'id' => 3,
            'judul' => 'Judul Pengumuman',
            'isi' => 'Isi Pengumuman',
            'id_role_for_pengumuman' => 3,
            'id_kelas_for_pengumuman' => 2,
        ]);

        Pengumuman::factory()->create([
            'id' => 4,
            'judul' => 'Judul Pengumuman',
            'isi' => 'Isi Pengumuman',
            'id_role_for_pengumuman' => 3,
            'id_kelas_for_pengumuman' => 3,
        ]);

        Pengumuman::factory()->create([
            'id' => 5,
            'judul' => 'Judul Pengumuman',
            'isi' => 'Isi Pengumuman',
            'id_role_for_pengumuman' => 3,
            'id_kelas_for_pengumuman' => 4,
        ]);

        Pengumuman::factory()->create([
            'id' => 6,
            'judul' => 'Judul Pengumuman',
            'isi' => 'Isi Pengumuman',
            'id_role_for_pengumuman' => 3,
            'id_kelas_for_pengumuman' => 5,
        ]);

        Pengumuman::factory()->create([
            'id' => 7,
            'judul' => 'Judul Pengumuman',
            'isi' => 'Isi Pengumuman',
            'id_role_for_pengumuman' => 3,
            'id_kelas_for_pengumuman' => 6,
        ]);

    }
}
