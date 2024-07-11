<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use Illuminate\Support\Facades\Validator;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $semua_mata_pelajaran = MataPelajaran::all();
        $title = 'Data Mata Pelajaran';

        return view('backend.mata-pelajaran.index', compact('semua_mata_pelajaran', 'title'));
    }

    function fetch()
    {
        $semua_mata_pelajaran = MataPelajaran::all();
        $title = 'Data Mata Pelajaran';

        return response()->json([
            'data' => $semua_mata_pelajaran
        ]);
    }

    public function tambah()
    {
        $title = 'Data Mata Pelajaran';

        return view('backend.mata-pelajaran.tambah', compact('title'));
    }

    public function simpan(Request $request)
    {
        // validator
        $validator = Validator::make($request->all(), [
            'mata_pelajaran' => 'required|unique:mata_pelajarans,mata_pelajaran'
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        // simpan ke database
        $mata_pelajaran = new MataPelajaran;
        $mata_pelajaran->mata_pelajaran = $request->mata_pelajaran;
        $mata_pelajaran->nilai_batas_kelulusan = $request->nilai_batas_kelulusan;

        // jika berhasil tersimpan
        if ($mata_pelajaran->save()) {
            return response()->json(['status' => 'success', 'message' => 'Data berhasil disimpan.']);
        } else {
            return response()->json(['status' => 'error2', 'message' => 'Gagal menyimpan data.']);
        }
    }

    public function edit($id)
    {
        $mata_pelajaran = MataPelajaran::find($id);

        $title = 'Data Mata Pelajaran';

        return view('backend.mata-pelajaran.edit', compact('mata_pelajaran', 'title'));
    }

    public function update(Request $request, $id)
    {
        // validator
        $validator = Validator::make($request->all(), [
            'mata_pelajaran' => 'required|unique:mata_pelajarans,mata_pelajaran,' . $id
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        // update ke database
        $mata_pelajaran = MataPelajaran::find($id);
        $mata_pelajaran->mata_pelajaran = $request->mata_pelajaran;
        $mata_pelajaran->nilai_batas_kelulusan = $request->nilai_batas_kelulusan;

        // jika berhasil diubah
        if ($mata_pelajaran->save()) {
            return response()->json(['status' => 'success', 'message' => 'Data berhasil diubah.']);
        } else {
            return response()->json(['status' => 'error2', 'message' => 'Gagal mengubah data.']);
        }
    }

    public function hapus($id)
    {
        $mata_pelajaran = MataPelajaran::find($id);
        // $mata_pelajaran->delete();



        // return redirect()->back();

        // notifikasi menggunakan alert javascript biasa
        // return redirect()->back()->with('success', 'Mata pelajaran berhasil dihapus');

        // jika berhasil dihapus
        if ($mata_pelajaran->delete()) {
            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data.']);
        }
    }
}
