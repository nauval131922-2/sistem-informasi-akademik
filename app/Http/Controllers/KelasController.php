<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\JadwalPelajaran;
use Intervention\Image\Facades\Image;

class KelasController extends Controller
{
    public function index(){
        $semua_kelas = Kelas::all();
        
        return view('backend.kelas.index', compact('semua_kelas'));
    }

    public function tambah(){
        return view('backend.kelas.tambah');
    }

    public function simpan(Request $request){
        $request->validate([
            'nama' => 'required|unique:kelas|max:255',
        ]);

        $kelas = new Kelas;
        $kelas->nama = $request->nama;
        $kelas->save();

        $notification = array(
            'message' => 'Kelas berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('kelas-index')->with($notification);
    }

    public function detail($id){
        $kelas = Kelas::find($id);
        $semua_siswa = Siswa::where('id_kelas', $id)->get();
        $wali_kelas = Guru::where('id_kelas', $id)->first();
        $jadwal_pelajaran = JadwalPelajaran::where('id_kelas', $id)->get();

        return view('backend.kelas.detail', compact('kelas', 'semua_siswa', 'wali_kelas', 'jadwal_pelajaran'));
    }

    public function tambah_siswa($id){
        $kelas = Kelas::find($id);

        return view('backend.kelas.tambah-siswa', compact('kelas'));
    }

    public function simpan_siswa(Request $request, $id){
        $id = $request->id_kelas;

        $request->validate([
            'id_kelas' => 'required',
            'nama' => 'required',
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
        $siswa->id_kelas = $id;
        $siswa->nama = $request->nama;
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

        return redirect()->route('kelas-detail', $id)->with($notification);
    }

    public function edit($id){
        $kelas = Kelas::find($id);

        return view('backend.kelas.edit', compact('kelas'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'nama' => 'required|unique:kelas|max:255',
        ]);

        $kelas = Kelas::find($id);
        $kelas->nama = $request->nama;
        $kelas->save();

        $notification = array(
            'message' => 'Kelas berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('kelas-index')->with($notification);
    }

    public function hapus($id){
        $kelas = Kelas::find($id);

        $kelas->delete();
        
        return redirect()->back();
    }

    public function edit_siswa($id, $id_siswa){
        $kelas = Kelas::find($id);
        $siswa = Siswa::find($id_siswa);

        return view('backend.kelas.edit-siswa', compact('kelas', 'siswa'));
    }

    public function update_siswa(Request $request, $id, $id_siswa){
        $request->validate([
            'nama' => 'required',
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

        // check nis
        $siswa = Siswa::where('nis', $request->nis)->first();
        if ($siswa) {
            $notification = array(
                'message' => 'NIS sudah terdaftar',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        $siswa = Siswa::find($id_siswa);
        $siswa->id_kelas = $id;
        $siswa->nama = $request->nama;
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

            if($siswa->foto != null){
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

        return redirect()->route('kelas-detail', $id)->with($notification);
    }

    public function hapus_siswa($id, $id_siswa){
        $siswa = Siswa::find($id_siswa);

        if($siswa->foto != null){
            unlink($siswa->foto);
        }

        $siswa->delete();

        return redirect()->back();
    }
}
