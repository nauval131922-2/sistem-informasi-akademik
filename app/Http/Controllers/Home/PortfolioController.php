<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class PortfolioController extends Controller
{
    public function AllPortfolio(){
        $portfolio = Portfolio::latest()->get();
        return view('admin.portfolio.portfolio_all', compact('portfolio'));
    }

    public function AddPortfolio(){
        return view('admin.portfolio.portfolio_add');
    }

    public function StorePortfolio(Request $request){
        $request->validate([
            'portfolio_name' => 'required',
            'portfolio_title' => 'required',
            'portfolio_image' => 'required',
        ],[
            'portfolio_name.required' => 'Please enter portfolio name',
            'portfolio_title.required' => 'Please enter portfolio title',
        ]);

        $image = $request->file('portfolio_image');

        $name_generate = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

        Image::make($image)->resize(1020, 519)->save('upload/portfolio/'.$name_generate);

        $save_url = 'upload/portfolio/'.$name_generate;

        Portfolio::insert([
            'portfolio_name' => $request->portfolio_name,
            'portfolio_title' => $request->portfolio_title,
            'portfolio_description' => $request->portfolio_description,
            'portfolio_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Portfolio Inserted Successfully!',
            'alert-type' => 'success',
        );

        return redirect()->route('all.portfolio')->with($notification);
    }

    public function EditPortfolio($id){
        $portfolio = Portfolio::find($id);

        return view('admin.portfolio.portfolio_edit', compact('portfolio'));
    }

    public function UpdatePortfolio(Request $request){
        $portfolio_id = $request->id;

        if ($request->file('portfolio_image')){
            $image = $request->file('portfolio_image');
            $name_generate = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            Image::make($image)->resize(1020, 519)->save('upload/portfolio/'.$name_generate);

            $save_url = 'upload/portfolio/'.$name_generate;

            Portfolio::findOrFail($portfolio_id)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
                'portfolio_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Portfolio Updated with Image Successfully!',
                'alert-type' => 'success',
            );

            return redirect()->route('all.portfolio')->with($notification);
        } else {
            Portfolio::findOrFail($portfolio_id)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
            ]);
            $notification = array(
                'message' => 'Portfolio Updated without Image Successfully!',
                'alert-type' => 'success',
            );

            return redirect()->route('all.portfolio')->with($notification);
        }
    }

    public function DeletePortfolio($id){
        $portfolio = Portfolio::findOrFail($id);

        $img = $portfolio->portfolio_image;

        unlink($img);

        $portfolio->delete();

        $notification = array(
            'message' => 'Portfolio Deleted Successfully!',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function PortfolioDetails($id){
        $portfolio = Portfolio::findOrFail($id);

        return view('frontend.portfolio_details', compact('portfolio'));
    }

    public function HomePortfolio(){
        $portfolio = Portfolio::latest()->get();

        return view('frontend.portfolio', compact('portfolio'));
    }
}
