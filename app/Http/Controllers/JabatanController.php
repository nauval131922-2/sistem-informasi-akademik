<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index(){
        $semua_jabatan = Jabatan::all();

        return view('backend.jabatan.index', compact('semua_jabatan'));
    }

    public function tambah(){
        $semua_kelas = Kelas::all();

        return view('backend.jabatan.tambah', compact('semua_kelas'));
    }

    public function simpan(Request $request){
        $request->validate([
            'nama' => 'required',
        ],);

        $jabatan = new Jabatan;
        $jabatan->nama = $request->nama;

        // check duplicate
        $jabatan_duplicate = Jabatan::where('nama', $request->nama)->first();
        if ($jabatan_duplicate) {
            $notification = array(
                'message' => 'Jabatan sudah terdaftar',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        $jabatan->save();

        $notification = array(
            'message' => 'Jabatan berhasil ditambah',
            'alert-type' => 'success'
        );

        return redirect()->route('jabatan-index')->with($notification);
    }

    public function hapus($id){
        $jabatan = Jabatan::find($id);
        $jabatan->delete();

        $notification = array(
            'message' => 'Jabatan berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function edit($id){
        $jabatan = Jabatan::find($id);

        return view('backend.jabatan.edit', compact('jabatan'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'nama' => 'required',
        ],);

        $jabatan = Jabatan::find($id);
        $jabatan->nama = $request->nama;

        // check duplicate except self
        $jabatan_duplicate = Jabatan::where('nama', $request->nama)->where('id', '!=', $id)->first();
        if ($jabatan_duplicate) {
            $notification = array(
                'message' => 'Jabatan sudah terdaftar',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        $jabatan->save();

        $notification = array(
            'message' => 'Jabatan berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('jabatan-index')->with($notification);
    }
}
