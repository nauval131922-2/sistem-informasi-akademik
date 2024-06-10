<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreTahunAjaranRequest;
use App\Http\Requests\UpdateTahunAjaranRequest;

class TahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semua_tahun_ajaran = TahunAjaran::all();
        $title = 'Data Tahun Ajaran';

        return view('backend.tahun_ajaran.index', compact('title', 'semua_tahun_ajaran'));
    }

    function fetch()
    {
        $semua_tahun_ajaran = TahunAjaran::all();

        return response()->json([
            'data' => $semua_tahun_ajaran
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Data Tahun Ajaran';
        $semua_semester = ['Gasal', 'Genap'];
        $semua_status = ['Aktif', 'Nonaktif'];

        return view('backend.tahun_ajaran.tambah', compact('title', 'semua_semester', 'semua_status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTahunAjaranRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validator
        $validator = Validator::make($request->all(), [
            'semester' => 'required',
            'tahun_ajaran' => 'required',
            'statuss' => 'required',
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        $tahun_ajaran = new TahunAjaran;
        $tahun_ajaran->semester = $request->semester;
        $tahun_ajaran->tahun = $request->tahun_ajaran;
        $tahun_ajaran->status = $request->statuss;

        // jika ada tahun ajaran lain yang masih aktif dan kita akan menambah tahun ajaran yang aktif, maka tidak bisa
        if ($request->statuss == 'Aktif') {
            $cek_tahun_ajaran_aktif = TahunAjaran::where('status', 'Aktif')
                ->first();

            if ($cek_tahun_ajaran_aktif) {
                return response()->json([
                    'status' => 'error2',
                    'message' => 'Tahun Ajaran lain masih aktif!'
                ]);
            }
        }

        // jika ada semester dan tahun ajaran yang sama, maka tidak bisa diinputkan
        $cek_tahun_ajaran = TahunAjaran::where('semester', $request->semester)
            ->where('tahun', $request->tahun_ajaran)
            ->first();

        if ($cek_tahun_ajaran) {

            return response()->json([
                'status' => 'error3',
                'message' => 'Tahun Ajaran sudah ada!'
            ]);
        } else {

            // jika tahun ajaran berhasil disimpan
            if ($tahun_ajaran->save()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data Tahun Ajaran berhasil ditambahkan'
                ]);
            } else {
                return response()->json([
                    'status' => 'error4',
                    'message' => 'Data Tahun Ajaran gagal ditambahkan'
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TahunAjaran  $tahunAjaran
     * @return \Illuminate\Http\Response
     */
    public function show(TahunAjaran $tahunAjaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TahunAjaran  $tahunAjaran
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tahun_ajaran = TahunAjaran::find($id);
        $semua_semester = ['Gasal', 'Genap'];
        $semua_status = ['Aktif', 'Nonaktif'];
        $title = 'Data Tahun Ajaran';

        return view('backend.tahun_ajaran.edit', compact('title', 'tahun_ajaran', 'semua_semester', 'semua_status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTahunAjaranRequest  $request
     * @param  \App\Models\TahunAjaran  $tahunAjaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validator
        $validator = Validator::make($request->all(), [
            'semester' => 'required',
            'tahun_ajaran' => 'required',
            'statuss' => 'required',
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        $tahun_ajaran = TahunAjaran::find($id);
        $tahun_ajaran->semester = $request->semester;
        $tahun_ajaran->tahun = $request->tahun_ajaran;
        $tahun_ajaran->status = $request->statuss;

        // jika ada tahun ajaran lain yang masih aktif dan kita akan mengubah tahun ajaran yang sedang kita edit menjadi aktif, maka tidak bisa
        if ($request->statuss == 'Aktif') {
            $cek_tahun_ajaran_aktif = TahunAjaran::where('status', 'Aktif')
                ->where('id', '!=', $id)
                ->first();

            // if ($cek_tahun_ajaran_aktif) {
            //     $notification = array(
            //         'message' => 'Tahun Ajaran lain masih aktif!',
            //         'alert-type' => 'error'
            //     );

            //     return redirect()->back()->withInput()->with($notification);
            // }

            if ($cek_tahun_ajaran_aktif) {
                return response()->json([
                    'status' => 'error2',
                    'message' => 'Tahun Ajaran lain masih aktif!'
                ]);
            }
        }

        // jika ada semester dan tahun ajaran yang sama, maka tidak bisa diinputkan
        $cek_tahun_ajaran = TahunAjaran::where('semester', $request->semester)
            ->where('tahun', $request->tahun_ajaran)
            ->where('id', '!=', $id)
            ->first();

        if ($cek_tahun_ajaran) {
            // $notification = array(
            //     'message' => 'Tahun Ajaran sudah ada!',
            //     'alert-type' => 'error'
            // );

            // return redirect()->back()->withInput()->with($notification);

            return response()->json([
                'status' => 'error3',
                'message' => 'Tahun Ajaran sudah ada!'
            ]);
        } else {
            // $tahun_ajaran->save();

            // $notification = array(
            //     'message' => 'Data Tahun Ajaran berhasil diubah',
            //     'alert-type' => 'success'
            // );

            // return redirect()->route('data-tahun-ajaran-index')->with($notification);

            // jika tahun ajaran berhasil diubah
            if ($tahun_ajaran->save()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data Tahun Ajaran berhasil diubah'
                ]);
            } else {
                return response()->json([
                    'status' => 'error4',
                    'message' => 'Data Tahun Ajaran gagal diubah'
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TahunAjaran  $tahunAjaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tahun_ajaran = TahunAjaran::find($id);
        // $tahun_ajaran->delete();
        // $notification = array(
        //     'message' => 'Data Tahun Ajaran berhasil dihapus',
        //     'alert-type' => 'success'
        // );
        // return redirect()->route('data-tahun-ajaran-index')->with($notification);

        // jika tahun ajaran berhasil dihapus
        if ($tahun_ajaran->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data Tahun Ajaran berhasil dihapus'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data Tahun Ajaran gagal dihapus'
            ]);
        }
    }
}
