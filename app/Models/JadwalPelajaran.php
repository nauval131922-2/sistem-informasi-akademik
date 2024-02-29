<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPelajaran extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function kelas(){
        return $this->belongsTo(Kelas::class, 'id_kelas_for_jadwal', 'id');
    }

    public function mapel(){
        return $this->belongsTo(MataPelajaran::class, 'id_mapel_for_jadwal', 'id');
    }

    public function ekstra(){
        return $this->belongsTo(Ekstrakurikuler::class, 'id_ekstra_for_jadwal', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_guru_for_jadwal', 'id');
    }

    public function jam(){
        return $this->belongsTo(JamPelajaran::class, 'id_jam_for_jadwal', 'id');
    }
}
