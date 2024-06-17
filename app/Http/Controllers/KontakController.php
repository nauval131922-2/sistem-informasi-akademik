<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use App\Models\MediaSosial;
use Illuminate\Http\Request;
use App\Models\ProfilSekolah;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class KontakController extends Controller
{
    public function index(){
        // get profil sekolah
        $profil_sekolah = ProfilSekolah::find(1);



        return view('frontend.kontak.index', compact('profil_sekolah'));
    }

    public function index_be(){
        $semua_kontak = Kontak::all();

        $title = 'Data Kontak';

        return view('backend.kontak.index', compact('semua_kontak', 'title'));
    }

    public function simpan(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        $kontak = new Kontak;
        $kontak->name = $request->name;
        $kontak->email = $request->email;
        $kontak->subject = $request->subject;
        $kontak->message = $request->message;
        $kontak->status = 'Belum dibalas';

        // jike berhasil disimpan
        if ($kontak->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Pesan anda telah terkirim, kami akan segera membalas pesan anda via email.'
            ]);
        }
    }

    public function balas($id){
        // redirect ke halaman balas email via gmail
        $kontak = Kontak::find($id);

        // cari email berdasarkan id
        $email = $kontak->email;

        // cari subject berdasarkan id
        $subject = $kontak->subject;

        // cari message berdasarkan id
        $message = urlencode($kontak->message);

        return redirect('https://mail.google.com/mail/u/0/?view=cm&fs=1&to='.$email.'&su='.$subject.'&body='.$message);
    }

    public function ganti_status($id){
        $kontak = Kontak::find($id);
        if($kontak->status == 'Belum dibalas'){
            $kontak->status = 'Sudah dibalas';
        }else{
            $kontak->status = 'Belum dibalas';
        }
        // $kontak->save();

        // $notification = array(
        //     'message' => 'Status kontak telah berubah',
        //     'alert-type' => 'success'
        // );

        // // reload halaman
        // return redirect()->back()->with($notification);

        // jika berhasil diubah
        if ($kontak->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Status kontak telah berubah'
            ]);
        }
    }

    public function hapus($id){
        $kontak = Kontak::find($id);
        // $kontak->delete();

        // $notification = array(
        //     'message' => 'Data kontak telah dihapus',
        //     'alert-type' => 'success'
        // );

        // // reload halaman
        // return redirect()->back()->with($notification);

        // jika berhasil dihapus
        if ($kontak->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data kontak telah dihapus'
            ]);
        }
    }

    function fetch()
    {
        $semua_kontak = Kontak::all();

        return response()->json([
            'data' => $semua_kontak
        ]);
    }

    function filter(Request $request){
        if ($request->statuss != null) {
            $kontak = Kontak::where('status', '=', $request->statuss)->get();
        } else {
            $kontak = Kontak::all();
        }

        return response()->json([
            'data' => $kontak
        ]);
    }
}
