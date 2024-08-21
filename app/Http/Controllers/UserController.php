<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\Guru;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Jabatan;
use App\Models\MediaSosial;
use App\Models\TahunAjaran;
use App\Models\PrestasiSiswa;
use App\Models\JenisKelamin;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
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

        $kelas = Kelas::all();

        $mapel = MataPelajaran::all();

        $tahun_ajaran_aktif = TahunAjaran::where('status', "Aktif")->first();
        // nama tahun ajaran aktif


        // jika tidak ada tahun ajaran aktif
        if (!$tahun_ajaran_aktif) {
            $tahun_ajaran_aktif_semester = '';
            $tahun_ajaran_aktif_tahun = '';
        } else {
            $tahun_ajaran_aktif_semester = $tahun_ajaran_aktif->semester;
            $tahun_ajaran_aktif_tahun = $tahun_ajaran_aktif->tahun;
        }

        return view('backend.user.index', compact('semua_user', 'title', 'semua_role', 'kelas', 'mapel', 'tahun_ajaran_aktif', 'tahun_ajaran_aktif_semester', 'tahun_ajaran_aktif_tahun'));
    }

    public function tambah($id)
    {
        $semua_kelas = Kelas::all();
        $semua_mapel = MataPelajaran::all();
        $id_role = $id;
        $role = Jabatan::where('id', $id)->first();
        $title = 'Data ' . $role->nama;
        $semua_jenis_kelamin = ['Laki-laki', 'Perempuan'];
        $semua_jenjang_sebelumnya = ['RA', 'TK', 'PAUD', 'LOT'];
        $semua_jenis_mutasi = ['Mutasi Masuk', 'Mutasi Keluar', 'Lulus'];
        $semua_pendidikan_terakhir = ['SD', 'SMP', 'SLTA', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3'];
        $semua_status = ['Masih Hidup', 'Meninggal', 'Tidak diketahui'];

        return view('backend.user.tambah', compact('semua_kelas', 'semua_mapel', 'title', 'id_role', 'role', 'semua_jenis_kelamin', 'semua_jenjang_sebelumnya', 'semua_jenis_mutasi', 'semua_pendidikan_terakhir', 'semua_status'));
    }

    public function simpan(Request $request, $id_role)
    {

        // validator
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'nullable|email|unique:users,email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'kelas' => 'required_if:id_role,3,5',
            'mapel' => 'required_if:id_role,4',
            'nis_lokal' => 'required_if:id_role,5',
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        // cek jika $id = 5 (siswa) dan ada nis lokal yang sama
        $nis_lokal = Siswa::where('nis_lokal', $request->nis_lokal)->count();
        if ($id_role == 5 && $nis_lokal > 0) {
            return response()->json([
                'status' => 'error2',
                'message' => 'NIS lokal yang sama sudah ada'
            ]);
        }

        // cek jika $id = 3 (guru wali kelas) dan ada guru wali kelas dengan kelas yang sama
        if ($id_role == 3 && User::where('id_role', 3)->where('id_kelas', $request->kelas)->count() > 0) {

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
        $user->nip = $request->nip;

        // simpan data gambar
        if ($request->hasFile('gambar')) {
            $judul_tanpa_spasi = str_replace(' ', '-', $request->nama);
            $nama_file = $judul_tanpa_spasi . '-' . hexdec(uniqid()) . '.' . $request->gambar->getClientOriginalExtension();
            Image::make($request->gambar)->save(public_path('/upload/profile_picture/' . $nama_file));

            $user->profile_image = 'upload/profile_picture/' . $nama_file;
        }

        $user->save();

        if ($id_role == 3 || $id_role == 4) {
            $guru = new Guru();
            $guru->id_user_for_guru = $user->id;

            $guru->save();
        } else if ($id_role == 5) {
            $siswa = new Siswa();
            $siswa->id_user_for_siswa = $user->id;
            $siswa->nisn = $request->nisn;
            $siswa->nis_lokal = $request->nis_lokal;
            $siswa->nik = $request->nik;
            $siswa->jenis_kelamin = $request->jenis_kelamin;
            $siswa->jumlah_saudara = $request->jumlah_saudara;
            $siswa->tempat_lahir = $request->tempat_lahir;
            $siswa->cita_cita = $request->cita_cita;
            $siswa->tanggal_lahir = $request->tanggal_lahir;
            $siswa->hobi = $request->hobi;
            $siswa->alamat = $request->alamat;
            $siswa->jarak_rumah = $request->jarak_rumah;
            $siswa->nomor_hp = $request->nomor_hp;
            $siswa->nomor_kk = $request->nomor_kk;
            $siswa->tanggal_masuk = $request->tanggal_masuk;
            $siswa->nomor_kip = $request->nomor_kip;
            $siswa->jenjang_sebelumnya = $request->jenjang_sebelumnya;
            $siswa->jenis_mutasi = $request->jenis_mutasi;
            $siswa->sekolah_pra_sekolah = $request->sekolah_pra_sekolah;
            $siswa->sekolah_mutasi = $request->sekolah_mutasi;
            $siswa->npsn_pra_sekolah = $request->npsn_pra_sekolah;
            $siswa->npsn_mutasi = $request->npsn_mutasi;
            $siswa->nism_pra_sekolah = $request->nism_pra_sekolah;
            $siswa->nism_mutasi = $request->nism_mutasi;
            $siswa->nomor_ijazah = $request->nomor_ijazah;
            $siswa->tanggal_mutasi = $request->tanggal_mutasi;
            $siswa->ayah_kandung = $request->ayah_kandung;
            $siswa->ibu_kandung = $request->ibu_kandung;
            $siswa->status_ayah = $request->status_ayah;
            $siswa->status_ibu = $request->status_ibu;
            $siswa->nik_ayah = $request->nik_ayah;
            $siswa->nik_ibu = $request->nik_ibu;
            $siswa->tempat_lahir_ayah = $request->tempat_lahir_ayah;
            $siswa->tempat_lahir_ibu = $request->tempat_lahir_ibu;
            $siswa->tanggal_lahir_ayah = $request->tanggal_lahir_ayah;
            $siswa->tanggal_lahir_ibu = $request->tanggal_lahir_ibu;
            $siswa->pendidikan_ayah = $request->pendidikan_ayah;
            $siswa->pendidikan_ibu = $request->pendidikan_ibu;
            $siswa->pekerjaan_ayah = $request->pekerjaan_ayah;
            $siswa->pekerjaan_ibu = $request->pekerjaan_ibu;
            $siswa->nomor_kks = $request->nomor_kks;
            $siswa->nomor_pkh = $request->nomor_pkh;
            $siswa->id_diterima_di_kelas_for_siswa = $request->diterima_di_kelas;

            $siswa->agama = $request->agama;
            $siswa->status_dalam_keluarga = $request->status_dalam_keluarga;
            $siswa->anak_ke = $request->anak_ke;
            $siswa->nomor_telepon_rumah = $request->nomor_telepon_rumah;

            $siswa->nomor_telepon_ayah = $request->nomor_telepon_ayah;
            $siswa->nomor_telepon_ibu = $request->nomor_telepon_ibu;

            $siswa->alamat_ayah = $request->alamat_ayah;
            $siswa->alamat_ibu = $request->alamat_ibu;

            $siswa->nama_wali = $request->nama_wali;
            $siswa->pekerjaan_wali = $request->pekerjaan_wali;
            $siswa->nomor_telepon_wali = $request->nomor_telepon_wali;
            $siswa->alamat_wali = $request->alamat_wali;

            if ($request->hasFile('ijazah')) {
                $judul_tanpa_spasi = str_replace(' ', '-', $request->nama);
                $nama_file = $judul_tanpa_spasi . '-' . hexdec(uniqid()) . '.' . $request->ijazah->getClientOriginalExtension();
                Image::make($request->ijazah)->save(public_path('/upload/ijazah/' . $nama_file));

                $siswa->ijazah = 'upload/ijazah/' . $nama_file;
            }

            $siswa->save();
        }

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

        // cek jika ada gambar
        if ($user->profile_image != null) {
            unlink($user->profile_image);
        }

        // jika role siswa
        if ($user->id_role == 5) {
            $siswa = Siswa::where('id_user_for_siswa', $user->id)->first();

            // cek jika ada gambar ijazah
            if ($siswa->ijazah != null) {
                unlink($siswa->ijazah);
            }
        }

        $user->delete();

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

        $siswa = Siswa::where('id_user_for_siswa', $id)->first();

        $semua_jenis_kelamin = ['Laki-laki', 'Perempuan'];
        $semua_jenjang_sebelumnya = ['RA', 'TK', 'PAUD', 'LOT'];
        $semua_jenis_mutasi = ['Mutasi Masuk', 'Mutasi Keluar', 'Lulus'];
        $semua_pendidikan_terakhir = ['SD', 'SMP', 'SLTA', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3'];
        $semua_status = ['Masih Hidup', 'Meninggal', 'Tidak diketahui'];

        return view('backend.user.edit', compact('user', 'semua_kelas', 'semua_mapel', 'title', 'id_role', 'role', 'semua_jenis_kelamin', 'semua_jenjang_sebelumnya', 'semua_jenis_mutasi', 'semua_pendidikan_terakhir', 'semua_status', 'siswa'));
    }

    public function update(Request $request, $id)
    {
        // validator
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'email' => 'nullable|email|unique:users,email,' . $id,
            'kelas' => 'required_if:id_role,3,5',
            'mapel' => 'required_if:id_role,4',
            'nis_lokal' => 'required_if:id_role,5',
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        // cek jika $id = 5 (siswa) dan ada nis lokal yang sama dan bukan yang sedang di edit
        $nis_lokal = Siswa::where('nis_lokal', $request->nis_lokal)->where('id_user_for_siswa', '!=', $id)->count();
        $id_role = $request->id_role;
        if ($id_role == 5 && $nis_lokal > 0) {
            return response()->json([
                'status' => 'error2',
                'message' => 'NIS lokal yang sama sudah ada'
            ]);
        }

        // validasi guru wali kelas dengan kelas yang sama sudah ada atau belum (oke)
        if ($request->id_role == 3) {
            $cek_guru_wali_kelas = User::where('id_kelas', '=', $request->kelas)->where('id_role', '=', '3')->where('id', '!=', $id)->first();

            if ($cek_guru_wali_kelas) {

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
        $user->nip = $request->nip;

        // simpan data password jika password dan confirm password tidak kosong (oke)
        if ($request->password != null && $request->confirm_password != null) {
            // validasi password dan confirm password harus sama (oke)
            if ($request->password != $request->confirm_password) {

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

            if ($user->profile_image != null) {
                unlink($user->profile_image);
            }

            // nama file untuk gambar adalah nama user dan hexdec(uniqid()) untuk menghindari nama file yang sama
            $judul_tanpa_spasi = str_replace(' ', '-', $request->nama);
            $nama_file = $judul_tanpa_spasi . '-' . hexdec(uniqid()) . '.' . $request->gambar->getClientOriginalExtension();

            // $nama_file = hexdec(uniqid()).'.'.$request->gambar->getClientOriginalExtension();
            Image::make($request->gambar)->save(public_path('/upload/profile_picture/' . $nama_file));

            $user->profile_image = 'upload/profile_picture/' . $nama_file;
        } elseif ($request->gambarPreview != null && $user->profile_image != null) {
            // get file extension
            $file_ext = pathinfo($user->profile_image, PATHINFO_EXTENSION);

            $judul_tanpa_spasi = str_replace(' ', '-', $request->nama);
            $nama_file = $judul_tanpa_spasi . '-' . hexdec(uniqid()) . '.' . $file_ext;
            // rename file name
            rename(public_path($user->profile_image), public_path('upload/profile_picture/' . $nama_file));

            $user->profile_image = 'upload/profile_picture/' . $nama_file;
        } elseif ($request->gambarPreview == null) {
            if ($user->profile_image != null) {
                unlink($user->profile_image);
            }

            $user->profile_image = null;
        }

        // simpan data ke database (oke)
        $user->save();

        if ($request->id_role == 3 || $request->id_role == 4) {
            $guru = Guru::where('id_user_for_guru', $id)->first();
            // jika guru belum ada di tabel guru
            if (!$guru) {
                $guru = new Guru();
            }

            $guru->id_user_for_guru = $user->id;

            $guru->save();
        } else if ($request->id_role == 5) {
            $siswa = Siswa::where('id_user_for_siswa', $id)->first();
            // jika siswa belum ada di tabel siswa
            if (!$siswa) {
                $siswa = new Siswa();
            }
            $siswa->id_user_for_siswa = $user->id;
            $siswa->nisn = $request->nisn;
            $siswa->nis_lokal = $request->nis_lokal;
            $siswa->nik = $request->nik;
            $siswa->jenis_kelamin = $request->jenis_kelamin;
            $siswa->jumlah_saudara = $request->jumlah_saudara;
            $siswa->tempat_lahir = $request->tempat_lahir;
            $siswa->cita_cita = $request->cita_cita;
            $siswa->tanggal_lahir = $request->tanggal_lahir;
            $siswa->hobi = $request->hobi;
            $siswa->alamat = $request->alamat;
            $siswa->jarak_rumah = $request->jarak_rumah;
            $siswa->nomor_hp = $request->nomor_hp;
            $siswa->nomor_kk = $request->nomor_kk;
            $siswa->tanggal_masuk = $request->tanggal_masuk;
            $siswa->nomor_kip = $request->nomor_kip;
            $siswa->jenjang_sebelumnya = $request->jenjang_sebelumnya;
            $siswa->jenis_mutasi = $request->jenis_mutasi;
            if ($siswa->jenis_mutasi == 'Mutasi Keluar') {
                $user = User::find($id);
                $user->id_kelas = null;

                $user->save();
            };
            $siswa->sekolah_pra_sekolah = $request->sekolah_pra_sekolah;
            $siswa->sekolah_mutasi = $request->sekolah_mutasi;
            $siswa->npsn_pra_sekolah = $request->npsn_pra_sekolah;
            $siswa->npsn_mutasi = $request->npsn_mutasi;
            $siswa->nism_pra_sekolah = $request->nism_pra_sekolah;
            $siswa->nism_mutasi = $request->nism_mutasi;
            $siswa->nomor_ijazah = $request->nomor_ijazah;
            $siswa->tanggal_mutasi = $request->tanggal_mutasi;
            $siswa->ayah_kandung = $request->ayah_kandung;
            $siswa->ibu_kandung = $request->ibu_kandung;
            $siswa->status_ayah = $request->status_ayah;
            $siswa->status_ibu = $request->status_ibu;
            $siswa->nik_ayah = $request->nik_ayah;
            $siswa->nik_ibu = $request->nik_ibu;
            $siswa->tempat_lahir_ayah = $request->tempat_lahir_ayah;
            $siswa->tempat_lahir_ibu = $request->tempat_lahir_ibu;
            $siswa->tanggal_lahir_ayah = $request->tanggal_lahir_ayah;
            $siswa->tanggal_lahir_ibu = $request->tanggal_lahir_ibu;
            $siswa->pendidikan_ayah = $request->pendidikan_ayah;
            $siswa->pendidikan_ibu = $request->pendidikan_ibu;
            $siswa->pekerjaan_ayah = $request->pekerjaan_ayah;
            $siswa->pekerjaan_ibu = $request->pekerjaan_ibu;
            $siswa->nomor_kks = $request->nomor_kks;
            $siswa->nomor_pkh = $request->nomor_pkh;
            $siswa->id_diterima_di_kelas_for_siswa = $request->diterima_di_kelas;

            $siswa->agama = $request->agama;
            $siswa->status_dalam_keluarga = $request->status_dalam_keluarga;
            $siswa->anak_ke = $request->anak_ke;
            $siswa->nomor_telepon_rumah = $request->nomor_telepon_rumah;

            $siswa->nomor_telepon_ayah = $request->nomor_telepon_ayah;
            $siswa->nomor_telepon_ibu = $request->nomor_telepon_ibu;

            $siswa->alamat_ayah = $request->alamat_ayah;
            $siswa->alamat_ibu = $request->alamat_ibu;

            $siswa->nama_wali = $request->nama_wali;
            $siswa->pekerjaan_wali = $request->pekerjaan_wali;
            $siswa->nomor_telepon_wali = $request->nomor_telepon_wali;
            $siswa->alamat_wali = $request->alamat_wali;

            if ($request->hasFile('ijazah')) {

                if ($siswa->ijazah != null) {
                    unlink($siswa->ijazah);
                }

                $judul_tanpa_spasi = str_replace(' ', '-', $request->nama);
                $nama_file = $judul_tanpa_spasi . '-' . hexdec(uniqid()) . '.' . $request->ijazah->getClientOriginalExtension();

                Image::make($request->ijazah)->save(public_path('/upload/ijazah/' . $nama_file));

                $siswa->ijazah = 'upload/ijazah/' . $nama_file;
            } elseif ($request->ijazahPreview != null && $siswa->ijazah != null) {
                $file_ext = pathinfo($siswa->ijazah, PATHINFO_EXTENSION);

                $judul_tanpa_spasi = str_replace(' ', '-', $request->nama);
                $nama_file = $judul_tanpa_spasi . '-' . hexdec(uniqid()) . '.' . $file_ext;
                rename(public_path($siswa->ijazah), public_path('upload/ijazah/' . $nama_file));

                $siswa->ijazah = 'upload/ijazah/' . $nama_file;
            } elseif ($request->ijazahPreview == null) {
                if ($siswa->ijazah != null) {
                    unlink($siswa->ijazah);
                }

                $siswa->ijazah = null;
            }

            $siswa->save();
        }


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

        // filter berdasarkan kelas
        if ($request->kelas != null) {
            $user->where('id_kelas', $request->kelas);
        }

        // filter berdasarkan mata pelajaran
        if ($request->mapel != null) {
            $user->where('id_mapel', $request->mapel);
        }

        $user = $user->get();

        return response()->json([
            'data' => $user
        ]);
    }

    function cetak(Request $request)
    {
        $id_siswa = $request->id_siswa;

        $foto = User::where('id', $id_siswa)->first()->profile_image;

        $nama_lengkap = User::where('id', $id_siswa)->first()->name;
        $nisn = Siswa::where('id_user_for_siswa', $id_siswa)->first()->nisn;
        $nis_lokal = Siswa::where('id_user_for_siswa', $id_siswa)->first()->nis_lokal;
        $nik = Siswa::where('id_user_for_siswa', $id_siswa)->first()->nik;

        $jenis_kelamin = Siswa::where('id_user_for_siswa', $id_siswa)->first()->jenis_kelamin;
        $tempat_lahir = Siswa::where('id_user_for_siswa', $id_siswa)->first()->tempat_lahir;
        $tanggal_lahir = Carbon::parse(Siswa::where('id_user_for_siswa', $id_siswa)->first()->tanggal_lahir)->format('d-m-Y');
        $alamat = Siswa::where('id_user_for_siswa', $id_siswa)->first()->alamat;
        $nomor_hp = Siswa::where('id_user_for_siswa', $id_siswa)->first()->nomor_hp;
        $tanggal_masuk = Carbon::parse(Siswa::where('id_user_for_siswa', $id_siswa)->first()->tanggal_masuk)->format('d-m-Y');
        $kelas = Kelas::where('id', User::where('id', $id_siswa)->first()->id_kelas)->first()->id;
        $diterima_di_kelas = Kelas::where('id', Siswa::where('id_user_for_siswa', $id_siswa)->first()->id_diterima_di_kelas_for_siswa)->first()->id ?? null;

        $jumlah_saudara = Siswa::where('id_user_for_siswa', $id_siswa)->first()->jumlah_saudara;
        $cita_cita = Siswa::where('id_user_for_siswa', $id_siswa)->first()->cita_cita;
        $hobi = Siswa::where('id_user_for_siswa', $id_siswa)->first()->hobi;
        $jarak_rumah = Siswa::where('id_user_for_siswa', $id_siswa)->first()->jarak_rumah;
        $nomor_kk = Siswa::where('id_user_for_siswa', $id_siswa)->first()->nomor_kk;
        $nomor_kip = Siswa::where('id_user_for_siswa', $id_siswa)->first()->nomor_kip;

        $jenjang_sebelumnya = Siswa::where('id_user_for_siswa', $id_siswa)->first()->jenjang_sebelumnya;
        $jenis_mutasi = Siswa::where('id_user_for_siswa', $id_siswa)->first()->jenis_mutasi;

        $sekolah_pra = Siswa::where('id_user_for_siswa', $id_siswa)->first()->sekolah_pra_sekolah;
        $sekolah_mutasi = Siswa::where('id_user_for_siswa', $id_siswa)->first()->sekolah_mutasi;

        $npsn_pra = Siswa::where('id_user_for_siswa', $id_siswa)->first()->npsn_pra_sekolah;
        $npsn_mutasi = Siswa::where('id_user_for_siswa', $id_siswa)->first()->npsn_mutasi;

        $nism_pra = Siswa::where('id_user_for_siswa', $id_siswa)->first()->nism_pra_sekolah;
        $nism_mutasi = Siswa::where('id_user_for_siswa', $id_siswa)->first()->nism_mutasi;

        $nomor_ijazah = Siswa::where('id_user_for_siswa', $id_siswa)->first()->nomor_ijazah;
        $tanggal_mutasi = Carbon::parse(Siswa::where('id_user_for_siswa', $id_siswa)->first()->tanggal_mutasi)->format('d-m-Y');

        $ayah_kandung = Siswa::where('id_user_for_siswa', $id_siswa)->first()->ayah_kandung;
        $ibu_kandung = Siswa::where('id_user_for_siswa', $id_siswa)->first()->ibu_kandung;

        $status_ayah = Siswa::where('id_user_for_siswa', $id_siswa)->first()->status_ayah;
        $status_ibu = Siswa::where('id_user_for_siswa', $id_siswa)->first()->status_ibu;

        $nik_ayah = Siswa::where('id_user_for_siswa', $id_siswa)->first()->nik_ayah;
        $nik_ibu = Siswa::where('id_user_for_siswa', $id_siswa)->first()->nik_ibu;

        $tempat_lahir_ayah = Siswa::where('id_user_for_siswa', $id_siswa)->first()->tempat_lahir_ayah;
        $tempat_lahir_ibu = Siswa::where('id_user_for_siswa', $id_siswa)->first()->tempat_lahir_ibu;

        $tanggal_lahir_ayah = Carbon::parse(Siswa::where('id_user_for_siswa', $id_siswa)->first()->tanggal_lahir_ayah)->format('d-m-Y');
        $tanggal_lahir_ibu = Carbon::parse(Siswa::where('id_user_for_siswa', $id_siswa)->first()->tanggal_lahir_ibu)->format('d-m-Y');

        $pendidikan_ayah = Siswa::where('id_user_for_siswa', $id_siswa)->first()->pendidikan_ayah;
        $pendidikan_ibu = Siswa::where('id_user_for_siswa', $id_siswa)->first()->pendidikan_ibu;

        $pekerjaan_ayah = Siswa::where('id_user_for_siswa', $id_siswa)->first()->pekerjaan_ayah;
        $pekerjaan_ibu = Siswa::where('id_user_for_siswa', $id_siswa)->first()->pekerjaan_ibu;

        $nomor_kks = Siswa::where('id_user_for_siswa', $id_siswa)->first()->nomor_kks;
        $nomor_pkh = Siswa::where('id_user_for_siswa', $id_siswa)->first()->nomor_pkh;

        $semua_mata_pelajaran = MataPelajaran::all();

        // get semua data nama kelas
        $semua_kelas = Kelas::all();

        $nama_file = 'Cetak Data Siswa' . '.pdf';

        $semua_nilai = Nilai::where('id_siswa_for_nilai', $id_siswa)->get();

        $semua_semester = ['Gasal', 'Genap'];

        return view('backend.user.cetak', compact('id_siswa', 'nama_file', 'nama_lengkap', 'nisn', 'kelas', 'nis_lokal', 'nik', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'cita_cita', 'jumlah_saudara', 'foto', 'hobi', 'jarak_rumah', 'nomor_hp', 'tanggal_masuk', 'nomor_kk', 'nomor_kip', 'ayah_kandung', 'ibu_kandung', 'status_ayah', 'status_ibu', 'nik_ayah', 'nik_ibu', 'tempat_lahir_ayah', 'tempat_lahir_ibu', 'tanggal_lahir_ayah', 'tanggal_lahir_ibu', 'pendidikan_ayah', 'pendidikan_ibu', 'pekerjaan_ayah', 'pekerjaan_ibu', 'nomor_kks', 'nomor_pkh', 'jenjang_sebelumnya', 'jenis_mutasi', 'sekolah_pra', 'sekolah_mutasi', 'npsn_pra', 'npsn_mutasi', 'nism_pra', 'nism_mutasi', 'nomor_ijazah', 'tanggal_mutasi', 'semua_mata_pelajaran', 'semua_nilai', 'diterima_di_kelas', 'semua_kelas', 'semua_semester'));
    }



    public function naik()
    {
        // jika tidak ada user dengan role siswa yang id kelas 1, maka gagal naik
        if (User::where('id_role', '=', 5)->where('id_kelas', '=', 1)->count() == 0) {
            return response()->json(['status' => 'warning', 'message' => 'Gagal menaikkan kelas, kelas 1 masih kosong']);
        }

        // jika id_kelas 6 maka kosongkan id_kelas dan isi kolom lulus dengan 1
        User::where('id_role', '=', 5)->where('id_kelas', '=', 6)->update(['id_kelas' => null, 'lulus' => 1]);

        // Hanya menaikkan kelas untuk pengguna yang kelasnya kurang dari 6
        User::where('id_kelas', '<', 6)->where('id_role', '=', 5)->increment('id_kelas');

        return response()->json(['status' => 'success', 'message' => 'Berhasil menaikkan kelas']);
    }

    public function turun()
    {
        // jika ada user dengan role siswa yang id kelas 1, maka gagal turun
        if (User::where('id_role', '=', 5)->where('id_kelas', '=', 1)->count() > 0) {
            return response()->json(['status' => 'warning', 'message' => 'Gagal menurunkan kelas, kelas 1 tidak kosong']);
        }

        // Hanya menaikkan kelas untuk pengguna yang kelasnya lebih dari 1
        User::where('id_kelas', '>', 1)->where('id_role', '=', 5)->decrement('id_kelas');

        return response()->json(['status' => 'success', 'message' => 'Berhasil menaikkan kelas']);
    }

    public function fileImportDataSiswa(Request $request)
    {

        // validator
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xls,xlsx,csv,xlsm,xlsb,xltx,xltm'
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        // kondisi jika berhasil diimport
        if (Excel::import(new UsersImport, $request->file('file')->store('temp'))) {
            // redirect ke halaman awal
            return response()->json(['status' => 'success', 'message' => 'Data berhasil diimport.']);
        } else {
            // redirect ke halaman awal
            return response()->json(['status' => 'error2', 'message' => 'Data gagal diimport.']);
        }
    }

    public function index_rapor()
    {
        $semua_user = User::all();
        $kelas = Auth::user()->id_kelas;
        $title = 'Data Siswa Kelas ' . $kelas;
        $semua_role = Jabatan::where('id', '!=', 2)->get();

        $kelas = Kelas::all();

        $mapel = MataPelajaran::all();

        $tahun_ajaran_aktif = TahunAjaran::where('status', "Aktif")->first();
        // nama tahun ajaran aktif

        // jika tidak ada tahun ajaran aktif
        if (!$tahun_ajaran_aktif) {
            $tahun_ajaran_aktif_semester = '';
            $tahun_ajaran_aktif_tahun = '';
        } else {
            $tahun_ajaran_aktif_semester = $tahun_ajaran_aktif->semester;
            $tahun_ajaran_aktif_tahun = $tahun_ajaran_aktif->tahun;
        }

        return view('backend.rapor.index', compact('semua_user', 'title', 'semua_role', 'kelas', 'mapel', 'tahun_ajaran_aktif', 'tahun_ajaran_aktif_semester', 'tahun_ajaran_aktif_tahun'));
    }

    function fetch_rapor()
    {
        $kelas = Auth::user()->id_kelas;
        $semua_siswa = Siswa::join('users', 'users.id', '=', 'siswas.id_user_for_siswa')->where('users.id_role', '=', '5')->where('users.id_kelas', '=', $kelas)->with('user')->get();

        return response()->json([
            'data' => $semua_siswa
        ]);
    }

    function cetakRapor(Request $request)
    {
        $id_siswa = $request->id_siswa;

        $foto = User::where('id', $id_siswa)->first()->profile_image ?? null;

        $nama_lengkap = User::where('id', $id_siswa)->first()->name ?? null;
        $nisn = Siswa::where('id_user_for_siswa', $id_siswa)->first()->nisn ?? null;
        $nis_lokal = Siswa::where('id_user_for_siswa', $id_siswa)->first()->nis_lokal ?? null;
        $nik = Siswa::where('id_user_for_siswa', $id_siswa)->first()->nik ?? null;

        $jenis_kelamin = Siswa::where('id_user_for_siswa', $id_siswa)->first()->jenis_kelamin ?? null;
        $tempat_lahir = Siswa::where('id_user_for_siswa', $id_siswa)->first()->tempat_lahir ?? null;
        $tanggal_lahir = Carbon::parse(Siswa::where('id_user_for_siswa', $id_siswa)->first()->tanggal_lahir)->format('d-m-Y') ?? null;
        $alamat = Siswa::where('id_user_for_siswa', $id_siswa)->first()->alamat ?? null;
        $nomor_hp = Siswa::where('id_user_for_siswa', $id_siswa)->first()->nomor_hp ?? null;
        $tanggal_masuk = Carbon::parse(Siswa::where('id_user_for_siswa', $id_siswa)->first()->tanggal_masuk)->format('d-m-Y') ?? null;
        $kelas = Kelas::where('id', User::where('id', $id_siswa)->first()->id_kelas)->first()->id ?? null;
        $diterima_di_kelas = Kelas::where('id', Siswa::where('id_user_for_siswa', $id_siswa)->first()->id_diterima_di_kelas_for_siswa)->first()->id ?? null;

        $jumlah_saudara = Siswa::where('id_user_for_siswa', $id_siswa)->first()->jumlah_saudara ?? null;
        $cita_cita = Siswa::where('id_user_for_siswa', $id_siswa)->first()->cita_cita ?? null;
        $hobi = Siswa::where('id_user_for_siswa', $id_siswa)->first()->hobi ?? null;
        $jarak_rumah = Siswa::where('id_user_for_siswa', $id_siswa)->first()->jarak_rumah ?? null;
        $nomor_kk = Siswa::where('id_user_for_siswa', $id_siswa)->first()->nomor_kk ?? null;
        $nomor_kip = Siswa::where('id_user_for_siswa', $id_siswa)->first()->nomor_kip ?? null;

        $jenjang_sebelumnya = Siswa::where('id_user_for_siswa', $id_siswa)->first()->jenjang_sebelumnya ?? null;
        $jenis_mutasi = Siswa::where('id_user_for_siswa', $id_siswa)->first()->jenis_mutasi ?? null;

        $sekolah_pra = Siswa::where('id_user_for_siswa', $id_siswa)->first()->sekolah_pra_sekolah ?? null;
        $sekolah_mutasi = Siswa::where('id_user_for_siswa', $id_siswa)->first()->sekolah_mutasi ?? null;

        $npsn_pra = Siswa::where('id_user_for_siswa', $id_siswa)->first()->npsn_pra_sekolah ?? null;
        $npsn_mutasi = Siswa::where('id_user_for_siswa', $id_siswa)->first()->npsn_mutasi ?? null;

        $nism_pra = Siswa::where('id_user_for_siswa', $id_siswa)->first()->nism_pra_sekolah ?? null;
        $nism_mutasi = Siswa::where('id_user_for_siswa', $id_siswa)->first()->nism_mutasi ?? null;

        $nomor_ijazah = Siswa::where('id_user_for_siswa', $id_siswa)->first()->nomor_ijazah ?? null;
        $tanggal_mutasi = Carbon::parse(Siswa::where('id_user_for_siswa', $id_siswa)->first()->tanggal_mutasi)->format('d-m-Y') ?? null;

        $ayah_kandung = Siswa::where('id_user_for_siswa', $id_siswa)->first()->ayah_kandung ?? null;
        $ibu_kandung = Siswa::where('id_user_for_siswa', $id_siswa)->first()->ibu_kandung ?? null;

        $status_ayah = Siswa::where('id_user_for_siswa', $id_siswa)->first()->status_ayah ?? null;
        $status_ibu = Siswa::where('id_user_for_siswa', $id_siswa)->first()->status_ibu ?? null;

        $nik_ayah = Siswa::where('id_user_for_siswa', $id_siswa)->first()->nik_ayah ?? null;
        $nik_ibu = Siswa::where('id_user_for_siswa', $id_siswa)->first()->nik_ibu ?? null;

        $tempat_lahir_ayah = Siswa::where('id_user_for_siswa', $id_siswa)->first()->tempat_lahir_ayah ?? null;
        $tempat_lahir_ibu = Siswa::where('id_user_for_siswa', $id_siswa)->first()->tempat_lahir_ibu ?? null;

        $tanggal_lahir_ayah = Carbon::parse(Siswa::where('id_user_for_siswa', $id_siswa)->first()->tanggal_lahir_ayah)->format('d-m-Y') ?? null;
        $tanggal_lahir_ibu = Carbon::parse(Siswa::where('id_user_for_siswa', $id_siswa)->first()->tanggal_lahir_ibu)->format('d-m-Y') ?? null;

        $pendidikan_ayah = Siswa::where('id_user_for_siswa', $id_siswa)->first()->pendidikan_ayah ?? null;
        $pendidikan_ibu = Siswa::where('id_user_for_siswa', $id_siswa)->first()->pendidikan_ibu ?? null;

        $pekerjaan_ayah = Siswa::where('id_user_for_siswa', $id_siswa)->first()->pekerjaan_ayah ?? null;
        $pekerjaan_ibu = Siswa::where('id_user_for_siswa', $id_siswa)->first()->pekerjaan_ibu ?? null;

        $nomor_kks = Siswa::where('id_user_for_siswa', $id_siswa)->first()->nomor_kks ?? null;
        $nomor_pkh = Siswa::where('id_user_for_siswa', $id_siswa)->first()->nomor_pkh ?? null;

        $semua_prestasi_siswa = PrestasiSiswa::where('id_user_for_prestasi_siswa', $id_siswa)->get() ?? null;

        $semua_mata_pelajaran = MataPelajaran::all();

        // get semua data nama kelas
        $semua_kelas = Kelas::all();

        $nama_file = 'Cetak Data Siswa' . '.pdf';

        $semua_nilai = Nilai::where('id_siswa_for_nilai', $id_siswa)->get();

        $semua_semester = ['Gasal', 'Genap'];

        return view('backend.user.cetak', compact('id_siswa', 'nama_file', 'nama_lengkap', 'nisn', 'kelas', 'nis_lokal', 'nik', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'cita_cita', 'jumlah_saudara', 'foto', 'hobi', 'jarak_rumah', 'nomor_hp', 'tanggal_masuk', 'nomor_kk', 'nomor_kip', 'ayah_kandung', 'ibu_kandung', 'status_ayah', 'status_ibu', 'nik_ayah', 'nik_ibu', 'tempat_lahir_ayah', 'tempat_lahir_ibu', 'tanggal_lahir_ayah', 'tanggal_lahir_ibu', 'pendidikan_ayah', 'pendidikan_ibu', 'pekerjaan_ayah', 'pekerjaan_ibu', 'nomor_kks', 'nomor_pkh', 'jenjang_sebelumnya', 'jenis_mutasi', 'sekolah_pra', 'sekolah_mutasi', 'npsn_pra', 'npsn_mutasi', 'nism_pra', 'nism_mutasi', 'nomor_ijazah', 'tanggal_mutasi', 'semua_mata_pelajaran', 'semua_nilai', 'diterima_di_kelas', 'semua_kelas', 'semua_semester', 'semua_prestasi_siswa'));
    }
}
