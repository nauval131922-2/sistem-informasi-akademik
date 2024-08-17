<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestasiSiswa extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function siswa(){
        return $this->belongsTo(User::class, 'id_user_for_prestasi_siswa', 'id');
    }
}
