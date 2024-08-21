<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PrestasiSiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PrestasiSiswaController extends Controller
{
    public function index()
    {
        $semua_prestasi_siswa = PrestasiSiswa::all();
        $title = 'Data Prestasi Siswa';

        return view('backend.prestasi-siswa.index', compact('semua_prestasi_siswa', 'title'));
    }

    function fetch()
    {
        if (Auth::user()->id_role == 1 || Auth::user()->id_role == 2) {
            $semua_prestasi_siswa = PrestasiSiswa::with('siswa')->get();
        } elseif (Auth::user()->id_role == 3) {
            // Assuming the User model has a relationship to the Siswa model
            $id_kelas = Auth::user()->id_kelas;

            $semua_prestasi_siswa = PrestasiSiswa::with('siswa')
                ->whereHas('siswa', function ($query) use ($id_kelas) {
                    $query->where('id_kelas', $id_kelas);
                })->get();
        }


        return response()->json([
            'data' => $semua_prestasi_siswa
        ]);
    }

    public function tambah()
    {
        $title = 'Data Prestasi Siswa';

        // jika yang login admin
        if (Auth::user()->id_role == 1) {
            $semua_siswa = User::where('id_role', '5')->get();
        } elseif (Auth::user()->id_role == 3) {
            $semua_siswa = User::where('id_role', '5')->where('id_kelas', Auth::user()->id_kelas)->get();
        }

        return view('backend.prestasi-siswa.tambah', compact('title', 'semua_siswa'));
    }

    public function simpan(Request $request)
    {
        // validator
        $validator = Validator::make($request->all(), [
            'siswa' => 'required',
            'prestasi_siswa' => 'required',
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        // jika ada siswa dan prestasi siswa yang sama
        if (PrestasiSiswa::where('id_user_for_prestasi_siswa', $request->siswa)->where('prestasi_siswa', $request->prestasi_siswa)->exists()) {
            return response()->json(['status' => 'error2', 'message' => 'Prestasi siswa yang sama sudah ada.']);
        }

        // simpan ke database
        $prestasi_siswa = new PrestasiSiswa;
        $prestasi_siswa->id_user_for_prestasi_siswa = $request->siswa;
        $prestasi_siswa->prestasi_siswa = $request->prestasi_siswa;

        // jika berhasil tersimpan
        if ($prestasi_siswa->save()) {
            return response()->json(['status' => 'success', 'message' => 'Data berhasil disimpan.']);
        } else {
            return response()->json(['status' => 'error2', 'message' => 'Gagal menyimpan data.']);
        }
    }

    public function edit($id)
    {
        $prestasi_siswa = PrestasiSiswa::find($id);

        $title = 'Data Prestasi Siswa';

        return view('backend.prestasi-siswa.edit', compact('prestasi_siswa', 'title'));
    }

    public function update(Request $request, $id)
    {
        // validator
        $validator = Validator::make($request->all(), [
            'prestasi_siswa' => 'required|unique:prestasi_siswas,prestasi_siswa,' . $id
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        // update ke database
        $prestasi_siswa = PrestasiSiswa::find($id);
        $prestasi_siswa->prestasi_siswa = $request->prestasi_siswa;
        $prestasi_siswa->nilai_batas_kelulusan = $request->nilai_batas_kelulusan;

        // jika berhasil diubah
        if ($prestasi_siswa->save()) {
            return response()->json(['status' => 'success', 'message' => 'Data berhasil diubah.']);
        } else {
            return response()->json(['status' => 'error2', 'message' => 'Gagal mengubah data.']);
        }
    }

    public function hapus($id)
    {
        $prestasi_siswa = PrestasiSiswa::find($id);
        // $prestasi_siswa->delete();



        // return redirect()->back();

        // notifikasi menggunakan alert javascript biasa
        // return redirect()->back()->with('success', 'Prestasi Siswa berhasil dihapus');

        // jika berhasil dihapus
        if ($prestasi_siswa->delete()) {
            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data.']);
        }
    }
}
