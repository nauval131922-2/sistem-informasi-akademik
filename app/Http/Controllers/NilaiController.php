<?php

namespace App\Http\Controllers;

use Whoops\Run;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class NilaiController extends Controller
{
    public function index()
    {
        $semua_nilai = Nilai::all();
        $title = 'Data Nilai';

        return view('backend.nilai.index', compact('semua_nilai', 'title'));
    }

    public function index_nilai_ulangan_harian($id)
    {
        // $semua_nilai = Nilai::where('id_kelas_for_nilai', $id)->where('tipe_nilai', 'Ulangan Harian')->get();

        if (Auth::user()->id_role === 1 || Auth::user()->id_role === 2) {
            $semua_nilai = Nilai::where('id_kelas_for_nilai', $id)->where('tipe_nilai', 'Ulangan Harian')->get();
        } else if (Auth::user()->id_role === 3 || Auth::user()->id_role === 4) {
            $semua_nilai = Nilai::where('id_kelas_for_nilai', $id)->where('tipe_nilai', 'Ulangan Harian')->where('id_guru_for_nilai', Auth::user()->id)->get();
        } else if (Auth::user()->id_role === 5) {
            $semua_nilai = Nilai::where('id_kelas_for_nilai', $id)->where('tipe_nilai', 'Ulangan Harian')->where('id_siswa_for_nilai', Auth::user()->id)->get();
        }

        $title = 'Data Nilai Ulangan Harian' . ' ' . Kelas::find($id)->nama;
        $id_kelas = $id;

        return view('backend.nilai.index', compact('semua_nilai', 'title', 'id_kelas'));
    }

    public function index_nilai_tugas($id)
    {
        // $semua_nilai = Nilai::where('id_kelas_for_nilai', $id)->where('tipe_nilai', 'tugas')->get();

        if (Auth::user()->id_role === 1 || Auth::user()->id_role === 2) {
            $semua_nilai = Nilai::where('id_kelas_for_nilai', $id)->where('tipe_nilai', 'Tugas')->get();
        } else if (Auth::user()->id_role === 3 || Auth::user()->id_role === 4) {
            $semua_nilai = Nilai::where('id_kelas_for_nilai', $id)->where('tipe_nilai', 'Tugas')->where('id_guru_for_nilai', Auth::user()->id)->get();
        } else if (Auth::user()->id_role === 5) {
            $semua_nilai = Nilai::where('id_kelas_for_nilai', $id)->where('tipe_nilai', 'Tugas')->where('id_siswa_for_nilai', Auth::user()->id)->get();
        }

        $title = 'Data Nilai Tugas' . ' ' . Kelas::find($id)->nama;
        $id_kelas = $id;

        return view('backend.nilai.index', compact('semua_nilai', 'title', 'id_kelas'));
    }

    public function index_nilai_uts($id)
    {
        // $semua_nilai = Nilai::where('id_kelas_for_nilai', $id)->where('tipe_nilai', 'UTS')->get();

        if (Auth::user()->id_role === 1 || Auth::user()->id_role === 2) {
            $semua_nilai = Nilai::where('id_kelas_for_nilai', $id)->where('tipe_nilai', 'UTS')->get();
        } else if (Auth::user()->id_role === 3 || Auth::user()->id_role === 4) {
            $semua_nilai = Nilai::where('id_kelas_for_nilai', $id)->where('tipe_nilai', 'UTS')->where('id_guru_for_nilai', Auth::user()->id)->get();
        } else if (Auth::user()->id_role === 5) {
            $semua_nilai = Nilai::where('id_kelas_for_nilai', $id)->where('tipe_nilai', 'UTS')->where('id_siswa_for_nilai', Auth::user()->id)->get();
        }

        $title = 'Data Nilai UTS' . ' ' . Kelas::find($id)->nama;
        $id_kelas = $id;

        return view('backend.nilai.index', compact('semua_nilai', 'title', 'id_kelas'));
    }

    public function index_nilai_uas($id)
    {
        // $semua_nilai = Nilai::where('id_kelas_for_nilai', $id)->where('tipe_nilai', 'UAS')->get();

        if (Auth::user()->id_role === 1 || Auth::user()->id_role === 2) {
            $semua_nilai = Nilai::where('id_kelas_for_nilai', $id)->where('tipe_nilai', 'UAS')->get();
        } else if (Auth::user()->id_role === 3 || Auth::user()->id_role === 4) {
            $semua_nilai = Nilai::where('id_kelas_for_nilai', $id)->where('tipe_nilai', 'UAS')->where('id_guru_for_nilai', Auth::user()->id)->get();
        } else if (Auth::user()->id_role === 5) {
            $semua_nilai = Nilai::where('id_kelas_for_nilai', $id)->where('tipe_nilai', 'UAS')->where('id_siswa_for_nilai', Auth::user()->id)->get();
        }

        $title = 'Data Nilai UAS' . ' ' . Kelas::find($id)->nama;
        $id_kelas = $id;

        return view('backend.nilai.index', compact('semua_nilai', 'title', 'id_kelas'));
    }

    public function index_nilai_rapor($id)
    {
        $semua_nilai = Nilai::where('id_kelas_for_nilai', $id)->where('tipe_nilai', 'Rapor')->get();
        $title = 'Data Nilai Rapor' . ' ' . Kelas::find($id)->nama;
        $id_kelas = $id;

        return view('backend.nilai.index', compact('semua_nilai', 'title', 'id_kelas'));
    }

    // public function tambah_nilai_ulangan_harian($id){
    public function tambah_nilai_ulangan_harian()
    {
        // $semua_siswa = User::where('id_role', '5')->where('id_kelas', $id)->get();
        // semua siswa
        $semua_siswa = User::where('id_role', '5')->get();

        // $semua_guru = User::where('id_role', '3')->orWhere('id_role', '4')->get();

        if (Auth::user()->id_role === 1) {
            $semua_guru = User::where('id_role', '3')->orWhere('id_role', '4')->orWhere('id_role', '2')->get();
        } else if (Auth::user()->id_role === 2 || Auth::user()->id_role === 3 || Auth::user()->id_role === 4) {
            $semua_guru = User::where('id', Auth::user()->id)->get();
        }

        // $semua_mapel = MataPelajaran::all();

        if (Auth::user()->id_role === 1 || Auth::user()->id_role === 2) {
            $semua_mapel = MataPelajaran::all();
        } else if (Auth::user()->id_role === 4) {
            // cari nama mapel di tabel MataPelajaran berdasarkan id_mapel di tabel user
            $semua_mapel = MataPelajaran::where('id', Auth::user()->id_mapel)->first();
        } else if (Auth::user()->id_role === 3) {
            // cari semua mapel yang tidak diajar oleh id_role 4
            $semua_mapel = MataPelajaran::whereNotIn('id', User::where('id_role', '4')->pluck('id_mapel'))->get();
        }

        $semua_tipe_nilai = ['Ulangan Harian', 'Tugas', 'UTS', 'UAS', 'Rapor'];
        // $title = 'Data Nilai Ulangan Harian' . ' ' . Kelas::find($id)->nama;
        $title = 'Data Nilai Ulangan Harian';
        // $id_kelas = $id;
        // $nama_kelas = Kelas::find($id)->nama;
        // semua kelas
        $semua_kelas = Kelas::all();

        return view('backend.nilai.tambah', compact('semua_siswa', 'semua_guru', 'semua_mapel', 'semua_tipe_nilai', 'title', 'semua_kelas'));
    }

    // public function tambah_nilai_tugas($id)
    public function tambah_nilai_tugas()
    {
        // $semua_siswa = User::where('id_role', '5')->where('id_kelas', $id)->get();
        // $semua_guru = User::where('id_role', '3')->orWhere('id_role', '4')->get();

        // semua siswa
        $semua_siswa = User::where('id_role', '5')->get();

        if (Auth::user()->id_role === 1) {
            $semua_guru = User::where('id_role', '3')->orWhere('id_role', '4')->orWhere('id_role', '2')->get();
        } else if (Auth::user()->id_role === 2 || Auth::user()->id_role === 3 || Auth::user()->id_role === 4) {
            $semua_guru = User::where('id', Auth::user()->id)->get();
        }

        // $semua_mapel = MataPelajaran::all();

        if (Auth::user()->id_role === 1 || Auth::user()->id_role === 2) {
            $semua_mapel = MataPelajaran::all();
        } else if (Auth::user()->id_role === 4) {
            // cari nama mapel di tabel MataPelajaran berdasarkan id_mapel di tabel user
            $semua_mapel = MataPelajaran::where('id', Auth::user()->id_mapel)->first();
        } else if (Auth::user()->id_role === 3) {
            // cari semua mapel yang tidak diajar oleh id_role 4
            $semua_mapel = MataPelajaran::whereNotIn('id', User::where('id_role', '4')->pluck('id_mapel'))->get();
        }

        $semua_tipe_nilai = ['Ulangan Harian', 'Tugas', 'UTS', 'UAS', 'Rapor'];
        $title = 'Data Nilai Tugas';
        // $id_kelas = $id;
        // $nama_kelas = Kelas::find($id)->nama;
        // semua kelas
        $semua_kelas = Kelas::all();

        return view('backend.nilai.tambah', compact('semua_siswa', 'semua_guru', 'semua_mapel', 'semua_tipe_nilai', 'title', 'semua_kelas'));
    }

    // public function tambah_nilai_uts($id)
    public function tambah_nilai_uts()
    {
        // $semua_siswa = User::where('id_role', '5')->where('id_kelas', $id)->get();
        // $semua_guru = User::where('id_role', '3')->orWhere('id_role', '4')->get();

        // semua siswa
        $semua_siswa = User::where('id_role', '5')->get();

        if (Auth::user()->id_role === 1) {
            $semua_guru = User::where('id_role', '3')->orWhere('id_role', '4')->orWhere('id_role', '2')->get();
        } else if (Auth::user()->id_role === 2 || Auth::user()->id_role === 3 || Auth::user()->id_role === 4) {
            $semua_guru = User::where('id', Auth::user()->id)->get();
        }

        // $semua_mapel = MataPelajaran::all();

        if (Auth::user()->id_role === 1 || Auth::user()->id_role === 2) {
            $semua_mapel = MataPelajaran::all();
        } else if (Auth::user()->id_role === 4) {
            // cari nama mapel di tabel MataPelajaran berdasarkan id_mapel di tabel user
            $semua_mapel = MataPelajaran::where('id', Auth::user()->id_mapel)->first();
        } else if (Auth::user()->id_role === 3) {
            // cari semua mapel yang tidak diajar oleh id_role 4
            $semua_mapel = MataPelajaran::whereNotIn('id', User::where('id_role', '4')->pluck('id_mapel'))->get();
        }

        $semua_tipe_nilai = ['Ulangan Harian', 'Tugas', 'UTS', 'UAS', 'Rapor'];
        $title = 'Data Nilai UTS';
        // $id_kelas = $id;
        // $nama_kelas = Kelas::find($id)->nama;
        // semua kelas
        $semua_kelas = Kelas::all();

        return view('backend.nilai.tambah', compact('semua_siswa', 'semua_guru', 'semua_mapel', 'semua_tipe_nilai', 'title', 'semua_kelas'));
    }

    // public function tambah_nilai_uas($id)
    public function tambah_nilai_uas()
    {
        // $semua_siswa = User::where('id_role', '5')->where('id_kelas', $id)->get();
        // $semua_guru = User::where('id_role', '3')->orWhere('id_role', '4')->get();

        // semua siswa
        $semua_siswa = User::where('id_role', '5')->get();

        if (Auth::user()->id_role === 1) {
            $semua_guru = User::where('id_role', '3')->orWhere('id_role', '4')->orWhere('id_role', '2')->get();
        } else if (Auth::user()->id_role === 2 || Auth::user()->id_role === 3 || Auth::user()->id_role === 4) {
            $semua_guru = User::where('id', Auth::user()->id)->get();
        }

        // $semua_mapel = MataPelajaran::all();

        if (Auth::user()->id_role === 1 || Auth::user()->id_role === 2) {
            $semua_mapel = MataPelajaran::all();
        } else if (Auth::user()->id_role === 4) {
            // cari nama mapel di tabel MataPelajaran berdasarkan id_mapel di tabel user
            $semua_mapel = MataPelajaran::where('id', Auth::user()->id_mapel)->first();
        } else if (Auth::user()->id_role === 3) {
            // cari semua mapel yang tidak diajar oleh id_role 4
            $semua_mapel = MataPelajaran::whereNotIn('id', User::where('id_role', '4')->pluck('id_mapel'))->get();
        }

        $semua_tipe_nilai = ['Ulangan Harian', 'Tugas', 'UTS', 'UAS', 'Rapor'];
        $title = 'Data Nilai UAS';
        // $id_kelas = $id;
        // $nama_kelas = Kelas::find($id)->nama;

        // semua kelas
        $semua_kelas = Kelas::all();

        return view('backend.nilai.tambah', compact('semua_siswa', 'semua_guru', 'semua_mapel', 'semua_tipe_nilai', 'title', 'semua_kelas'));
    }

    public function simpan(Request $request)
    {

        // validator
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'guru' => 'required',
            'mapel' => 'required',
            'tipe_nilai' => 'required',
            'kelas' => 'required',
        ]);

        // jika validor gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        // semua siswa yang ada di kelas yang dipilih
        $semua_siswa = User::where('id_role', '5')->where('id_kelas', $request->kelas)->count();

        // jika nilai yang diinputkan lebih dari 100 maka akan muncul notifikasi error
        for ($i = 0; $i < $semua_siswa; $i++) {
            if ($request->input('nilai' . $i + 1) > 100) {

                return response()->json([
                    'status' => 'error2',
                    'message' => 'Nilai tidak boleh lebih dari 100'
                ]);
            }
        }

        // get tahun ajaran dengan status aktif
        $tahun_ajaran = TahunAjaran::where('status', 'Aktif')->first();

        // cek apakah judul nilai sudah ada
        $cek_judul_nilai = Nilai::where('id_kelas_for_nilai', $request->kelas)->where('id_guru_for_nilai', $request->guru)->where('id_mapel_for_nilai', $request->mapel)->where('tipe_nilai', $request->tipe_nilai)->where('judul', $request->judul)->where('id_tahun_ajaran_for_nilai', $tahun_ajaran->id)->count();

        if ($cek_judul_nilai > 0) {

            return response()->json([
                'status' => 'error3',
                'message' => 'Data nilai sudah ada'
            ]);
        } else {
            // insert multiple data based on number of semua siswa
            for ($i = 0; $i < $semua_siswa; $i++) {
                if ($i < $semua_siswa) {

                    if (Auth::user()->id_role === 1) {
                        $guru = $request->guru;
                    } else if (Auth::user()->id_role === 2 || Auth::user()->id_role === 3 || Auth::user()->id_role === 4) {
                        $guru = Auth::user()->id;
                    }

                    

                    Nilai::create([
                        'judul' => $request->judul,
                        'id_kelas_for_nilai' => $request->kelas,
                        'id_siswa_for_nilai' => $request->input('siswa' . $i + 1),
                        'id_guru_for_nilai' => $guru,
                        'id_mapel_for_nilai' => $request->mapel,
                        'id_tahun_ajaran_for_nilai' => $tahun_ajaran->id,
                        'tipe_nilai' => $request->tipe_nilai,
                        'nilai' => $request->input('nilai' . $i + 1),
                    ]);
                }
            }

            // jika berhasil disimpan
            return response()->json([
                'status' => 'success',
                'message' => 'Data Nilai Berhasil Ditambahkan'
            ]);
        }
    }

    public function hapus($id)
    {
        $nilai = Nilai::find($id);
        // $id_kelas = $nilai->id_kelas_for_nilai;
        // $nilai->delete();

        // $notification = array(
        //     'message' => 'Data Nilai Berhasil Dihapus',
        //     'alert-type' => 'success'
        // );

        // if ($nilai->tipe_nilai == 'Ulangan Harian') {
        //     return redirect()->route('nilai-ulangan-harian-index-kelas', $id_kelas)->with($notification);
        // } elseif ($nilai->tipe_nilai == 'Tugas') {
        //     return redirect()->route('nilai-tugas-index-kelas', $id_kelas)->with($notification);
        // } elseif ($nilai->tipe_nilai == 'UTS') {
        //     return redirect()->route('nilai-uts-index-kelas', $id_kelas)->with($notification);
        // } elseif ($nilai->tipe_nilai == 'UAS') {
        //     return redirect()->route('nilai-uas-index-kelas', $id_kelas)->with($notification);
        // } elseif ($nilai->tipe_nilai == 'Rapor') {
        //     return redirect()->route('nilai-rapor-index-kelas', $id_kelas)->with($notification);
        // }

        // jika berhasil dihapus
        if ($nilai->delete()) {
            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data.']);
        }
    }

    public function edit($id)
    {
        $nilai = Nilai::find($id);
        // $semua_siswa = User::where('id_role', '5')->where('id_kelas', $nilai->id_kelas_for_nilai)->get();
        $semua_guru = User::where('id_role', '3')->orWhere('id_role', '4')->orwhere('id_role', '2')->get();
        // $semua_mapel = MataPelajaran::all();

        if (Auth::user()->id_role === 1 || Auth::user()->id_role === 2) {
            $semua_mapel = MataPelajaran::all();
        } else if (Auth::user()->id_role === 4) {
            // cari nama mapel di tabel MataPelajaran berdasarkan id_mapel di tabel user
            $semua_mapel = MataPelajaran::where('id', Auth::user()->id_mapel)->first();
        } else if (Auth::user()->id_role === 3) {
            // cari semua mapel yang tidak diajar oleh id_role 4
            $semua_mapel = MataPelajaran::whereNotIn('id', User::where('id_role', '4')->pluck('id_mapel'))->get();
        }

        $semua_tipe_nilai = ['Ulangan Harian', 'Tugas', 'UTS', 'UAS', 'Rapor'];
        $title = 'Data Nilai ' . $nilai->tipe_nilai . ' ' . Kelas::find($nilai->id_kelas_for_nilai)->nama;
        $id_kelas = $nilai->id_kelas_for_nilai;
        // get judul nilai
        $judul = $nilai->judul;

        // semua kelas
        $semua_kelas = Kelas::all();

        // get semua nilai siswa dengan judul, id_kelas_for_nilai, id_guru_for_nilai, id_mapel_for_nilai, dan tipe_nilai yang sama dengan old data dari nilai yang akan diedit
        $semua_siswa = Nilai::where('judul', $judul)->where('id_kelas_for_nilai', $nilai->id_kelas_for_nilai)->where('id_guru_for_nilai', $nilai->id_guru_for_nilai)->where('id_mapel_for_nilai', $nilai->id_mapel_for_nilai)->where('tipe_nilai', $nilai->tipe_nilai)->where('id_tahun_ajaran_for_nilai', $nilai->id_tahun_ajaran_for_nilai)->get();

        return view('backend.nilai.edit', compact('nilai', 'semua_siswa', 'semua_guru', 'semua_mapel', 'semua_tipe_nilai', 'title', 'id_kelas', 'judul', 'semua_kelas'));
    }

    public function update(Request $request, $id)
    {

        // validator
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'guru' => 'required',
            'mapel' => 'required',
            'tipe_nilai' => 'required',
            'kelas' => 'required',
        ]);

        // jika validor gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        // count siswa dengan id_kelas = $id
        $semua_siswa = User::where('id_role', '5')->where('id_kelas', $request->kelas)->count();
        // jika nilai yang diinputkan lebih dari 100 maka akan muncul notifikasi error
        for ($i = 0; $i < $semua_siswa; $i++) {
            if ($request->input('nilai' . $i + 1) > 100) {

                return response()->json([
                    'status' => 'error2',
                    'message' => 'Nilai tidak boleh lebih dari 100'
                ]);
            }
        }

        // $cek_judul_nilai = Nilai::where('id_kelas_for_nilai', $request->kelas)->where('id_guru_for_nilai', $request->guru)->where('id_mapel_for_nilai', $request->mapel)->where('tipe_nilai', $request->tipe_nilai)->where('judul', $request->judul)->count();

        // cek judul nilai looping sebanyak jumlah siswa
        // $cek_judul_nilai = 0;
        // for ($i = 0; $i < $semua_siswa; $i++) {
            // $cek_judul_nilai = Nilai::where('id_kelas_for_nilai', $request->kelas)->where('id_guru_for_nilai', $request->guru)->where('id_mapel_for_nilai', $request->mapel)->where('tipe_nilai', $request->tipe_nilai)->where('judul', $request->judul)->where('id', '!=', $request->input('id_nilai' . $i + 1))->count();

        // }
        
        // cek judul nilai kecuali semua id_nilai yang sedang diupdate
        $id_nilai = [];
        for ($i = 0; $i < $semua_siswa; $i++) {
            $id_nilai[] = $request->input('id_nilai' . $i + 1);
        }

        // get tahun ajaran dengan status aktif
        $tahun_ajaran = TahunAjaran::where('status', 'Aktif')->first();

        $cek_judul_nilai = Nilai::where('judul', $request->judul)->where('id_kelas_for_nilai', $request->kelas)->where('id_guru_for_nilai', $request->guru)->where('id_mapel_for_nilai', $request->mapel)->where('tipe_nilai', $request->tipe_nilai)->where('id_tahun_ajaran_for_nilai', $request->old_tahun_ajaran)->whereNotIn('id', $id_nilai)->count();

        if ($cek_judul_nilai > 0) {

            return response()->json([
                'status' => 'error3',
                'message' => 'Data nilai sudah ada'
            ]);
        } else {

            // hapus semua data nilai dengan judul, id_kelas_for_nilai, id_guru_for_nilai, id_mapel_for_nilai, dan tipe_nilai yang sama dengan old data dari nilai yang akan diupdate
            Nilai::where('judul', $request->old_judul)->where('id_kelas_for_nilai', $request->kelas)->where('id_guru_for_nilai', $request->old_guru)->where('id_mapel_for_nilai', $request->old_mapel)->where('tipe_nilai', $request->tipe_nilai)->where('id_tahun_ajaran_for_nilai', $request->old_tahun_ajaran)->delete();

            // insert multiple data based on number of semua siswa
            for ($i = 0; $i < $semua_siswa; $i++) {
                if ($i < $semua_siswa) {

                    if (Auth::user()->id_role === 1) {
                        $guru = $request->guru;
                    } else if (Auth::user()->id_role === 2 || Auth::user()->id_role === 3 || Auth::user()->id_role === 4) {
                        $guru = Auth::user()->id;
                    }

                    Nilai::create([
                        'judul' => $request->judul,
                        'id_kelas_for_nilai' => $request->kelas,
                        'id_siswa_for_nilai' => $request->input('siswa' . $i + 1),
                        'id_guru_for_nilai' => $guru,
                        'id_mapel_for_nilai' => $request->mapel,
                        'id_tahun_ajaran_for_nilai' => $request->old_tahun_ajaran,
                        'tipe_nilai' => $request->tipe_nilai,
                        'nilai' => $request->input('nilai' . $i + 1),
                    ]);
                }
            }

            // jika berhasil disimpan
            return response()->json([
                'status' => 'success',
                'message' => 'Data Nilai Berhasil Diubah'
            ]);
        }
    }

    function filter(Request $request)
    {
        $nilai = Nilai::with('kelas', 'siswa', 'guru', 'mapel');

        // filter berdasarkan tipe jadwal
        if ($request->tipe_nilai != null) {
            $nilai->where('tipe_nilai', $request->tipe_nilai);
        }

        // filter berdasarkan kelas
        // jika auth user id role tidak sama dengan 5 (siswa)
        if (Auth::user()->id_role != 5) {
            if ($request->kelas != null) {
                $nilai->where('id_kelas_for_nilai', $request->kelas);
            }
        } else {
            $nilai->where('id_kelas_for_nilai', Auth::user()->id_kelas);
        }

        // filter berdasarkan tahun ajaran
        if ($request->tahun_ajaran != null) {
            $nilai->where('id_tahun_ajaran_for_nilai', $request->tahun_ajaran);
        }

        // filter berdasarkan guru jika auth user id_role yang sedang login =2
        if (Auth::user()->id_role === 2) {
            if ($request->guru != null) {
                $nilai->where('id_guru_for_nilai', $request->guru);
            }
        } else if (Auth::user()->id_role === 3 || Auth::user()->id_role === 4) {
            $nilai->where('id_guru_for_nilai', Auth::user()->id);
        } else if (Auth::user()->id_role === 5) {
            $nilai->where('id_siswa_for_nilai', Auth::user()->id);
        }

        $nilai = $nilai->get();

        return response()->json([
            'data' => $nilai
        ]);
    }

    public function getDataSiswa(Request $request)
    {

        // $kelas = Kelas::findOrFail($id);
        // get id_kelas_for_nilai dari nilai yang akan diedit
        $kelas = Nilai::with('kelas', 'siswa', 'guru', 'mapel');
        // $id_kelas = $kelas->where('id', $request->id)->pluck('id_kelas_for_nilai')->first();

        $kelas = Kelas::findOrFail($request->kelas);

        // get nama kelas dari nilai yang akan diedit
        // $kelas = Kelas::where('id', $id_kelas)->pluck('nama')->first();

        $daftar_siswa = User::where('id_role', 5)->where('id_kelas', $request->kelas)->get();
        $nilai_siswa = [];
        $id_nilai = [];
        foreach ($daftar_siswa as $siswa) {


            // $nilai = Nilai::where('id_siswa_for_nilai', $siswa->id)->pluck('nilai')->first() ?? '';

            // get nilai siswa berdasarkan old_judul, old_kelas, old_guru, old_mapel, dan tipe_nilai
            $nilai = Nilai::where('judul', $request->old_judul)->where('id_kelas_for_nilai', $request->kelas)->where('id_guru_for_nilai', $request->old_guru)->where('id_mapel_for_nilai', $request->old_mapel)->where('tipe_nilai', $request->tipe_nilaii)->where('id_siswa_for_nilai', $siswa->id)->where('id_tahun_ajaran_for_nilai', $request->old_tahun_ajaran)->pluck('nilai')->first() ?? '';

            // $semua_siswa = Nilai::where('judul', $judul)->where('id_kelas_for_nilai', $nilai->id_kelas_for_nilai)->where('id_guru_for_nilai', $nilai->id_guru_for_nilai)->where('id_mapel_for_nilai', $nilai->id_mapel_for_nilai)->where('tipe_nilai', $nilai->tipe_nilai)->get();

            $id = Nilai::where('judul', $request->old_judul)->where('id_kelas_for_nilai', $request->kelas)->where('id_guru_for_nilai', $request->old_guru)->where('id_mapel_for_nilai', $request->old_mapel)->where('tipe_nilai', $request->tipe_nilaii)->where('id_siswa_for_nilai', $siswa->id)->where('id_tahun_ajaran_for_nilai', $request->old_tahun_ajaran)->pluck('id')->first() ?? '';

            $nilai_siswa[] = $nilai;

            $id_nilai[] = $id;
        }
        return response()->json([
            'kelas' => $kelas->nama,
            'siswa' => $daftar_siswa,
            'nilai' => $nilai_siswa,
            'id_nilai' => $id_nilai
        ]);
    }
}
