<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Models\MediaSosial;
use Illuminate\Http\Request;
use App\Models\ProfilSekolah;
use App\Models\SaranaPrasarana;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class SaranaPrasaranaController extends Controller
{
    public function index(){
        $semua_sarana_prasarana = SaranaPrasarana::all();
        $title = 'Data Sarana Prasarana';

        return view('backend.sarana_prasarana.index', compact('semua_sarana_prasarana', 'title'));
    }

    public function tambah(){
        $title = 'Data Sarana Prasarana';

        return view('backend.sarana_prasarana.tambah', compact('title'));
    }

    public function simpan(Request $request){
        // $this->validate($request, [
        //     'nama' => 'required',
        // ]);

        // validator
        $validator = Validator::make($request->all(), [
            'nama' => 'required|unique:sarana_prasaranas,nama',
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        $sarana_prasarana = new SaranaPrasarana;
        $sarana_prasarana->nama = $request->nama;

        // jika belum ada folder upload/sarana_prasarana
        if (!file_exists('upload/sarana_prasarana')) {
            mkdir('upload/sarana_prasarana', 0777, true);
        }

        if ($request->hasFile('gambar')) {

            $judul_tanpa_spasi = str_replace(' ', '-', $request->nama);
            $nama_file = $judul_tanpa_spasi.'-'.hexdec(uniqid()).'.'.$request->gambar->getClientOriginalExtension();
            Image::make($request->gambar)->save(public_path('/upload/sarana_prasarana/'.$nama_file));

            $sarana_prasarana->gambar = 'upload/sarana_prasarana/'.$nama_file;
        }

        // jika lolos validasi
        // if($sarana_prasarana->save()){
        //     $notification = array(
        //         'message' => 'Data Sarana Prasarana Berhasil Ditambahkan',
        //         'alert-type' => 'success'
        //     );

        //     return redirect()->route('sarana-prasarana-index')->with($notification);
        // }else{
        //     $notification = array(
        //         'message' => 'Data Sarana Prasarana Gagal Ditambahkan',
        //         'alert-type' => 'error'
        //     );

        //     return redirect()->back()->withinput()->with($notification);
        // }

        // jika berhasil simpan
        if ($sarana_prasarana->save()) {
            return response()->json(['status' => 'success', 'message' => 'Data berhasil disimpan.']);
        } else {
            return response()->json(['status' => 'error2', 'message' => 'Gagal menyimpan data.']);
        }
    }

    public function edit($id){
        $sarana_prasarana = SaranaPrasarana::find($id);
        $title = 'Data Sarana Prasarana';

        return view('backend.sarana_prasarana.edit', compact('sarana_prasarana', 'title'));
    }

    public function update(Request $request, $id){
        // $this->validate($request, [
        //     'nama' => 'required',
        // ]);

        // validator
        $validator = Validator::make($request->all(), [
            'nama' => 'required|unique:sarana_prasaranas,nama,'.$id,
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        $sarana_prasarana = SaranaPrasarana::find($id);
        $sarana_prasarana->nama = $request->nama;

        if ($request->hasFile('gambar')) {

            if ($sarana_prasarana->gambar) {
                unlink($sarana_prasarana->gambar);
            }

            $judul_tanpa_spasi = str_replace(' ', '-', $request->nama);
            $nama_file = $judul_tanpa_spasi.'-'.hexdec(uniqid()).'.'.$request->gambar->getClientOriginalExtension();
            Image::make($request->gambar)->save(public_path('/upload/sarana_prasarana/'.$nama_file));

            $sarana_prasarana->gambar = 'upload/sarana_prasarana/'.$nama_file;
        } elseif ($request->gambarPreview == null && $sarana_prasarana->gambar != null) {
            unlink($sarana_prasarana->gambar);

            $sarana_prasarana->gambar = null;
        } elseif ($request->gambarPreview != null && $sarana_prasarana->gambar != null) {
            // get file extension
            $file_ext = pathinfo($sarana_prasarana->gambar, PATHINFO_EXTENSION);

            $judul_tanpa_spasi = str_replace(' ', '-', $request->nama);
            $nama_file = $judul_tanpa_spasi.'-'.hexdec(uniqid()).'.'.$file_ext;
            // rename file name
            rename(public_path($sarana_prasarana->gambar), public_path('upload/sarana_prasarana/'.$nama_file));

            $sarana_prasarana->gambar = 'upload/sarana_prasarana/'.$nama_file;
        }

        // jika lolos validasi
        // if($sarana_prasarana->save()){
        //     $notification = array(
        //         'message' => 'Data Sarana Prasarana Berhasil Diubah',
        //         'alert-type' => 'success'
        //     );

        //     return redirect()->route('sarana-prasarana-index')->with($notification);
        // }else{
        //     $notification = array(
        //         'message' => 'Data Sarana Prasarana Gagal Diubah',
        //         'alert-type' => 'error'
        //     );

        //     return redirect()->back()->withinput()->with($notification);
        // }

        // jika berhasil update
        if ($sarana_prasarana->save()) {
            return response()->json(['status' => 'success', 'message' => 'Data berhasil diubah.']);
        } else {
            return response()->json(['status' => 'error2', 'message' => 'Gagal mengubah data.']);
        }
    }

    public function hapus($id){
        $sarana_prasarana = SaranaPrasarana::find($id);

        if ($sarana_prasarana->gambar) {
            unlink($sarana_prasarana->gambar);
        }

        // $sarana_prasarana->delete();

        // $notification = array(
        //     'message' => 'Data Sarana Prasarana Berhasil Dihapus',
        //     'alert-type' => 'success'
        // );

        // return redirect()->back()->with($notification);

        // jika berhasil hapus
        if ($sarana_prasarana->delete()) {
            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data.']);
        }
    }

    public function index_fe(){
        $semua_sarana_prasarana = SaranaPrasarana::all();
        $title = 'Sarana Prasarana';

        // get profil sekolah
        $profil_sekolah = ProfilSekolah::find(1);

        return view('frontend.profil.sarana_prasarana', compact('semua_sarana_prasarana', 'title', 'profil_sekolah'));
    }

    // fetch
    function fetch()
    {
        $semua_sarana_prasarana = SaranaPrasarana::all();

        return response()->json([
            'data' => $semua_sarana_prasarana
        ]);
    }
}
