<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function kelas(){
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }

    public function mapel(){
        return $this->belongsTo(MataPelajaran::class, 'id_mapel', 'id');
    }
}
