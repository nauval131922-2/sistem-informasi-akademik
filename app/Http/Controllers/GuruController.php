<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jabatan;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class GuruController extends Controller
{
    public function index(){
        $semua_guru = Guru::all();

        return view('backend.guru.index', compact('semua_guru'));
    }

    public function tambah(){
        $semua_jabatan = Jabatan::all();
        $semua_kelas = Kelas::all();
        $semua_mapel = MataPelajaran::all();

        return view('backend.guru.tambah', compact('semua_kelas', 'semua_mapel', 'semua_jabatan' ));
    }

    public function simpan(Request $request){
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'jabatan' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'desa' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'nomor_hp' => 'required',
        ]);

        $guru = new Guru;
        $guru->nama = $request->nama;
        $guru->nip = $request->nip;
        $guru->id_jabatan = $request->jabatan;
        $guru->id_kelas = $request->kelas;
        $guru->id_mapel = $request->mapel;
        $guru->tempat_lahir = $request->tempat_lahir;
        $guru->tanggal_lahir = $request->tanggal_lahir;
        $guru->jenis_kelamin = $request->jenis_kelamin;
        $guru->alamat = $request->desa.' RT '.$request->rt.' RW '.$request->rw.', '.$request->kecamatan.', '.$request->kabupaten;
        $guru->nomor_hp = $request->nomor_hp;

        // cek nip apakah sudah ada atau belum
        $cek_nip = Guru::where('nip', $request->nip)->first();
        if($cek_nip){
            $notification = array(
                'message' => 'NIP sudah ada',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        // cek duplicate jika id jabatan = 2 dan id kelas same
        $duplicate = Guru::where('id_jabatan', 2)->where('id_kelas', $request->kelas)->first();
        if($duplicate){
            $notification = array(
                'message' => 'Guru dengan jabatan dan kelas yang sama sudah ada',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        if ($request->hasFile('foto')) {
            $nama_file = hexdec(uniqid()).'.'.$request->foto->getClientOriginalExtension();
            Image::make($request->foto)->resize(300, 300)->save(public_path('/upload/foto_guru/'.$nama_file));

            $guru->foto = 'upload/foto_guru/'.$nama_file;
        }

        $guru->save();

        $notification = array(
            'message' => 'Data guru berhasil ditambahkan',
            'alert-type' => 'success'
        );
        
        if ($request->jabatan == 2) {
            return redirect()->route('guru-wali-kelas-index')->with($notification);
        } else if ($request->jabatan == 3) {
            return redirect()->route('guru-mata-pelajaran-index')->with($notification);
        } else {
            return redirect()->route('guru')->with($notification);
        }
    }

    public function edit($id){
        $guru = Guru::find($id);

        return view('backend.guru.edit', compact('guru'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'nomor_hp' => 'required',
        ]);

        $guru = Guru::find($id);
        $guru->nama = $request->nama;
        $guru->nip = $request->nip;
        $guru->tempat_lahir = $request->tempat_lahir;
        $guru->tanggal_lahir = $request->tanggal_lahir;
        $guru->jenis_kelamin = $request->jenis_kelamin;
        $guru->alamat = $request->alamat;
        $guru->nomor_hp = $request->nomor_hp;

        if ($request->hasFile('foto')) {

            if ($guru->foto) {
                unlink($guru->foto);
            }

            $nama_file = hexdec(uniqid()).'.'.$request->foto->getClientOriginalExtension();
            Image::make($request->foto)->resize(300, 300)->save(public_path('/upload/foto_guru/'.$nama_file));

            $guru->foto = 'upload/foto_guru/'.$nama_file;
        }

        $guru->save();

        $notification = array(
            'message' => 'Data guru berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('guru')->with($notification);
    }

    public function hapus($id){
        $guru = Guru::find($id);

        if ($guru->foto) {
            unlink($guru->foto);
        }

        $guru->delete();
        
        return redirect()->back();
    }

    public function guru_wali_kelas_index(){
        $semua_guru = Guru::where('id_jabatan', 2)->get();

        return view('backend.guru.index', compact('semua_guru'));
    }

    public function guru_mata_pelajaran_index(){
        $semua_guru = Guru::where('id_jabatan', 3)->get();

        return view('backend.guru.index', compact('semua_guru'));
    }
}
