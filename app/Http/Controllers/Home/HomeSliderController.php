<?php

namespace App\Http\Controllers\Home;

use App\Models\Blog;
use App\Models\Galeri;
use App\Models\Visimisi;
use App\Models\HomeSlide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MediaSosial;
use App\Models\ProfilSekolah;
use Intervention\Image\Facades\Image;

class HomeSliderController extends Controller
{
    public function HomeSlider() {
        $homeSlide = HomeSlide::find(1);

        return view('admin.home_slide.home_slide_all', compact('homeSlide'));
    }

    public function UpdateSlider(Request $request) {
        $slide_id = $request->id;

        if ($request->file('home_slide')){
            $image = $request->file('home_slide');
            $name_generate = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            Image::make($image)->resize(636, 852)->save('upload/home_slide/'.$name_generate);

            $save_url = 'upload/home_slide/'.$name_generate;

            HomeSlide::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'video_url' => $request->video_url,
                'home_slide' => $save_url,
            ]);
            $notification = array(
                'message' => 'Home Slide Updated with Image Successfully!',
                'alert-type' => 'success',
            );

            return redirect()->back()->with($notification);
        } else {
            HomeSlide::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'video_url' => $request->video_url,
            ]);
            $notification = array(
                'message' => 'Home Slide Updated without Image Successfully!',
                'alert-type' => 'success',
            );

            return redirect()->back()->with($notification);
        }
    }

    public function Home(){
        // get semua blog kecuali blog dengan id 1
        $semua_blog = Blog::where('id', '!=', 1)->orderBy('updated_at', 'desc')->limit(4)->get();

        // get blog dengan id 1
        $blog_1 = Blog::find(1);

        // dd($blog_1->blog_image);

        // get profil sekolah
        $profil_sekolah = ProfilSekolah::find(1);

        return view('frontend.index', compact('semua_blog', 'blog_1', 'profil_sekolah'));
    }
}
