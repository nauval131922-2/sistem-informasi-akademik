<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function kelas(){
        return $this->belongsTo(Kelas::class, 'id_kelas_for_nilai', 'id');
    }

    public function siswa(){
        return $this->belongsTo(User::class, 'id_siswa_for_nilai', 'id');
    }

    public function guru(){
        return $this->belongsTo(User::class, 'id_guru_for_nilai' ,'id');
    }

    public function mapel(){
        return $this->belongsTo(MataPelajaran::class, 'id_mapel_for_nilai', 'id');
    }

    public function tahun_ajaran(){
        return $this->belongsTo(TahunAjaran::class, 'id_tahun_ajaran_for_nilai', 'id');
    }
}
