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

    /**
     * Update the user profile.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function UpdateProfile(Request $request)
    {
        // Get the id of the authenticated user
        $id = Auth::user()->id;
        $user = User::find($id);

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required', // User name is required
            'email' => 'nullable|email|unique:users,email,'.$id, // Email is optional, unique, and must be a valid email format
            'username' => 'required|unique:users,username,'.$id, // Username is required and must be unique
            'profile_image' => 'nullable|image', // Profile image is optional and must be an image file
        ]);

        // If validation fails, return error response
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        // Save the required data from the request
        $user->name = $request->name;
        $user->username = $request->username;

        // Save the nullable data from the request if it is not empty
        if ($request->email != null) {
            $user->email = $request->email;
        } else {
            $user->email = null;
        }

        // Validate password
        // Check if new password, confirm password, and old password are not null
        if ($request->newpassword != null && $request->confirmpassword != null && $request->oldpassword != null) {
            // Check if old password matches the password in the database
            if (Hash::check($request->oldpassword, $user->password)) {
                // Check if new password and confirm password match
                if ($request->newpassword == $request->confirmpassword) {
                    // Save the new password
                    $user->password = bcrypt($request->newpassword);
                } else {
                    // Return error response if new password and confirm password do not match
                    return response()->json([
                        'status' => 'error2',
                        'message' => 'New Password and Confirm Password do not match!'
                    ]);
                }
            } else {
                // Return error response if old password does not match
                return response()->json([
                    'status' => 'error2',
                    'message' => 'Old Password does not match!'
                ]);
            }
        }

        // Save the uploaded image if there is one
        if ($request->hasFile('gambar')) {
            // If not using the default image, remove the old image
            if ($user->profile_image != 'upload/profile_picture/default/1.jpg') {
                unlink($user->profile_image);
            }

            // Save the uploaded image with a unique name
            $judul_tanpa_spasi = str_replace(' ', '-', $request->name);
            $nama_file = $judul_tanpa_spasi.'-'.hexdec(uniqid()).'.'.$request->gambar->getClientOriginalExtension();

            // Save the image
            Image::make($request->gambar)->save(public_path('/upload/profile_picture/'.$nama_file));

            $user->profile_image = 'upload/profile_picture/'.$nama_file;
        } elseif ($request->gambarPreview == null && $user->profile_image != null) {
            // If not using the default image, remove the old image
            if ($user->profile_image != 'upload/profile_picture/default/1.jpg') {
                unlink($user->profile_image);
            }

            $user->profile_image = 'upload/profile_picture/default/1.jpg';
        } elseif ($request->gambarPreview != null && $user->profile_image != null && $user->profile_image != 'upload/profile_picture/default/1.jpg') {
            // Get the file extension of the old image
            $file_ext = pathinfo($user->profile_image, PATHINFO_EXTENSION);

            $judul_tanpa_spasi = str_replace(' ', '-', $request->name);
            $nama_file = $judul_tanpa_spasi.'-'.hexdec(uniqid()).'.'.$file_ext;
            // Rename the old image file
            rename(public_path($user->profile_image), public_path('upload/profile_picture/'.$nama_file));

            $user->profile_image = 'upload/profile_picture/'.$nama_file;
        }

        // If the user profile is successfully updated, return success response
        if ($user->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'User Profile Updated Successfully!'
            ]);
        } else {
            // If the user profile update fails, return error response
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
