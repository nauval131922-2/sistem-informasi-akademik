<?php

namespace App\Http\Controllers\Home;

use Carbon\Carbon;
use App\Models\Footer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FooterController extends Controller
{
    public function FooterSetup(){
        $footer = Footer::find(1);

        return view('admin.footer.footer_setup', compact('footer'));
    }

    public function UpdateFooter(Request $request){
        $footer_id = $request->id;

        Footer::findOrFail($footer_id)->update([
            'number' => $request->number,
            'short_description' => $request->short_description,
            'address' => $request->address,
            'email' => $request->email,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'copyright' => $request->copyright,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Footer Updated Successfully!',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }
}
