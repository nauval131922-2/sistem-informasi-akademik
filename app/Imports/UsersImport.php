<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        // return new User([
        //     'name' => $row['nama'],
        //     'id_kelas' => $row['kelas'],
        //     'username' => $row['nama'],
        //     'password' => bcrypt('12345678'),
        //     'id_role' => 5
        // ]);

        // Membuat user baru
        $user = new User([
            'name' => $row['nama'],
            'id_kelas' => $row['kelas'],
            'username' => $row['nama'],
            'password' => bcrypt('12345678'),
            'id_role' => 5
        ]);

        // Menyimpan user ke database
        $user->save();

        // Membuat entri baru di tabel Siswa dengan id dari user yang baru saja disimpan
        $siswa = new Siswa([
            'id_user_for_siswa' => $user->id,
        ]);

        // Menyimpan entri siswa ke database
        $siswa->save();

        return $user;
    }
}
