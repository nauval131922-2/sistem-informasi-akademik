<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CitaCita;
use Illuminate\Support\Facades\Validator;

class CitaCitaController extends Controller
{
    public function index()
    {
        $semua_cita_cita = CitaCita::all();
        $title = 'Data Cita-cita';

        return view('backend.cita-cita.index', compact('semua_cita_cita', 'title'));
    }

    function fetch()
    {
        $semua_cita_cita = CitaCita::all();
        $title = 'Data Cita-cita';

        return response()->json([
            'data' => $semua_cita_cita
        ]);
    }

    public function tambah()
    {
        $title = 'Data Cita-cita';

        return view('backend.cita-cita.tambah', compact('title'));
    }

    public function simpan(Request $request)
    {
        // validator
        $validator = Validator::make($request->all(), [
            'cita_cita' => 'required|unique:cita_citas,cita_cita'
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        // simpan ke database
        $cita_cita = new CitaCita;
        $cita_cita->cita_cita = $request->cita_cita;


        // jika berhasil tersimpan
        if ($cita_cita->save()) {
            return response()->json(['status' => 'success', 'message' => 'Data berhasil disimpan.']);
        } else {
            return response()->json(['status' => 'error2', 'message' => 'Gagal menyimpan data.']);
        }
    }

    public function edit($id)
    {
        $cita_cita = CitaCita::find($id);

        $title = 'Data Cita-cita';

        return view('backend.cita-cita.edit', compact('cita_cita', 'title'));
    }

    public function update(Request $request, $id)
    {
        // validator
        $validator = Validator::make($request->all(), [
            'cita_cita' => 'required|unique:cita_citas,cita_cita,' . $id
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        // update ke database
        $cita_cita = CitaCita::find($id);
        $cita_cita->cita_cita = $request->cita_cita;


        // jika berhasil diubah
        if ($cita_cita->save()) {
            return response()->json(['status' => 'success', 'message' => 'Data berhasil diubah.']);
        } else {
            return response()->json(['status' => 'error2', 'message' => 'Gagal mengubah data.']);
        }
    }

    public function hapus($id)
    {
        $cita_cita = CitaCita::find($id);
        if ($cita_cita->delete()) {
            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data.']);
        }
    }
}
