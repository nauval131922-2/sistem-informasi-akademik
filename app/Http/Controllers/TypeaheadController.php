<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;

class TypeaheadController extends Controller
{
    public function index(){
        return redirect()->route('blog-all');
    }
 
    public function autocompleteSearch(Request $request)
    {
          $query = $request->get('query');
          $filterResult = User::where('name', 'LIKE', '%'. $query. '%')->get();
        //   $filterResult = Blog::where('blog_title', 'LIKE', '%'. $query. '%')->get();
          return response()->json($filterResult);
    }
}
