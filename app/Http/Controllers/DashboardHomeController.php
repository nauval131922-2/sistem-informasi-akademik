<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\User;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardHomeController extends Controller
{
    public function index(){
        $semua_user = User::all();
        $semua_guru = User::where('id_role', '=', '2')->orwhere('id_role', '=', '3')->orwhere('id_role', '=', '4')->count();
        $semua_kelas = Kelas::all();
        $semua_mata_pelajaran = MataPelajaran::all();
        $semua_ekstrakurikuler = Ekstrakurikuler::all();

        if (Auth::user()->id_role === 1 || Auth::user()->id_role === 2 || Auth::user()->id_role === 3 || Auth::user()->id_role === 4) {
            $pengumuman = Pengumuman::where('id_role_for_pengumuman', '1')->first();
        } else if (Auth::user()->id_role === 5) {
            $pengumuman = Pengumuman::where('id_role_for_pengumuman', '3')->where('id_kelas_for_pengumuman', Auth::user()->id_kelas)->first();
        }

        $title = 'Home';

        return view('backend.home.index', compact('title', 'pengumuman', 'semua_user', 'semua_guru', 'semua_kelas', 'semua_mata_pelajaran', 'semua_ekstrakurikuler'));
    }

    // fetch
    public function fetch(){
        if (Auth::user()->id_role === 1 || Auth::user()->id_role === 2 || Auth::user()->id_role === 3 || Auth::user()->id_role === 4) {
            $pengumuman = Pengumuman::where('id_role_for_pengumuman', '1')->first();
        } else if (Auth::user()->id_role === 5) {
            $pengumuman = Pengumuman::where('id_role_for_pengumuman', '3')->where('id_kelas_for_pengumuman', Auth::user()->id_kelas)->first();
        }

        // updated at diff for humans
        $pengumuman->updated_at_diff_for_humans = $pengumuman->updated_at->diffForHumans();

        // updated at date format(d-m-Y)
        $pengumuman->updated_at_date_format = $pengumuman->updated_at->format('d-m-Y');
        
        return response()->json([
            'data' => $pengumuman
        ]);
    }
}
