<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function kelas(){
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }

    public function pekerjaanAyah(){
        return $this->belongsTo(Pekerjaan::class, 'id_pekerjaan_ayah_for_siswa', 'id');
    }

    public function pekerjaanIbu(){
        return $this->belongsTo(Pekerjaan::class, 'id_pekerjaan_ibu_for_siswa', 'id');
    }
    public function pekerjaanWali(){
        return $this->belongsTo(Pekerjaan::class, 'id_pekerjaan_wali_for_siswa', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user_for_siswa', 'id');
    }
}
