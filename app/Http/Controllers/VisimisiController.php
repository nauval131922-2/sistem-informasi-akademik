<?php

namespace App\Http\Controllers;

use App\Models\Visimisi;
use Illuminate\Http\Request;

class VisimisiController extends Controller
{
    public function index(){
        $visi_misi = Visimisi::find(1);
        $title = 'Visi & Misi';

        return view('backend.visi_misi.index', compact('visi_misi', 'title'));
    }

    public function update(Request $request, $id){
        $visi_misi = Visimisi::find($id);
        $visi_misi->visi = $request->visi;
        $visi_misi->misi = $request->misi;
        $visi_misi->tujuan = $request->tujuan;
        $visi_misi->save();

        $notification = array(
            'message' => 'Visi & Misi berhasil diubah!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
