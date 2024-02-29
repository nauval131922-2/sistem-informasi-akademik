<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SiswaController extends Controller
{
    public function index(){
        $semua_siswa = Siswa::all();

        return view('backend.siswa.index', compact('semua_siswa'));
    }

    public function tambah(){
        $semua_kelas = Kelas::all();

        return view('backend.siswa.tambah', compact('semua_kelas'));
    }

    public function simpan(Request $request){
        $request->validate([
            'nama' => 'required',
            'kelas' => 'required',
            'nis' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'desa' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'nomor_hp' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'asal_sekolah' => 'required',
            'tanggal_masuk' => 'required',
        ]);
        
        // check nis
        $siswa = Siswa::where('nis', $request->nis)->first();
        if ($siswa) {
            $notification = array(
                'message' => 'NIS sudah terdaftar',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        $siswa = new Siswa;
        $siswa->nama = $request->nama;
        $siswa->id_kelas = $request->kelas;
        $siswa->nis = $request->nis;
        $siswa->tempat_lahir = $request->tempat_lahir;
        $siswa->tanggal_lahir = $request->tanggal_lahir;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->alamat = $request->desa.' RT '.$request->rt.' RW '.$request->rw.', '.$request->kecamatan.', '.$request->kabupaten;
        $siswa->nomor_hp = $request->nomor_hp;
        $siswa->nama_ayah = $request->nama_ayah;
        $siswa->nama_ibu = $request->nama_ibu;
        $siswa->asal_sekolah = $request->asal_sekolah;
        $siswa->tanggal_masuk = $request->tanggal_masuk;

        if ($request->hasFile('foto')) {
            $nama_file = hexdec(uniqid()).'.'.$request->foto->getClientOriginalExtension();
            Image::make($request->foto)->resize(300, 300)->save(public_path('/upload/foto_siswa/'.$nama_file));

            $siswa->foto = 'upload/foto_siswa/'.$nama_file;
        }

        $siswa->save();

        $notification = array(
            'message' => 'Data siswa berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('siswa-index')->with($notification);
    }

    public function edit($id){
        $siswa = Siswa::find($id);
        $semua_kelas = Kelas::all();

        return view('backend.siswa.edit', compact('siswa', 'semua_kelas'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'nama' => 'required',
            'kelas' => 'required',
            'nis' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'nomor_hp' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'asal_sekolah' => 'required',
            'tanggal_masuk' => 'required',
        ]);
        
        // check nis except self
        $siswa = Siswa::where('nis', $request->nis)->where('id', '!=', $id)->first();
        if ($siswa) {
            $notification = array(
                'message' => 'NIS sudah terdaftar',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
        
        $siswa = Siswa::find($id);
        $siswa->nama = $request->nama;
        $siswa->id_kelas = $request->kelas;
        $siswa->nis = $request->nis;
        $siswa->tempat_lahir = $request->tempat_lahir;
        $siswa->tanggal_lahir = $request->tanggal_lahir;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->alamat = $request->alamat;
        $siswa->nomor_hp = $request->nomor_hp;
        $siswa->nama_ayah = $request->nama_ayah;
        $siswa->nama_ibu = $request->nama_ibu;
        $siswa->asal_sekolah = $request->asal_sekolah;
        $siswa->tanggal_masuk = $request->tanggal_masuk;

        if ($request->hasFile('foto')) {

            if ($siswa->foto) {
                unlink($siswa->foto);
            }

            $nama_file = hexdec(uniqid()).'.'.$request->foto->getClientOriginalExtension();
            Image::make($request->foto)->resize(300, 300)->save(public_path('/upload/foto_siswa/'.$nama_file));

            $siswa->foto = 'upload/foto_siswa/'.$nama_file;
        }

        $siswa->save();

        $notification = array(
            'message' => 'Data siswa berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('siswa-index')->with($notification);
    }

    public function hapus($id){
        $siswa = Siswa::find($id);
        if ($siswa->foto) {
            unlink($siswa->foto);
        }
        $siswa->delete();

        $notification = array(
            'message' => 'Data siswa berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect()->route('siswa-index')->with($notification);
    }

    public function siswa_kelas_1_index(){
        $semua_siswa = Siswa::where('id_kelas', 1)->get();

        return view('backend.siswa.index', compact('semua_siswa'));
    }

    public function siswa_kelas_2_index(){
        $semua_siswa = Siswa::where('id_kelas', 2)->get();

        return view('backend.siswa.index', compact('semua_siswa'));
    }

    public function siswa_kelas_3_index(){
        $semua_siswa = Siswa::where('id_kelas', 3)->get();

        return view('backend.siswa.index', compact('semua_siswa'));
    }

    public function siswa_kelas_4_index(){
        $semua_siswa = Siswa::where('id_kelas', 4)->get();

        return view('backend.siswa.index', compact('semua_siswa'));
    }

    public function siswa_kelas_5_index(){
        $semua_siswa = Siswa::where('id_kelas', 5)->get();

        return view('backend.siswa.index', compact('semua_siswa'));
    }


    public function siswa_kelas_6_index(){
        $semua_siswa = Siswa::where('id_kelas', 6)->get();

        return view('backend.siswa.index', compact('semua_siswa'));
    }
}
