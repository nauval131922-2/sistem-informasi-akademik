<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hobi;
use Illuminate\Support\Facades\Validator;

class HobiController extends Controller
{
    public function index()
    {
        $semua_hobi = Hobi::all();
        $title = 'Data Hobi';

        return view('backend.Hobi.index', compact('semua_hobi', 'title'));
    }

    function fetch()
    {
        $semua_hobi = Hobi::all();
        $title = 'Data Hobi';

        return response()->json([
            'data' => $semua_hobi
        ]);
    }

    public function tambah()
    {
        $title = 'Data Hobi';

        return view('backend.Hobi.tambah', compact('title'));
    }

    public function simpan(Request $request)
    {
        // validator
        $validator = Validator::make($request->all(), [
            'hobi' => 'required|unique:hobis,hobi'
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        // simpan ke database
        $hobi = new Hobi;
        $hobi->hobi = $request->hobi;


        // jika berhasil tersimpan
        if ($hobi->save()) {
            return response()->json(['status' => 'success', 'message' => 'Data berhasil disimpan.']);
        } else {
            return response()->json(['status' => 'error2', 'message' => 'Gagal menyimpan data.']);
        }
    }

    public function edit($id)
    {
        $hobi = Hobi::find($id);

        $title = 'Data Hobi';

        return view('backend.Hobi.edit', compact('hobi', 'title'));
    }

    public function update(Request $request, $id)
    {
        // validator
        $validator = Validator::make($request->all(), [
            'hobi' => 'required|unique:hobis,hobi,' . $id
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        // update ke database
        $hobi = Hobi::find($id);
        $hobi->hobi = $request->hobi;


        // jika berhasil diubah
        if ($hobi->save()) {
            return response()->json(['status' => 'success', 'message' => 'Data berhasil diubah.']);
        } else {
            return response()->json(['status' => 'error2', 'message' => 'Gagal mengubah data.']);
        }
    }

    public function hapus($id)
    {
        $hobi = Hobi::find($id);
        if ($hobi->delete()) {
            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data.']);
        }
    }
}
