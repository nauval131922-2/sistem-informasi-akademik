<?php

namespace App\Http\Controllers\Home;

use Carbon\Carbon;
use App\Models\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function Contact(){
        return view('frontend.contact');
    }

    public function StoreMessage(Request $request){
        Contact::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'phone' => $request->phone,
            'message' => $request->message,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);   

        $notification = array(
            'message' => 'Message sent successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function ContactMessage(){
        $contact = Contact::latest()->get();

        return view('admin.contact.contact', compact('contact'));
    }

    public function DeleteMessage($id){
        Contact::where('id', $id)->delete();

        $notification = array(
            'message' => 'Message deleted successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
