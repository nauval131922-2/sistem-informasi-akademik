<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User Logout Successfully!',
            'alert-type' => 'success',
        );

        return redirect()->route('home')->with($notification);
    }

    public function Profile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $title = 'Data Profil';

        return view('backend.profile.profile', compact('user', 'title'));
    }

    public function UpdateProfile(Request $request)
    {   
        // get id user
        $id = Auth::user()->id;
        $user = User::find($id);

        // validasi
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'nullable|email|unique:users,email,'.$id,
        //     'username' => 'required|unique:users,username,'.$id,
        //     'profile_image' => 'nullable|image',
        // ]);

        // validator
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'nullable|email|unique:users,email,'.$id,
            'username' => 'required|unique:users,username,'.$id,
            'profile_image' => 'nullable|image',
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        // simpan data request yang required
        $user->name = $request->name;
        $user->username = $request->username;

        // simpan data request yang nullable jika tidak kosong
        if ($request->email != null) {
            $user->email = $request->email;
        }

        // validasi password
        // cek new password sama dengan confirm password
        if ($request->newpassword != null && $request->confirmpassword != null && $request->oldpassword != null) {
            // cek old password sama dengan password di database
            if (Hash::check($request->oldpassword, $user->password)) {
                // cek new password sama dengan confirm password
                if ($request->newpassword == $request->confirmpassword) {
                    // simpan password baru
                    $user->password = bcrypt($request->newpassword);
                } else {
                    // redirect
                    // $notification = array(
                    //     'message' => 'New Password and Confirm Password does not match!',
                    //     'alert-type' => 'error',
                    // );
                    
                    // return redirect()->back()->with($notification);

                    return response()->json([
                        'status' => 'error2',
                        'message' => 'New Password and Confirm Password does not match!'
                    ]);
                }
            } else {
                // redirect
                // $notification = array(
                //     'message' => 'Old Password is not match!',
                //     'alert-type' => 'error',
                // );
                
                // return redirect()->back()->with($notification);

                return response()->json([
                    'status' => 'error2',
                    'message' => 'Old Password is not match!'
                ]);
            }
        }

        // simpan gambar jika ada
        if ($request->hasFile('gambar')) {

            if ($user->profile_image) {
                unlink($user->profile_image);
            }

            // simpan nama file dengan $request->nama hexdec(uniqid())
            $judul_tanpa_spasi = str_replace(' ', '-', $request->name);
            $nama_file = $judul_tanpa_spasi.'-'.hexdec(uniqid()).'.'.$request->gambar->getClientOriginalExtension();
            
            // $nama_file = hexdec(uniqid()).'.'.$request->gambar->getClientOriginalExtension();
            Image::make($request->gambar)->save(public_path('/upload/profile_picture/'.$nama_file));

            $user->profile_image = 'upload/profile_picture/'.$nama_file;
        } elseif ($request->gambarPreview == null && $user->profile_image != null) {
            unlink($user->profile_image);

            $user->profile_image = null;
        } elseif ($request->gambarPreview != null && $user->profile_image != null) {
            // get file extension
            $file_ext = pathinfo($user->profile_image, PATHINFO_EXTENSION);

            $judul_tanpa_spasi = str_replace(' ', '-', $request->name);
            $nama_file = $judul_tanpa_spasi.'-'.hexdec(uniqid()).'.'.$file_ext;
            // rename file name
            rename(public_path($user->profile_image), public_path('upload/profile_picture/'.$nama_file));

            $user->profile_image = 'upload/profile_picture/'.$nama_file;
        }

        // simpan data
        // $user->save();

        // // redirect
        // $notification = array(
        //     'message' => 'User Profile Updated Successfully!',
        //     'alert-type' => 'success',
        // );
        
        // return redirect()->back()->with($notification);

        // jika berhasil disimpan
        if ($user->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'User Profile Updated Successfully!'
            ]);
        } else {
            return response()->json([
                'status' => 'error2',
                'message' => 'User Profile Updated Failed!'
            ]);
        }
    }

    public function ChangePassword()
    {
        return view('backend.change-password');
    }

    public function UpdatePassword(Request $request)
    {
        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required|min:6',
            'confirmpassword' => 'required|same:newpassword',
        ],
        [
            'oldpassword.required' => 'Please enter your old password',
            'newpassword.required' => 'Please enter your new password',
            'confirmpassword.required' => 'Please enter your confirm password',
            'confirmpassword.same' => 'Confirm password does not match',
        ]);

        $hashedPassword = Auth::user()->password;

        if(Hash::check($request->oldpassword, $hashedPassword)){
            $users = User::find(Auth::id());
            $users->password = bcrypt($request->newpassword);
            $users->save();

            session()->flash('message', 'Password Changed Successfully!');

            return redirect()->back();
        } else{
            session()->flash('message', 'Old Password is not match!');

            return redirect()->back();
        }
    }

    function fetch()
    {
        // get data user yang login
        $user = Auth::user();

        return response()->json([
            'data' => $user
        ]);
    }
}
