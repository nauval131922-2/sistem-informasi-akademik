<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilSekolah;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class ProfilSekolahController extends Controller
{
    public function index(){
        $profil_sekolah = ProfilSekolah::find(1);
        $visi_misi = ProfilSekolah::find(1);
        $media_sosial = ProfilSekolah::find(1);
        $title = 'Data Profil Sekolah';

        // tampilkan view index dengan data profil sekolah
        return view('backend.profil_sekolah.index', compact('profil_sekolah', 'title', 'visi_misi', 'media_sosial'));
    }

    public function update(Request $request, $id){

        // validator
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'alamat' => 'required',
            'nomor_hp' => 'nullable|numeric',
            'email' => 'nullable|email',
            'twitter' => 'nullable',
            'facebook' => 'nullable',
            'youtube' => 'nullable',
            'instagram' => 'nullable',
            'visi' => 'required',
            'misi' => 'required',
            'tujuan' => 'required',
            'gambar' => 'nullable|image',
        ]);

        // jika validator gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }


        $profil_sekolah = ProfilSekolah::find($id);
        $profil_sekolah->nama = $request->nama;
        $profil_sekolah->alamat = $request->alamat;
        $profil_sekolah->hp = $request->nomor_hp;
        $profil_sekolah->email = $request->email;
        $profil_sekolah->twitter = $request->twitter;
        $profil_sekolah->facebook = $request->facebook;
        $profil_sekolah->youtube = $request->youtube;
        $profil_sekolah->instagram = $request->instagram;
        $profil_sekolah->visi = $request->visi;
        $profil_sekolah->misi = $request->misi;
        $profil_sekolah->tujuan = $request->tujuan;

        if ($request->hasFile('gambar')) {

            if ($profil_sekolah->logo) {
                unlink($profil_sekolah->logo);
            }

            $judul_tanpa_spasi = str_replace(' ', '-', $request->nama);
            $nama_file = $judul_tanpa_spasi.'-'.hexdec(uniqid()).'.'.$request->gambar->getClientOriginalExtension();
            Image::make($request->gambar)->save(public_path('/upload/logo_sekolah/'.$nama_file));

            $profil_sekolah->logo = 'upload/logo_sekolah/'.$nama_file;
        } elseif ($request->gambarPreview == null && $profil_sekolah->logo != null) {
            unlink($profil_sekolah->logo);

            $profil_sekolah->logo = null;
        } elseif ($request->gambarPreview != null && $profil_sekolah->logo != null) {
            // get file extension
            $file_ext = pathinfo($profil_sekolah->logo, PATHINFO_EXTENSION);

            $judul_tanpa_spasi = str_replace(' ', '-', $request->nama);
            $nama_file = $judul_tanpa_spasi.'-'.hexdec(uniqid()).'.'.$file_ext;
            // rename file name
            rename(public_path($profil_sekolah->logo), public_path('upload/logo_sekolah/'.$nama_file));

            $profil_sekolah->logo = 'upload/logo_sekolah/'.$nama_file;
        }

        // $profil_sekolah->save();

        // $notification = array(
        //     'message' => 'Profil sekolah berhasil diubah',
        //     'alert-type' => 'success'
        // );

        // return redirect()->back()->withinput()->with($notification);

        // jika berhasil disimpan
        if ($profil_sekolah->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Profil Sekolah berhasil diubah'
            ]);
        } else {
            return response()->json([
                'status' => 'error2',
                'message' => 'Profil Sekolah gagal diubah'
            ]);
        }
    }

    function fetch()
    {
        // get data user yang login
        $profil_sekolah = ProfilSekolah::find(1);

        return response()->json([
            'data' => $profil_sekolah
        ]);
    }
}
