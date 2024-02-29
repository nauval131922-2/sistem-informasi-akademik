<?php

namespace App\Http\Controllers;

use App\Models\JamPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class JamPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semua_jam_pelajaran = JamPelajaran::all();
        $title = 'Data Jam';
        return view('backend.jam_pelajaran.index', compact('semua_jam_pelajaran', 'title'));
    }

    public function index_jam_pelajaran(){
        $title = 'Data Jam Pelajaran';
        $semua_jam_pelajaran = JamPelajaran::where('tipe_jam', '=', 'Pelajaran')->get();
        return view('backend.jam_pelajaran.index', compact('semua_jam_pelajaran', 'title'));
    }

    public function index_jam_istirahat(){
        $title = 'Data Jam Istirahat';
        $semua_jam_pelajaran = JamPelajaran::where('tipe_jam', '=', 'Istirahat')->get();
        return view('backend.jam_pelajaran.index', compact('semua_jam_pelajaran', 'title'));
    }

    function fetch_jam_pelajaran()
    {
        $semua_jam_pelajaran = JamPelajaran::where('tipe_jam', '=', 'Pelajaran')->get();
        $title = 'Data Jam Pelajaran';

        return response()->json([
            'data' => $semua_jam_pelajaran,
            'title' => $title
        ]);
    }

    function fetch_jam_istirahat()
    {
        $semua_jam_pelajaran = JamPelajaran::where('tipe_jam', '=', 'Istirahat')->get();
        $title = 'Data Jam Istirahat';

        return response()->json([
            'data' => $semua_jam_pelajaran,
            'title' => $title
        ]);
    }

    // fetch data all jam
    function fetch_jam()
    {
        $semua_jam = JamPelajaran::all();

        return response()->json([
            'data' => $semua_jam
        ]);
    }

    // filter_jam
    function filter_jam(Request $request)
    {
        // jika tipe_jam = kosong
        if ($request->tipe_jam != null) {
            $jam = JamPelajaran::where('tipe_jam', '=', $request->tipe_jam)->get();
        } else {
            $jam = JamPelajaran::all();
        }

        return response()->json([
            'data' => $jam
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_jam_pelajaran()
    {
        $title = 'Data Jam Pelajaran';
        $tipe_jam = 'Pelajaran';
        return view('backend.jam_pelajaran.create', compact('title', 'tipe_jam'));
    }

    public function create_jam_istirahat()
    {
        $title = 'Data Jam Istirahat';
        $tipe_jam = 'Istirahat';
        return view('backend.jam_pelajaran.create', compact('title', 'tipe_jam'));
    }

    public function store_jam_pelajaran(Request $request)
    {
        $request->validate([
            'jam_ke' => 'required|unique:jam_pelajarans,jam_ke',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $jam_pelajaran = new JamPelajaran();
        $jam_pelajaran->jam_ke = $request->jam_ke;
        $jam_pelajaran->jam_mulai = $request->jam_mulai;
        $jam_pelajaran->jam_selesai = $request->jam_selesai;

        $jam_pelajaran->tipe_jam = 'Pelajaran';

        $cek_jam = JamPelajaran::where('jam_mulai',$request->jam_mulai)
        ->where('jam_selesai',$request->jam_selesai)
        ->first();

        $cek_jam_2 = JamPelajaran::where('jam_mulai','>=', $request->jam_mulai)
        ->where('jam_mulai','<=',$request->jam_selesai)
        ->first();

        $cek_jam_3 = JamPelajaran::where('jam_mulai','>=', $request->jam_mulai)
        ->where('jam_selesai','<=',$request->jam_selesai)
        ->first();

        $cek_jam_4 = JamPelajaran::where('jam_mulai','<=', $request->jam_mulai)
        ->where('jam_selesai','>=',$request->jam_selesai)
        ->first();

        $cek_jam_5 = JamPelajaran::where('jam_selesai','<=', $request->jam_selesai)
        ->where('jam_mulai','>=',$request->jam_selesai)
        ->first();

        $cek_jam_6 = JamPelajaran::where('jam_selesai', $request->jam_mulai)
        ->where('jam_mulai',$request->jam_selesai)
        ->first();

        $cek_jam_7 = JamPelajaran::where('jam_mulai','<=', $request->jam_mulai)
        ->where('jam_selesai','>=',$request->jam_mulai)
        ->first();

        // cek jika jam mulai lebih besar dari jam selesai
        if ($request->jam_mulai > $request->jam_selesai) {
            $notification = array(
                'message' => 'Jam mulai tidak boleh lebih besar dari jam selesai',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        if(($cek_jam)
        ||($cek_jam_2)
        ||($cek_jam_3)
        ||($cek_jam_4)
        ||($cek_jam_5)
        ||($cek_jam_6)
        ||($cek_jam_7)){
            $notification = array(
                'message' => 'Jam Pelajaran sudah ada',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        $jam_pelajaran->save();

        $notification = array(
            'message' => 'Data Berhasil Ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('jam-pelajaran-index')->with($notification);
    }

    public function store_jam_istirahat(Request $request)
    {
        $request->validate([
            'jam_ke' => 'required|unique:jam_pelajarans,jam_ke',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $jam_pelajaran = new JamPelajaran();
        $jam_pelajaran->jam_ke = $request->jam_ke;
        $jam_pelajaran->jam_mulai = $request->jam_mulai;
        $jam_pelajaran->jam_selesai = $request->jam_selesai;

        $jam_pelajaran->tipe_jam = 'Istirahat';

        $cek_jam = JamPelajaran::where('jam_mulai',$request->jam_mulai)
        ->where('jam_selesai',$request->jam_selesai)
        ->first();

        $cek_jam_2 = JamPelajaran::where('jam_mulai','>=', $request->jam_mulai)
        ->where('jam_mulai','<=',$request->jam_selesai)
        ->first();

        $cek_jam_3 = JamPelajaran::where('jam_mulai','>=', $request->jam_mulai)
        ->where('jam_selesai','<=',$request->jam_selesai)
        ->first();

        $cek_jam_4 = JamPelajaran::where('jam_mulai','<=', $request->jam_mulai)
        ->where('jam_selesai','>=',$request->jam_selesai)
        ->first();

        $cek_jam_5 = JamPelajaran::where('jam_selesai','<=', $request->jam_selesai)
        ->where('jam_mulai','>=',$request->jam_selesai)
        ->first();

        $cek_jam_6 = JamPelajaran::where('jam_selesai', $request->jam_mulai)
        ->where('jam_mulai',$request->jam_selesai)
        ->first();

        $cek_jam_7 = JamPelajaran::where('jam_mulai','<=', $request->jam_mulai)
        ->where('jam_selesai','>=',$request->jam_mulai)
        ->first();

        // cek jika jam mulai lebih besar dari jam selesai
        if ($request->jam_mulai > $request->jam_selesai) {
            $notification = array(
                'message' => 'Jam mulai tidak boleh lebih besar dari jam selesai',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        if(($cek_jam)
        ||($cek_jam_2)
        ||($cek_jam_3)
        ||($cek_jam_4)
        ||($cek_jam_5)
        ||($cek_jam_6)
        ||($cek_jam_7)){
            $notification = array(
                'message' => 'Jam Pelajaran sudah ada',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        $jam_pelajaran->save();

        $notification = array(
            'message' => 'Data Berhasil Ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('jam-istirahat-index')->with($notification);
    }

    public function store_jam(Request $request)
    {   

        // validator
        $validator = Validator::make($request->all(), [
            'jam_ke' => 'required|unique:jam_pelajarans,jam_ke',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        $jam_pelajaran = new JamPelajaran();
        $jam_pelajaran->jam_ke = $request->jam_ke;
        $jam_pelajaran->jam_mulai = $request->jam_mulai;
        $jam_pelajaran->jam_selesai = $request->jam_selesai;


        // $jam_pelajaran->tipe_jam = 'Pelajaran';
        $jam_pelajaran->tipe_jam = $request->tipe_jam;

        $cek_jam = JamPelajaran::where('jam_mulai',$request->jam_mulai)
        ->where('jam_selesai',$request->jam_selesai)
        ->first();

        $cek_jam_2 = JamPelajaran::where('jam_mulai','>=', $request->jam_mulai)
        ->where('jam_mulai','<=',$request->jam_selesai)
        ->first();

        $cek_jam_3 = JamPelajaran::where('jam_mulai','>=', $request->jam_mulai)
        ->where('jam_selesai','<=',$request->jam_selesai)
        ->first();

        $cek_jam_4 = JamPelajaran::where('jam_mulai','<=', $request->jam_mulai)
        ->where('jam_selesai','>=',$request->jam_selesai)
        ->first();

        $cek_jam_5 = JamPelajaran::where('jam_selesai','<=', $request->jam_selesai)
        ->where('jam_mulai','>=',$request->jam_selesai)
        ->first();

        $cek_jam_6 = JamPelajaran::where('jam_selesai', $request->jam_mulai)
        ->where('jam_mulai',$request->jam_selesai)
        ->first();

        $cek_jam_7 = JamPelajaran::where('jam_mulai','<=', $request->jam_mulai)
        ->where('jam_selesai','>=',$request->jam_mulai)
        ->first();

        // cek jika jam mulai lebih besar dari jam selesai
        // if ($request->jam_mulai > $request->jam_selesai) {
        //     $notification = array(
        //         'message' => 'Jam mulai tidak boleh lebih besar dari jam selesai',
        //         'alert-type' => 'error'
        //     );

        //     return redirect()->back()->with($notification);
        // }

        // cek jika jam mulai lebih besar dari jam selesai
        if ($request->jam_mulai > $request->jam_selesai) {
            return response()->json([
                'status' => 'error2',
                'message' => 'Jam mulai tidak boleh lebih besar dari jam selesai'
            ]);
        }

        if(($cek_jam)
        ||($cek_jam_2)
        ||($cek_jam_3)
        ||($cek_jam_4)
        ||($cek_jam_5)
        ||($cek_jam_6)
        ||($cek_jam_7)){
            // $notification = array(
            //     'message' => 'Jam Pelajaran sudah ada',
            //     'alert-type' => 'error'
            // );

            // return redirect()->back()->with($notification);

            return response()->json([
                'status' => 'error3',
                'message' => 'Jam sudah ada/bentrok'
            ]);
        }

        // $jam_pelajaran->save();

        // $notification = array(
        //     'message' => 'Data Berhasil Ditambahkan',
        //     'alert-type' => 'success'
        // );

        // return redirect()->route('jam-pelajaran-index')->with($notification);

        // simpan ke database
        if ($jam_pelajaran->save()) {
            return response()->json(['status' => 'success', 'message' => 'Data berhasil disimpan.']);
        } else {
            return response()->json(['status' => 'error4', 'message' => 'Gagal menyimpan data.']);
        }
    }

    public function edit($id){
        $jam_pelajaran = JamPelajaran::findOrFail($id);
        
        $tipe_jam = $jam_pelajaran->tipe_jam;

        $title = 'Data Jam '. $tipe_jam;

        return view('backend.jam_pelajaran.edit', compact('jam_pelajaran', 'title', 'tipe_jam'));
    }

    public function update(Request $request, $id){
        // validator
        $validator = Validator::make($request->all(), [
            'jam_ke' => 'required|unique:jam_pelajarans,jam_ke,'. $id,
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }


        // $request->validate([
        //     'jam_ke' => 'required|unique:jam_pelajarans,jam_ke,'.$id,
        //     'jam_mulai' => 'required',
        //     'jam_selesai' => 'required',
        // ]);

        $jam_pelajaran = JamPelajaran::find($id);
        $jam_pelajaran->jam_ke = $request->jam_ke;
        $jam_pelajaran->jam_mulai = $request->jam_mulai;
        $jam_pelajaran->jam_selesai = $request->jam_selesai;

        $cek_jadwal = JamPelajaran::where('jam_mulai',$request->jam_mulai)
        ->where('jam_selesai',$request->jam_selesai)
        ->where('id', '!=', $id)
        ->first();

        $cek_jadwal_2 = JamPelajaran::where('jam_mulai','>=', $request->jam_mulai)
        ->where('jam_mulai','<=',$request->jam_selesai)
        ->where('id', '!=', $id)
        ->first();

        $cek_jadwal_3 = JamPelajaran::where('jam_mulai','>=', $request->jam_mulai)
        ->where('jam_selesai','<=',$request->jam_selesai)
        ->where('id', '!=', $id)
        ->first();

        $cek_jadwal_4 = JamPelajaran::where('jam_mulai','<=', $request->jam_mulai)
        ->where('jam_selesai','>=',$request->jam_selesai)
        ->where('id', '!=', $id)
        ->first();

        $cek_jadwal_5 = JamPelajaran::where('jam_selesai','<=', $request->jam_selesai)
        ->where('jam_mulai','>=',$request->jam_selesai)
        ->where('id', '!=', $id)
        ->first();

        $cek_jadwal_6 = JamPelajaran::where('jam_selesai', $request->jam_mulai)
        ->where('jam_mulai',$request->jam_selesai)
        ->where('id', '!=', $id)
        ->first();

        $cek_jadwal_7 = JamPelajaran::where('jam_mulai','<=', $request->jam_mulai)
        ->where('jam_selesai','>=',$request->jam_mulai)
        ->where('id', '!=', $id)
        ->first();

        // cek jika jam mulai lebih besar dari jam selesai
        if ($request->jam_mulai > $request->jam_selesai) {
            // $notification = array(
            //     'message' => 'Jam mulai tidak boleh lebih besar dari jam selesai',
            //     'alert-type' => 'error'
            // );

            // return redirect()->back()->with($notification);

            return response()->json([
                'status' => 'error2',
                'message' => 'Jam mulai tidak boleh lebih besar dari jam selesai'
            ]);
        }

        if(($cek_jadwal)
        ||($cek_jadwal_2)
        ||($cek_jadwal_3)
        ||($cek_jadwal_4)
        ||($cek_jadwal_5)
        ||($cek_jadwal_6)
        ||($cek_jadwal_7)){
            // $notification = array(
            //     'message' => 'Jam sudah ada/bentrok',
            //     'alert-type' => 'error'
            // );

            // return redirect()->back()->with($notification);

            return response()->json([
                'status' => 'error3',
                'message' => 'Jam sudah ada/bentrok'
            ]);
        }

        // dd($jam_pelajaran->tipe_jam);

        // $jam_pelajaran->save();

        // $notification = array(
        //     'message' => 'Jam Berhasil Diubah',
        //     'alert-type' => 'success'
        // );

        // if ($jam_pelajaran->tipe_jam == 'Pelajaran') {
        //     return redirect()->route('jam-pelajaran-index')->with($notification);
        // } else if ($jam_pelajaran->tipe_jam == 'Istirahat') {
        //     return redirect()->route('jam-istirahat-index')->with($notification);
        // }

        // jika berhasil update
        if ($jam_pelajaran->save()) {
            return response()->json(['status' => 'success', 'message' => 'Data berhasil diubah.']);
        } else {
            return response()->json(['status' => 'error4', 'message' => 'Gagal mengubah data.']);
        }
    }

    public function destroy($id){
        $jam_pelajaran = JamPelajaran::find($id);
        // $jam_pelajaran->delete();

        // $notification = array(
        //     'message' => 'Jam Pelajaran Berhasil Dihapus',
        //     'alert-type' => 'success'
        // );

        // return redirect()->back()->with($notification);

        // jika berhasil hapus
        if ($jam_pelajaran->delete()) {
            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data.']);
        }
    }
}
