<?php

namespace App\Http\Controllers;

use App\Models\MediaSosial;
use Illuminate\Http\Request;

class MediaSosialController extends Controller
{
    public function index(){
        // get data dengan id 1 
        $media_sosial = MediaSosial::find(1);
        $title = 'Media Sosial';

        return view('backend.media_sosial.index', compact('media_sosial', 'title'));
    }

    public function update(Request $request, $id){
        // get data dengan id 1 
        $media_sosial = MediaSosial::find($id);
        $media_sosial->twitter = $request->twitter;
        $media_sosial->facebook = $request->facebook;
        $media_sosial->youtube = $request->youtube;
        $media_sosial->instagram = $request->instagram;
        $media_sosial->save();

        $notification = array(
            'message' => 'Data berhasil diubah!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
