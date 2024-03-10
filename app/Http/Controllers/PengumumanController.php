<?php

namespace App\Http\Controllers;

use Whoops\Run;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class PengumumanController extends Controller
{
    public function index(){
        $pengumuman = Pengumuman::where('id_role_for_pengumuman', '1')->first();

        // jika pengumuman belum ada
        if ($pengumuman == null) {
            $pengumuman = new Pengumuman();
            $pengumuman->judul = 'Judul Pengumuman';
            $pengumuman->isi = 'Isi Pengumuman';
            $pengumuman->id_role_for_pengumuman = 1;
            $pengumuman->id_kelas_for_pengumuman = null;
            $pengumuman->gambar = null;
            $pengumuman->save();
        }

        $title = 'Data Pengumuman';

        return view('backend.pengumuman.index', compact('pengumuman', 'title'));
    }

    public function index_pengumuman_for_siswa(){
        $pengumuman = Pengumuman::where('id_role_for_pengumuman', '3')->where('id_kelas_for_pengumuman', Auth::user()->id_kelas)->first();

        // jika pengumuman belum ada
        if ($pengumuman == null) {
            $pengumuman = new Pengumuman();
            $pengumuman->judul = 'Judul Pengumuman';
            $pengumuman->isi = 'Isi Pengumuman';
            $pengumuman->id_role_for_pengumuman = 3;
            // jika yang login adalah siswa, maka id_kelas_for_pengumuman diisi dengan id_kelas dari siswa yang login
            if (Auth::user()->id_role == 5) {
                $pengumuman->id_kelas_for_pengumuman = Auth::user()->id_kelas;
            } else {
                $pengumuman->id_kelas_for_pengumuman = null;
            }
            $pengumuman->gambar = null;
            $pengumuman->save();
        }

        $title = 'Data Pengumuman';

        return view('backend.pengumuman_for_siswa.index', compact('pengumuman', 'title'));
    }

    public function update(Request $request, $id){
        // $request->validate([
        //     'judul' => 'required',
        //     'isi' => 'required',
        // ]);

        // validator
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'isi' => 'required',
        ]);

        // jika validator gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        $pengumuman = Pengumuman::find($id);
        $pengumuman->judul = $request->judul;
        $pengumuman->isi = $request->isi;

        // jika belum ada folder upload/pengumuman, maka buat folder tersebut
        if (!file_exists('upload/pengumuman')) {
            mkdir('upload/pengumuman', 0777, true);
        }

        if ($request->hasFile('gambar')) {

            if ($pengumuman->gambar) {
                unlink($pengumuman->gambar);
            }

            $judul_tanpa_spasi = str_replace(' ', '-', $request->judul);
            $nama_file = $judul_tanpa_spasi.'-'.hexdec(uniqid()).'.'.$request->gambar->getClientOriginalExtension();
            Image::make($request->gambar)->save(public_path('/upload/pengumuman/'.$nama_file));

            $pengumuman->gambar = 'upload/pengumuman/'.$nama_file;
        } elseif ($request->gambarPreview == null && $pengumuman->gambar != null) {
            unlink($pengumuman->gambar);

            $pengumuman->gambar = null;
        } elseif($request->gambarPreview != null && $pengumuman->gambar != null){
            // get $pengumuman->gambar file extension
            $file_ext = pathinfo($pengumuman->gambar, PATHINFO_EXTENSION);

            $judul_tanpa_spasi = str_replace(' ', '-', $request->judul);
            $nama_file = $judul_tanpa_spasi.'-'.hexdec(uniqid()).'.'.$file_ext;
            // rename file name
            rename(public_path($pengumuman->gambar), public_path('/upload/pengumuman/'.$nama_file));

            $pengumuman->gambar = 'upload/pengumuman/'.$nama_file;
        }

        // $pengumuman->save();

        // $notification = array(
        //     'message' => 'Pengumuman berhasil diubah!',
        //     'alert-type' => 'success'
        // );

        // return redirect()->route('dashboard')->with($notification);

        // jika berhasil diubah
        if ($pengumuman->save()) {
            return response()->json(['status' => 'success', 'message' => 'Data berhasil diubah.']);
        } else {
            return response()->json(['status' => 'error2', 'message' => 'Gagal mengubah data.']);
        }
    }

    public function update_pengumuman_for_siswa(Request $request, $id){
        // $request->validate([
        //     'judul' => 'required',
        //     'isi' => 'required',
        // ]);

        // validator
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'isi' => 'required',
        ]);

        // jika validator gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        $pengumuman = Pengumuman::find($id);
        $pengumuman->judul = $request->judul;
        $pengumuman->isi = $request->isi;

        // if ($request->hasFile('gambar')) {

        //     if ($pengumuman->gambar) {
        //         unlink($pengumuman->gambar);
        //     }

        //     $nama_file = hexdec(uniqid()).'.'.$request->gambar->getClientOriginalExtension();
        //     Image::make($request->gambar)->save(public_path('/upload/pengumuman/'.$nama_file));

        //     $pengumuman->gambar = 'upload/pengumuman/'.$nama_file;
        // } elseif ($request->gambarPreview == null && $pengumuman->gambar != null) {
        //     unlink($pengumuman->gambar);

        //     $pengumuman->gambar = null;
        // };

        if ($request->hasFile('gambar')) {

            if ($pengumuman->gambar) {
                unlink($pengumuman->gambar);
            }

            $judul_tanpa_spasi = str_replace(' ', '-', $request->judul);
            $nama_file = $judul_tanpa_spasi.'-'.hexdec(uniqid()).'.'.$request->gambar->getClientOriginalExtension();
            Image::make($request->gambar)->save(public_path('/upload/pengumuman/'.$nama_file));

            $pengumuman->gambar = 'upload/pengumuman/'.$nama_file;
        } elseif ($request->gambarPreview == null && $pengumuman->gambar != null) {
            unlink($pengumuman->gambar);

            $pengumuman->gambar = null;
        } elseif($request->gambarPreview != null && $pengumuman->gambar != null){
            // get $pengumuman->gambar file extension
            $file_ext = pathinfo($pengumuman->gambar, PATHINFO_EXTENSION);

            $judul_tanpa_spasi = str_replace(' ', '-', $request->judul);
            $nama_file = $judul_tanpa_spasi.'-'.hexdec(uniqid()).'.'.$file_ext;
            // rename file name
            rename(public_path($pengumuman->gambar), public_path('/upload/pengumuman/'.$nama_file));

            $pengumuman->gambar = 'upload/pengumuman/'.$nama_file;
        }

        // $pengumuman->save();

        // $notification = array(
        //     'message' => 'Pengumuman berhasil diubah!',
        //     'alert-type' => 'success'
        // );

        // return redirect()->back()->with($notification);

        // jika berhasil diubah
        if ($pengumuman->save()) {
            return response()->json(['status' => 'success', 'message' => 'Data berhasil diubah.']);
        } else {
            return response()->json(['status' => 'error2', 'message' => 'Gagal mengubah data.']);
        }
    }

    function fetch()
    {
        // get data pengumuman
        $pengumuman = Pengumuman::where('id_role_for_pengumuman', '3')->where('id_kelas_for_pengumuman', Auth::user()->id_kelas)->first();

        return response()->json([
            'data' => $pengumuman
        ]);
    }


}
