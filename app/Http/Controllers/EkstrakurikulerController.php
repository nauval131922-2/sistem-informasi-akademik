<?php

namespace App\Http\Controllers;

// use Dotenv\Validator;
use Illuminate\Support\Facades\Validator;
use App\Models\MediaSosial;
use Illuminate\Http\Request;
use App\Models\ProfilSekolah;
use App\Models\Ekstrakurikuler;
use Intervention\Image\Facades\Image;

class EkstrakurikulerController extends Controller
{
    public function index()
    {
        $semua_ekstra = Ekstrakurikuler::all();
        $title = 'Data Ekstrakurikuler';

        return view('backend.ekstra.index', compact('semua_ekstra', 'title'));
    }

    function fetch()
    {
        $semua_ekstra = Ekstrakurikuler::all();
        $title = 'Data Ekstrakurikuler';

        return response()->json([
            'data' => $semua_ekstra
        ]);
    }

    public function tambah()
    {
        $title = 'Data Ekstrakurikuler';

        return view('backend.ekstra.tambah', compact('title'));
    }

    public function simpan(Request $request)
    {
        // validasi
        $validator = Validator::make($request->all(), [
            'ekstrakurikuler' => 'required|unique:ekstrakurikulers,nama',
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        // simpan ke database
        $ekstra = new Ekstrakurikuler();
        $ekstra->nama = $request->ekstrakurikuler;

        // jika belum ada folder upload/ekstra, maka buat folder
        if (!file_exists(public_path('/upload/ekstra'))) {
            mkdir(public_path('/upload/ekstra'), 0777, true);
        }

        // cek jika gambar diupload
        if ($request->hasFile('gambar')) {
            $judul_tanpa_spasi = str_replace(' ', '-', $request->ekstrakurikuler);
            $nama_file = $judul_tanpa_spasi . '-' . hexdec(uniqid()) . '.' . $request->gambar->getClientOriginalExtension();
            Image::make($request->gambar)->save(public_path('/upload/ekstra/' . $nama_file));

            $ekstra->gambar = 'upload/ekstra/' . $nama_file;
        }

        // simpan ke database
        // $ekstra->save();

        // // notifikasi
        // $notification = array(
        //     'message' => 'Data Ekstrakurikuler Berhasil Ditambahkan',
        //     'alert-type' => 'success'
        // );

        // return redirect()->route('ekstra-index')->with($notification);

        // notifikasi menggunakan alert javascript biasa
        // return redirect()->back()->with('success', 'Data Ekstrakurikuler Berhasil Ditambahkan');

        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Data berhasil disimpan'
        // ]);

        // simpan ke database
        if ($ekstra->save()) {
            return response()->json(['status' => 'success', 'message' => 'Data berhasil disimpan.']);
        } else {
            return response()->json(['status' => 'error2', 'message' => 'Gagal menyimpan data.']);
        }
    }

    public function edit($id)
    {
        $ekstra = Ekstrakurikuler::find($id);
        $title = 'Data Ekstrakurikuler';

        return view('backend.ekstra.edit', compact('ekstra', 'title'));
    }

    public function update(Request $request, $id)
    {
        // validasi
        $validator = Validator::make($request->all(), [
            'ekstrakurikuler' => 'required|unique:ekstrakurikulers,nama,' . $id,
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        // update ke database
        $ekstra = Ekstrakurikuler::find($id);
        $ekstra->nama = $request->ekstrakurikuler;

        // cek jika gambar diupload
        if ($request->hasFile('gambar')) {

            if ($ekstra->gambar) {
                unlink($ekstra->gambar);
            }

            $judul_tanpa_spasi = str_replace(' ', '-', $request->ekstrakurikuler);
            $nama_file = $judul_tanpa_spasi . '-' . hexdec(uniqid()) . '.' . $request->gambar->getClientOriginalExtension();
            Image::make($request->gambar)->save(public_path('/upload/ekstra/' . $nama_file));

            $ekstra->gambar = 'upload/ekstra/' . $nama_file;
        } elseif ($request->gambarPreview == null && $ekstra->gambar != null) {
            unlink($ekstra->gambar);

            $ekstra->gambar = null;
        } elseif ($request->gambarPreview != null && $ekstra->gambar != null) {
            // get $ekstra->gambar file extension
            $file_ext = pathinfo($ekstra->gambar, PATHINFO_EXTENSION);

            $judul_tanpa_spasi = str_replace(' ', '-', $request->ekstrakurikuler);
            $nama_file = $judul_tanpa_spasi . '-' . hexdec(uniqid()) . '.' . $file_ext;
            // rename file name
            rename(public_path($ekstra->gambar), public_path('/upload/ekstra/' . $nama_file));

            $ekstra->gambar = 'upload/ekstra/' . $nama_file;
        }

        // simpan ke database
        // $ekstra->save();

        // notifikasi
        // $notification = array(
        //     'message' => 'Data Ekstrakurikuler Berhasil Diubah',
        //     'alert-type' => 'success'
        // );

        // return redirect()->route('ekstra-index')->with($notification);

        if ($ekstra->save()) {
            return response()->json(['status' => 'success', 'message' => 'Data berhasil diubah.']);
        } else {
            return response()->json(['status' => 'error2', 'message' => 'Gagal mengubah data.']);
        }
    }

    public function hapus($id)
    {
        $ekstra = Ekstrakurikuler::find($id);

        if ($ekstra->gambar) {
            unlink($ekstra->gambar);
        }

        // $ekstra->delete();

        // $notification = array(
        //     'message' => 'Data Ekstrakurikuler Berhasil Dihapus',
        //     'alert-type' => 'success'
        // );

        // return redirect()->back()->with($notification);

        // return redirect()->back()->with('success', 'Ekstrakurikuler berhasil dihapus');

        // jika berhasil dihapus
        if ($ekstra->delete()) {
            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data.']);
        }
    }

    public function index_fe()
    {
        $semua_ekstra = Ekstrakurikuler::all();
        $title = 'Ekstrakurikuler';

        // get profil sekolah
        $profil_sekolah = ProfilSekolah::find(1);

        return view('frontend.kesiswaan.ekstra', compact('semua_ekstra', 'title', 'profil_sekolah'));
    }
}
