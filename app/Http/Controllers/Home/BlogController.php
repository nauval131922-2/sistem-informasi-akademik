<?php

namespace App\Http\Controllers\Home;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\MediaSosial;
use Illuminate\Support\Str;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Models\ProfilSekolah;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index_all()
    {
        $semua_blog = Blog::with('category', 'user')->get();
        // $id = $id;

        // // get blog category name by id
        // $blog_category = BlogCategory::orderBy('updated_at', 'desc')->get();
        // $blog_category_name = $blog_category->blog_category;

        // semua kategori blog
        $semua_kategori_blog = BlogCategory::all();

        $title = 'Data Blog';

        return view('backend.blog.index', compact('semua_blog', 'title', 'semua_kategori_blog'));
    }

    public function tambah()
    {

        $title = 'Data Blog';


        $blog_categories = BlogCategory::all();

        return view('backend.blog.tambah', compact('title', 'blog_categories'));
    }

    public function simpan(Request $request, $blog_category_id)
    {
        // $request->validate([
        //     'judul' => 'required',
        //     'isi' => 'required',
        // ]);

        // validator
        $validator = Validator::make($request->all(), [
            'kategori' => 'required',
            'judul' => 'required|unique:blogs,blog_title',
            'isi' => 'required',
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        $blog = new Blog;
        $blog->blog_title = $request->judul;
        $blog->blog_description = $request->isi;
        $blog->excerpt = Str::limit(strip_tags($request->isi), 200);
        // $blog->blog_category_id = $blog_category_id;
        $blog->blog_category_id = $request->kategori;
        $blog->id_user_for_blog = auth()->user()->id;

        if ($request->hasFile('gambar')) {

            // $nama_file = hexdec(uniqid()).'.'.$request->gambar->getClientOriginalExtension();
            // nama file gambar sama dengan judul blog
            $judul_tanpa_spasi = str_replace(' ', '-', $request->judul);
            $nama_file = $judul_tanpa_spasi . '-' . hexdec(uniqid()) . '.' . $request->gambar->getClientOriginalExtension();
            // Image::make($request->gambar)->resize(1920, 1088)->save('upload/blog/'.$nama_file);
            Image::make($request->gambar)->save('upload/blog/' . $nama_file);

            $blog->blog_image = 'upload/blog/' . $nama_file;
        };

        // $blog->save();

        // $notification = array(
        //     'message' => 'Blog Berhasil Ditambahkan!',
        //     'alert-type' => 'success',
        // );

        // return redirect()->route('blog-index', $id)->with($notification);

        // jike berhasil disimpan
        if ($blog->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Blog Berhasil Ditambahkan!'
            ]);
        } else {
            return response()->json([
                'status' => 'error2',
                'message' => 'Blog Gagal Ditambahkan!'
            ]);
        }
    }

    public function blog_single($id)
    {
        $blog = Blog::findOrFail($id);

        // get profil sekolah
        $profil_sekolah = ProfilSekolah::find(1);

        // get semua kategori blog
        $semua_blog_kategori = BlogCategory::orderBy('blog_category', 'asc')->get();

        // get semua blog urutkan berdasarkan tanggal terbaru
        $semua_blog_terbaru = Blog::orderBy('updated_at', 'desc')->limit(5)->get();

        $semua_blog_tanpa_kategori = Blog::where('blog_category_id', null)->orderBy('updated_at', 'desc')->paginate(4)->onEachSide(0);

        return view('frontend.blog.single', compact('blog', 'profil_sekolah', 'semua_blog_kategori', 'semua_blog_terbaru', 'semua_blog_tanpa_kategori'));
    }

    public function blog_by_category($id)
    {
        $semua_blog = Blog::where('blog_category_id', $id)->orderBy('updated_at', 'desc')->paginate(4)->onEachSide(0);

        // get profil sekolah
        $profil_sekolah = ProfilSekolah::find(1);

        // get semua kategori blog
        $semua_blog_kategori = BlogCategory::orderBy('blog_category', 'asc')->get();

        // get category name
        $category_name = BlogCategory::findOrFail($id);

        // get semua blog urutkan berdasarkan tanggal terbaru
        $semua_blog_terbaru = Blog::orderBy('updated_at', 'desc')->limit(5)->get();

        $title =  $category_name->blog_category;

        $semua_blog_tanpa_kategori = Blog::where('blog_category_id', null)->orderBy('updated_at', 'desc')->paginate(4)->onEachSide(0);

        return view('frontend.blog.bycategory', compact('semua_blog', 'profil_sekolah', 'semua_blog_kategori', 'semua_blog_terbaru', 'category_name', 'title', 'semua_blog_tanpa_kategori'));
    }

    public function blog_uncategorized()
    {
        $semua_blog = Blog::where('blog_category_id', null)->orderBy('updated_at', 'desc')->paginate(4)->onEachSide(0);

        // get profil sekolah
        $profil_sekolah = ProfilSekolah::find(1);

        // get semua kategori blog
        $semua_blog_kategori = BlogCategory::orderBy('blog_category', 'asc')->get();

        // get semua blog urutkan berdasarkan tanggal terbaru
        $semua_blog_terbaru = Blog::orderBy('updated_at', 'desc')->limit(5)->get();

        $title = 'Uncategorized';

        $semua_blog_tanpa_kategori = Blog::where('blog_category_id', null)->orderBy('updated_at', 'desc')->paginate(4)->onEachSide(0);

        return view('frontend.blog.bycategory', compact('semua_blog', 'profil_sekolah', 'semua_blog_kategori', 'semua_blog_terbaru', 'title', 'semua_blog_tanpa_kategori'));
    }

    public function blog_all()
    {
        $semua_blog = Blog::orderBy('updated_at', 'desc')->paginate(4)->onEachSide(0);

        // get profil sekolah
        $profil_sekolah = ProfilSekolah::find(1);

        // get semua kategori blog
        $semua_blog_kategori = BlogCategory::orderBy('blog_category', 'asc')->get();

        // get semua blog urutkan berdasarkan tanggal terbaru
        $semua_blog_terbaru = Blog::with('category', 'user')->orderBy('updated_at', 'desc')->limit(5)->get();

        $title = 'All Posts';

        $semua_blog_tanpa_kategori = Blog::where('blog_category_id', null)->orderBy('updated_at', 'desc')->paginate(4)->onEachSide(0);

        return view('frontend.blog.bycategory', compact('semua_blog', 'profil_sekolah', 'semua_blog_kategori', 'semua_blog_terbaru', 'title', 'semua_blog_tanpa_kategori'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $semua_blog = Blog::where('blog_title', 'like', '%' . $search . '%')->orWhere('blog_description', 'like', '%' . $search . '%')->orWhere('excerpt', 'like', '%' . $search . '%')->orderBy('updated_at', 'desc')->paginate(4)->onEachSide(0);

        // get profil sekolah
        $profil_sekolah = ProfilSekolah::find(1);

        // get semua kategori blog
        $semua_blog_kategori = BlogCategory::orderBy('blog_category', 'asc')->get();

        // get semua blog urutkan berdasarkan tanggal terbaru
        $semua_blog_terbaru = Blog::orderBy('updated_at', 'desc')->limit(5)->get();

        $title = 'Search Result for: ' . $search;

        $semua_blog_tanpa_kategori = Blog::where('blog_category_id', null)->orderBy('updated_at', 'desc')->paginate(4)->onEachSide(0);

        return view('frontend.blog.bycategory', compact('semua_blog', 'profil_sekolah', 'semua_blog_kategori', 'semua_blog_terbaru', 'title', 'semua_blog_tanpa_kategori'));
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);

        // cek apakah blog_category_id ada atau tidak
        if ($blog->blog_category_id != null) {
            $blog_category = BlogCategory::findOrFail($blog->blog_category_id);
            $blog_category_name = $blog_category->blog_category;

            $title = 'Data Blog' . ' ' . $blog_category_name;

            $blog_category_id = $blog->blog_category_id;
        } else {
            $title = 'Uncategorized';
        }

        // $blog_category = BlogCategory::findOrFail($blog->blog_category_id);
        // $blog_category_name = $blog_category->blog_category;

        // get blog category id

        $blog_categories = BlogCategory::all();

        if ($blog->blog_category_id != null) {
            return view('backend.blog.edit', compact('blog', 'title', 'blog_category', 'blog_category_name', 'blog_category_id', 'blog_categories'));
        } else {
            return view('backend.blog.edit', compact('blog', 'title', 'blog_categories'));
        }
    }

    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'judul' => 'required',
        //     'isi' => 'required',
        // ]);

        // validator
        $validator = Validator::make($request->all(), [
            'kategori' => 'required',
            'judul' => 'required|unique:blogs,blog_title,' . $id,
            'isi' => 'required',
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        $blog = Blog::findOrFail($id);
        $blog->blog_title = $request->judul;
        $blog->blog_description = $request->isi;
        $blog->blog_category_id = $request->kategori;
        $blog->id_user_for_blog = auth()->user()->id;
        $blog->excerpt = Str::limit(strip_tags($request->isi), 200);

        if ($request->hasFile('gambar')) {

            if ($blog->blog_image) {
                unlink($blog->blog_image);
            }

            $judul_tanpa_spasi = str_replace(' ', '-', $request->judul);
            $nama_file = $judul_tanpa_spasi . '-' . hexdec(uniqid()) . '.' . $request->gambar->getClientOriginalExtension();
            Image::make($request->gambar)->save('upload/blog/' . $nama_file);

            $blog->blog_image = 'upload/blog/' . $nama_file;
        } elseif ($request->gambarPreview == null && $blog->blog_image != null) {
            unlink($blog->blog_image);

            $blog->blog_image = null;
        } elseif ($request->gambarPreview != null && $blog->blog_image != null) {
            // get file extension
            $file_ext = pathinfo($blog->blog_image, PATHINFO_EXTENSION);

            $judul_tanpa_spasi = str_replace(' ', '-', $request->judul);
            $nama_file = $judul_tanpa_spasi . '-' . hexdec(uniqid()) . '.' . $file_ext;
            // rename file name
            rename(public_path($blog->blog_image), public_path('upload/blog/' . $nama_file));

            $blog->blog_image = 'upload/blog/' . $nama_file;
        }

        // $blog->save();

        // $notification = array(
        //     'message' => 'Blog Berhasil Diubah!',
        //     'alert-type' => 'success',
        // );

        // return redirect()->route('blog-index', $blog->blog_category_id)->with($notification);

        // jika berhasil update
        if ($blog->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Blog Berhasil Diubah!'
            ]);
        } else {
            return response()->json([
                'status' => 'error2',
                'message' => 'Blog Gagal Diubah!'
            ]);
        }
    }

    public function hapus($id)
    {
        $blog = Blog::findOrFail($id);
        // $blog_category = $blog->blog_category_id;
        // $blog->delete();

        // hapus gambar jika ada
        if ($blog->blog_image) {
            unlink($blog->blog_image);
        }

        // $notification = array(
        //     'message' => 'Blog Berhasil Dihapus!',
        //     'alert-type' => 'success',
        // );

        // // return redirect()->route('blog-index', $blog_category)->with($notification);
        // // redirect ke halaman yang sama
        // return redirect()->back()->with($notification);

        // jika berhasil hapus
        if ($blog->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Blog Berhasil Dihapus!'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Blog Gagal Dihapus!'
            ]);
        }
    }

    function filter_blog(Request $request)
    {
        $blog = Blog::with('category', 'user');

        if ($request->kategori_blog == '') {
            // jika id_role user tidak 1, maka dapatkan data blog dengan id_user_for_blog = id user yang login
            if (auth()->user()->id_role != 1 && auth()->user()->id_role != 2) {
                $blog->where('id_user_for_blog', auth()->user()->id);
            }

            // filter berdasarkan kepemilikkan blog
            if (Auth::user()->id_role === 2 || Auth::user()->id_role === 1) {
                if ($request->kepemilikan_blog == '') {
                    $blog->where('id', '!=', null);
                } elseif ($request->kepemilikan_blog == 'anonymous') {
                    $blog->where('id_user_for_blog', null);
                } elseif ($request->kepemilikan_blog != 'anonymous') {
                    $blog->where('id_user_for_blog', $request->kepemilikan_blog);
                }
            } else if (Auth::user()->id_role === 3 || Auth::user()->id_role === 4) {
                $blog->where('id_user_for_blog', Auth::user()->id);
            }
        } elseif ($request->kategori_blog == 'uncategorized') {
            $blog->where('blog_category_id', null);

            // jika id_role user tidak 1, maka dapatkan data blog dengan id_user_for_blog = id user yang login
            if (auth()->user()->id_role != 1 && auth()->user()->id_role != 2) {
                $blog->where('id_user_for_blog', auth()->user()->id);
            }

            // filter berdasarkan kepemilikkan blog
            if (Auth::user()->id_role === 2 || Auth::user()->id_role === 1) {
                if ($request->kepemilikan_blog == '') {
                    $blog->where('id', '!=', null);
                } elseif ($request->kepemilikan_blog == 'anonymous') {
                    $blog->where('id_user_for_blog', null);
                } elseif ($request->kepemilikan_blog != 'anonymous') {
                    $blog->where('id_user_for_blog', $request->kepemilikan_blog);
                }
            } else if (Auth::user()->id_role === 3 || Auth::user()->id_role === 4) {
                $blog->where('id_user_for_blog', Auth::user()->id);
            }
        } elseif ($request->kategori_blog != 'uncategorized') {
            $blog->where('blog_category_id', $request->kategori_blog);

            // jika id_role user tidak 1, maka dapatkan data blog dengan id_user_for_blog = id user yang login
            if (auth()->user()->id_role != 1 && auth()->user()->id_role != 2) {
                $blog->where('id_user_for_blog', auth()->user()->id);
            }

            // filter berdasarkan kepemilikkan blog
            if (Auth::user()->id_role === 2 || Auth::user()->id_role === 1) {
                if ($request->kepemilikan_blog == '') {
                    $blog->where('id', '!=', null);
                } elseif ($request->kepemilikan_blog == 'anonymous') {
                    $blog->where('id_user_for_blog', null);
                } elseif ($request->kepemilikan_blog != 'anonymous') {
                    $blog->where('id_user_for_blog', $request->kepemilikan_blog);
                }
            } else if (Auth::user()->id_role === 3 || Auth::user()->id_role === 4) {
                $blog->where('id_user_for_blog', Auth::user()->id);
            }
        }

        $blog = $blog->get();

        return response()->json([
            'data' => $blog
        ]);
    }
}
