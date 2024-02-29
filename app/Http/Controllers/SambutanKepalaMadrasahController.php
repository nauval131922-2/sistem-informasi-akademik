<?php

namespace App\Http\Controllers;

use App\Models\MediaSosial;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProfilSekolah;
use Intervention\Image\Facades\Image;
use App\Models\SambutanKepalaMadrasah;
use Illuminate\Support\Facades\Validator;

class SambutanKepalaMadrasahController extends Controller
{
    public function index(){
        $sambutan = SambutanKepalaMadrasah::find(1);
        $title = 'Data Sambutan Kepala Madrasah';

        return view('backend.sambutan_kepala_madrasah.index', compact('sambutan', 'title'));
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

        $sambutan = SambutanKepalaMadrasah::find($id);
        $sambutan->judul = $request->judul;
        $sambutan->isi = $request->isi;
        $sambutan->excerpt = Str::limit(strip_tags($request->isi), 500);

        if ($request->hasFile('gambar')) {

            if ($sambutan->gambar) {
                unlink($sambutan->gambar);
            }

            $judul_tanpa_spasi = str_replace(' ', '-', $request->judul);
            $nama_file = $judul_tanpa_spasi.'-'.hexdec(uniqid()).'.'.$request->gambar->getClientOriginalExtension();
            // Image::make($request->gambar)->save(public_path('/upload/sambutan/'.$nama_file));
            Image::make($request->gambar)->resize(500, 500)->save(public_path('/upload/sambutan/'.$nama_file));

            $sambutan->gambar = 'upload/sambutan/'.$nama_file;
        } elseif ($request->gambarPreview == null && $sambutan->gambar != null) {
            unlink($sambutan->gambar);

            $sambutan->gambar = null;
        } elseif ($request->gambarPreview != null && $sambutan->gambar != null) {
            // get file extension
            $file_ext = pathinfo($sambutan->gambar, PATHINFO_EXTENSION);

            $judul_tanpa_spasi = str_replace(' ', '-', $request->judul);
            $nama_file = $judul_tanpa_spasi.'-'.hexdec(uniqid()).'.'.$file_ext;
            // rename file name
            rename(public_path($sambutan->gambar), public_path('upload/sambutan/'.$nama_file));

            $sambutan->gambar = 'upload/sambutan/'.$nama_file;
        };

        // $sambutan->save();

        // $notification = array(
        //     'message' => 'Sambutan Kepala Madrasah berhasil diubah!',
        //     'alert-type' => 'success'
        // );

        // return redirect()->route('sambutan-kepala-madrasah-index')->with($notification);

        // jika berhasil diubah
        if ($sambutan->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Sambutan Kepala Madrasah berhasil diubah!'
            ]);
        } else {
            return response()->json([
                'status' => 'error2',
                'message' => 'Sambutan Kepala Madrasah gagal diubah!'
            ]);
        }
    }

    public function index_fe(){
        // get profil sekolah
        $profil_sekolah = ProfilSekolah::find(1);

        return view('frontend.profil.sambutan', compact('profil_sekolah'));
    }

    function fetch()
    {
        // get data user yang login
        $sambutan = SambutanKepalaMadrasah::find(1);

        return response()->json([
            'data' => $sambutan
        ]);
    }
}
