<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Jabatan;
use App\Models\MediaSosial;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Models\ProfilSekolah;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index($id)
    {
        $semua_user = User::where('id_role', $id)->get();
        $id_role = $id;
        $role = Jabatan::where('id', $id)->first();
        // $title = 'Data ' . $role->nama;
        $title = 'Data User';

        return view('backend.user.index', compact('semua_user', 'title', 'id_role', 'role'));
    }

    public function index_all()
    {
        $semua_user = User::all();
        $title = 'Data User';
        // id role user yang sedang login
        // $id_role = Auth::user()->id_role;
        // semua role keculai role dengan id = 2
        $semua_role = Jabatan::where('id', '!=', 2)->get();

        return view('backend.user.index', compact('semua_user', 'title', 'semua_role'));
    }

    public function tambah($id)
    {
        $semua_kelas = Kelas::all();
        $semua_mapel = MataPelajaran::all();
        $id_role = $id;
        $role = Jabatan::where('id', $id)->first();
        $title = 'Data ' . $role->nama;

        return view('backend.user.tambah', compact('semua_kelas', 'semua_mapel', 'title', 'id_role', 'role'));
    }

    public function simpan(Request $request, $id_role)
    {
        // validasi
        // $request->validate([
        //     'nama' => 'required',
        //     'username' => 'required|unique:users,username',
        //     'email' => 'nullable|email|unique:users,email',
        //     'password' => 'required|min:6',
        //     'confirm_password' => 'required|same:password',
        //     'kelas' => 'required_if:id_role,3,5',
        //     'mapel' => 'required_if:id_role,4',
        // ]);

        // validator
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'nullable|email|unique:users,email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'kelas' => 'required_if:id_role,3,5',
            'mapel' => 'required_if:id_role,4',
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        // cek jika $id = 3 (guru wali kelas) dan ada guru wali kelas dengan kelas yang sama
        if ($id_role == 3 && User::where('id_role', 3)->where('id_kelas', $request->kelas)->count() > 0) {
            // $notification = array(
            //     'message' => 'Guru wali kelas dengan kelas yang sama sudah ada',
            //     'alert-type' => 'error'
            // );

            // return redirect()->back()->withInput()->with($notification);

            return response()->json([
                'status' => 'error2',
                'message' => 'Guru wali kelas dengan kelas yang sama sudah ada'
            ]);
        }

        // simpan data selain gambar
        $user = new User;
        $user->name = $request->nama;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->id_role = $id_role;
        $user->id_kelas = $request->kelas;
        $user->id_mapel = $request->mapel;

        // simpan data gambar
        if ($request->hasFile('gambar')) {
            $judul_tanpa_spasi = str_replace(' ', '-', $request->nama);
            $nama_file = $judul_tanpa_spasi . '-' . hexdec(uniqid()) . '.' . $request->gambar->getClientOriginalExtension();
            Image::make($request->gambar)->save(public_path('/upload/profile_picture/' . $nama_file));

            $user->profile_image = 'upload/profile_picture/' . $nama_file;
        }

        // simpan data
        $user->save();

        // jika id_role = 3 (guru wali kelas) atau 4 (guru mapel) maka simpan ke tabel guru
        // jika id_role = 5 (siswa) maka simpan ke tabel siswa
        if ($id_role == 3 || $id_role == 4) {
            $guru = new Guru();
            $guru->id_user_for_guru = $user->id;

            $guru->save();
        } else if ($id_role == 5) {
            $siswa = new Siswa();
            $siswa->id_user_for_siswa = $user->id;

            $siswa->save();
        }

        // // notifikasi
        // $notification = array(
        //     'message' => 'Data berhasil disimpan!',
        //     'alert-type' => 'success',
        // );
        // return redirect()->route('user-index', $id_role)->with($notification);

        // jika berhasil disimpan
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil disimpan'
        ]);
    }

    public function guru_wali_kelas_index()
    {
        $semua_user = User::where('id_role', '=', '3')->get();
        $title = 'Data Guru Wali Kelas';

        return view('backend.guru.index', compact('semua_user', 'title'));
    }

    public function guru_mapel_index()
    {
        $semua_user = User::where('id_role', '=', '4')->get();
        $title = 'Data Guru Mata Pelajaran';

        return view('backend.guru.index', compact('semua_user', 'title'));
    }

    public function siswa_index($id)
    {
        $semua_siswa = User::where('id_role', '=', '5')->where('id_kelas', '=', $id)->get();
        $title = 'Data Siswa Kelas ' . $id;

        return view('backend.siswa.index', compact('semua_siswa', 'title'));
    }

    public function index_guru_fe()
    {
        $profil_sekolah = ProfilSekolah::find(1);

        $semua_guru = User::where('id_role', '=', '2')->orWhere('id_role', '=', '3')->orWhere('id_role', '=', '4')->orderBy('id_role', 'asc')->orderBy('id_kelas', 'asc')->paginate(8);

        return view('frontend.guru.index', compact('profil_sekolah', 'semua_guru'));
    }

    public function hapus($id)
    {
        $user = User::find($id);

        // // jika user yang dihapus adalah user yang login
        // if($user->id == Auth::user()->id){
        //     $notification = array(
        //         'message' => 'Tidak bisa menghapus akun yang sedang login!',
        //         'alert-type' => 'error'
        //     );

        //     return redirect()->back()->with($notification);
        // }

        // cek jika ada gambar
        if ($user->profile_image != null) {
            unlink($user->profile_image);
        }

        $user->delete();

        // $notification = array(
        //     'message' => 'Data berhasil dihapus!',
        //     'alert-type' => 'success'
        // );

        // return redirect()->back()->with($notification);

        // jika berhasil dihapus
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus'
        ]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        $semua_kelas = Kelas::all();
        $semua_mapel = MataPelajaran::all();
        $id_role = $user->id_role;
        $role = Jabatan::where('id', $id_role)->first();
        $title = 'Data ' . $role->nama;

        return view('backend.user.edit', compact('user', 'semua_kelas', 'semua_mapel', 'title', 'id_role', 'role'));
    }

    public function update(Request $request, $id)
    {
        // validasi (oke)
        // $request->validate([
        //     'nama' => 'required',
        //     'username' => 'required|unique:users,username,' . $id,
        //     'email' => 'nullable|email|unique:users,email,' . $id,
        //     'kelas' => 'required_if:id_role,3,5',
        //     'mapel' => 'required_if:id_role,4'
        // ]);

        // validator
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'email' => 'nullable|email|unique:users,email,' . $id,
            'kelas' => 'required_if:id_role,3,5',
            'mapel' => 'required_if:id_role,4'
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        // validasi guru wali kelas dengan kelas yang sama sudah ada atau belum (oke)
        if ($request->id_role == 3) {
            $cek_guru_wali_kelas = User::where('id_kelas', '=', $request->kelas)->where('id_role', '=', '3')->where('id', '!=', $id)->first();

            if ($cek_guru_wali_kelas) {
                // $notification = array(
                //     'message' => 'Guru wali kelas dengan kelas yang sama sudah ada!',
                //     'alert-type' => 'error'
                // );

                // return redirect()->back()->withInput()->with($notification);

                return response()->json([
                    'status' => 'error2',
                    'message' => 'Guru wali kelas dengan kelas yang sama sudah ada'
                ]);
            }
        }

        // simpan data selain (oke)
        $user = User::find($id);
        $user->name = $request->nama;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->id_role = $request->id_role;
        $user->id_kelas = $request->kelas;
        $user->id_mapel = $request->mapel;

        // simpan data password jika password dan confirm password tidak kosong (oke)
        if ($request->password != null && $request->confirm_password != null) {
            // validasi password dan confirm password harus sama (oke)
            if ($request->password != $request->confirm_password) {
                // $notification = array(
                //     'message' => 'Password dan Confirm Password harus sama!',
                //     'alert-type' => 'error'
                // );

                // return redirect()->back()->withInput()->with($notification);

                return response()->json([
                    'status' => 'error3',
                    'message' => 'Password dan Confirm Password harus sama'
                ]);

            } else {
                $user->password = bcrypt($request->password);
            }
        }

        // simpan data gambar jika ada gambar yang diupload (oke)
        if ($request->hasFile('gambar')) {

            if ($user->profile_image) {
                unlink($user->profile_image);
            }

            // nama file untuk gambar adalah nama user dan hexdec(uniqid()) untuk menghindari nama file yang sama
            $judul_tanpa_spasi = str_replace(' ', '-', $request->nama);
            $nama_file = $judul_tanpa_spasi . '-' . hexdec(uniqid()) . '.' . $request->gambar->getClientOriginalExtension();

            // $nama_file = hexdec(uniqid()).'.'.$request->gambar->getClientOriginalExtension();
            Image::make($request->gambar)->save(public_path('/upload/profile_picture/' . $nama_file));

            $user->profile_image = 'upload/profile_picture/' . $nama_file;
        } elseif ($request->gambarPreview == null && $user->profile_image != null) {
            unlink($user->profile_image);

            $user->profile_image = null;
        } elseif ($request->gambarPreview != null && $user->profile_image != null) {
            // get file extension
            $file_ext = pathinfo($user->profile_image, PATHINFO_EXTENSION);

            $judul_tanpa_spasi = str_replace(' ', '-', $request->nama);
            $nama_file = $judul_tanpa_spasi . '-' . hexdec(uniqid()) . '.' . $file_ext;
            // rename file name
            rename(public_path($user->profile_image), public_path('upload/profile_picture/' . $nama_file));

            $user->profile_image = 'upload/profile_picture/' . $nama_file;
        }

        // simpan data ke database (oke)
        $user->save();

        // jika id_role = 3 (guru wali kelas) atau 4 (guru) maka simpan data ke tabel guru (oke)
        // jika id_role = 5 (siswa) maka simpan data ke tabel siswa (oke)
        if ($request->id_role == 3 || $request->id_role == 4) {
            $guru = Guru::where('id_user_for_guru', $id)->first();
            $guru->id_user_for_guru = $user->id;

            $guru->save();
        } else if ($request->id_role == 5) {
            $siswa = Siswa::where('id_user_for_siswa', $id)->first();
            $siswa->id_user_for_siswa = $user->id;

            $siswa->save();
        }

        // notifikasi (oke)
        // $notification = array(
        //     'message' => 'Data berhasil diubah!',
        //     'alert-type' => 'success'
        // );

        // // redirect (oke)
        // return redirect()->route('user-index', $user->id_role)->with($notification);

        // jika berhasil
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diubah'
        ]);
    }

    function filter_user(Request $request)
    {
        $user = User::with('role', 'kelas', 'mapel');

        // filter berdasarkan tipe pengguna
        if ($request->tipe_pengguna != null) {
            $user->where('id_role', $request->tipe_pengguna);
        }

        $user = $user->get();

        return response()->json([
            'data' => $user
        ]);
    }
}
