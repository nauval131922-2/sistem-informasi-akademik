<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

class GaleriController extends Controller
{
    public function index(){
        $semua_galeri = Galeri::all();
        $title = 'Galeri';

        return view('backend.galeri.index', compact('semua_galeri', 'title'));
    }

    public function tambah(){
        $title = 'Tambah Galeri';

        return view('backend.galeri.tambah', compact('title'));
    }

    public function simpan(Request $request){
        $image = $request->file('gambar');
        
        // save multiple image as array
        $images = $request->file('gambar');
        $images_array = array();
        foreach($images as $image) {
            $name_generate = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->save('upload/galeri/'.$name_generate);
            $save_url = 'upload/galeri/'.$name_generate;
            array_push($images_array, $save_url);
        }
        $images_json = json_encode($images_array);

        $galeri = new Galeri;
        $galeri->judul = $request->judul;
        $galeri->gambar = $images_json;
        $galeri->save();

        // foreach ($image as $multi_image){
        //     $name_generate = hexdec(uniqid()).'.'.$multi_image->getClientOriginalExtension();

        //     Image::make($multi_image)->save('upload/galeri/'.$name_generate);

        //     $save_url = 'upload/galeri/'.$name_generate;

        //     Galeri::insert([
        //         'judul' => $request->judul,
        //         'gambar' => $save_url,
        //         'created_at' => Carbon::now(),
        //     ]);
        // }

        $notification = array(
            'message' => 'Galeri berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('galeri-index')->with($notification);
    }
}
