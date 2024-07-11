<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pekerjaan;
use Illuminate\Support\Facades\Validator;

class PekerjaanController extends Controller
{
    public function index()
    {
        $semua_Pekerjaan = Pekerjaan::all();
        $title = 'Data Pekerjaan';

        return view('backend.Pekerjaan.index', compact('semua_Pekerjaan', 'title'));
    }

    function fetch()
    {
        $semua_Pekerjaan = Pekerjaan::all();
        $title = 'Data Pekerjaan';

        return response()->json([
            'data' => $semua_Pekerjaan
        ]);
    }

    public function tambah()
    {
        $title = 'Data Pekerjaan';

        return view('backend.Pekerjaan.tambah', compact('title'));
    }

    public function simpan(Request $request)
    {
        // validator
        $validator = Validator::make($request->all(), [
            'pekerjaan' => 'required|unique:pekerjaans,pekerjaan'
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        // simpan ke database
        $Pekerjaan = new Pekerjaan;
        $Pekerjaan->pekerjaan = $request->pekerjaan;


        // jika berhasil tersimpan
        if ($Pekerjaan->save()) {
            return response()->json(['status' => 'success', 'message' => 'Data berhasil disimpan.']);
        } else {
            return response()->json(['status' => 'error2', 'message' => 'Gagal menyimpan data.']);
        }
    }

    public function edit($id)
    {
        $pekerjaan = Pekerjaan::find($id);

        $title = 'Data Pekerjaan';

        return view('backend.Pekerjaan.edit', compact('pekerjaan', 'title'));
    }

    public function update(Request $request, $id)
    {
        // validator
        $validator = Validator::make($request->all(), [
            'pekerjaan' => 'required|unique:pekerjaans,pekerjaan,' . $id
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        // update ke database
        $pekerjaan = Pekerjaan::find($id);
        $pekerjaan->pekerjaan = $request->pekerjaan;


        // jika berhasil diubah
        if ($pekerjaan->save()) {
            return response()->json(['status' => 'success', 'message' => 'Data berhasil diubah.']);
        } else {
            return response()->json(['status' => 'error2', 'message' => 'Gagal mengubah data.']);
        }
    }

    public function hapus($id)
    {
        $Pekerjaan = Pekerjaan::find($id);
        if ($Pekerjaan->delete()) {
            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data.']);
        }
    }
}
