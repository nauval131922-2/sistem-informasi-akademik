<?php

namespace App\Http\Controllers\Home;

use Carbon\Carbon;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BlogCategoryController extends Controller
{
    public function index(){
        $semua_blog_category = BlogCategory::all();
        $title = 'Data Kategori Blog';

        return view('backend.blog_category.index', compact('semua_blog_category', 'title'));
    }

    public function tambah(){
        $title = 'Data Kategori Blog';

        return view('backend.blog_category.tambah', compact('title'));
    }

    public function simpan(Request $request){
        // $this->validate($request, [
        //     'blog_category' => 'required|unique:blog_categories,blog_category',
        // ]);

        // validator
        $validator = Validator::make($request->all(), [
            'blog_category' => 'required|unique:blog_categories,blog_category'
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        $blog_category = new BlogCategory;
        $blog_category->blog_category = $request->blog_category;
        // $blog_category->save();

        // $notification = array(
        //     'message' => 'Blog Category berhasil ditambahkan',
        //     'alert-type' => 'success'
        // );

        // return redirect()->route('blog-category-index')->with($notification);

        // jika berhasil disimpan
        if ($blog_category->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Blog Category berhasil ditambahkan'
            ]);
        }
    }

    public function edit($id){
        $blog_category = BlogCategory::find($id);
        $title = 'Data Kategori Blog';

        return view('backend.blog_category.edit', compact('blog_category', 'title'));
    }

    public function update(Request $request, $id){
        // $this->validate($request, [
        //     'blog_category' => 'required|unique:blog_categories,blog_category,'.$id,
        // ]);

        // validator
        $validator = Validator::make($request->all(), [
            'blog_category' => 'required|unique:blog_categories,blog_category,'.$id
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        $blog_category = BlogCategory::find($id);
        $blog_category->blog_category = $request->blog_category;
        // $blog_category->save();

        // $notification = array(
        //     'message' => 'Blog Category berhasil diubah',
        //     'alert-type' => 'success'
        // );

        // return redirect()->route('blog-category-index')->with($notification);

        // jika berhasil diubah
        if ($blog_category->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Blog Category berhasil diubah'
            ]);
        }
    }

    public function hapus($id){
        $blog_category = BlogCategory::find($id);
        // $blog_category->delete();

        // $notification = array(
        //     'message' => 'Blog Category berhasil dihapus',
        //     'alert-type' => 'success'
        // );


        // return redirect()->back()->with($notification);

        // jika berhasil dihapus
        if ($blog_category->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Blog Category berhasil dihapus'
            ]);
        }
    }

    function fetch()
    {
        $semua_blog_category = BlogCategory::all();

        return response()->json([
            'data' => $semua_blog_category
        ]);
    }
}
