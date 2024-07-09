<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NilaiController extends Controller
{
    public function index()
    {
        $semua_nilai = Nilai::all();
        $title = 'Data Nilai';

        $tahun_ajaran_aktif = TahunAjaran::where('status', "Aktif")->first();

        // jika tidak ada tahun ajaran aktif
        if (!$tahun_ajaran_aktif) {
            $tahun_ajaran_aktif_semester = '';
            $tahun_ajaran_aktif_tahun = '';
        } else {
            $tahun_ajaran_aktif_semester = $tahun_ajaran_aktif->semester;
            $tahun_ajaran_aktif_tahun = $tahun_ajaran_aktif->tahun;
        }

        return view('backend.nilai.index', compact('semua_nilai', 'title', 'tahun_ajaran_aktif', 'tahun_ajaran_aktif_semester', 'tahun_ajaran_aktif_tahun'));
    }

    /**
     * This function is used to render the view for adding homework grades.
     * It fetches all the students and teachers based on the user's role.
     * It also fetches the list of subjects based on the user's role.
     * It sets the title of the page to 'Data Nilai Ulangan Harian'.
     * Finally, it renders the 'backend.nilai.tambah' view with the necessary data.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tambah_nilai_ulangan_harian()
    {
        // Fetch all the students
        $semua_siswa = User::where('id_role', '5')->get();

        if (Auth::user()->id_role === 3) {
            $semua_siswa = User::where('id_role', '5')->where('id_kelas', Auth::user()->id_kelas)->get();
        }

        // Check the user's role and fetch the corresponding teachers
        if (Auth::user()->id_role === 1) {
            // If the user is an admin, fetch all the teachers and lecturers
            $semua_guru = User::where('id_role', '3')->orWhere('id_role', '4')->orWhere('id_role', '2')->get();
        } else {
            $semua_guru = [];
        }

        // Check the user's role and fetch the list of subjects
        if (Auth::user()->id_role === 1) {
            // If the user is an admin or teacher, fetch all the subjects
            $semua_mapel = MataPelajaran::all();
        } else if (Auth::user()->id_role === 4) {
            // If the user is a lecturer, fetch the subject based on the user's subject ID
            $semua_mapel = MataPelajaran::where('id', Auth::user()->id_mapel)->first();
        } else if (Auth::user()->id_role === 3) {
            // If the user is a head of department, fetch all the subjects that the lecturers do not teach
            $semua_mapel = MataPelajaran::whereNotIn('id', User::where('id_role', '4')->pluck('id_mapel'))->get();
        }

        // Set the types of grades
        $semua_tipe_nilai = ['Ulangan Harian', 'Tugas', 'UTS', 'UAS', 'Rapor'];

        // Set the title of the page
        $title = 'Data Nilai Ulangan Harian';

        // Fetch all the classes
        $semua_kelas = Kelas::all();

        $semua_kompetensi_dasar = ['KD 1', 'KD 2', 'KD 3', 'KD 4', 'KD 5'];
        $semua_judul = ['PH 1', 'PH 2', 'PH 3'];

        // Render the 'backend.nilai.tambah' view with the necessary data
        return view('backend.nilai.tambah', compact('semua_siswa', 'semua_guru', 'semua_mapel', 'semua_tipe_nilai', 'title', 'semua_kelas', 'semua_kompetensi_dasar', 'semua_judul'));
    }

    // public function tambah_nilai_tugas($id)
    public function tambah_nilai_tugas()
    {
        // semua siswa
        $semua_siswa = User::where('id_role', '5')->get();

        if (Auth::user()->id_role === 3) {
            $semua_siswa = User::where('id_role', '5')->where('id_kelas', Auth::user()->id_kelas)->get();
        }

        if (Auth::user()->id_role === 1) {
            $semua_guru = User::where('id_role', '3')->orWhere('id_role', '4')->orWhere('id_role', '2')->get();
        } else {
            $semua_guru = [];
        }

        if (Auth::user()->id_role === 1) {
            $semua_mapel = MataPelajaran::all();
        } else if (Auth::user()->id_role === 4) {
            // cari nama mapel di tabel MataPelajaran berdasarkan id_mapel di tabel user
            $semua_mapel = MataPelajaran::where('id', Auth::user()->id_mapel)->first();
        } else if (Auth::user()->id_role === 3) {
            // cari semua mapel yang tidak diajar oleh id_role 4
            $semua_mapel = MataPelajaran::whereNotIn('id', User::where('id_role', '4')->pluck('id_mapel'))->get();
        }

        $semua_tipe_nilai = ['Ulangan Harian', 'Tugas', 'UTS', 'UAS', 'Rapor'];
        $title = 'Data Nilai Tugas';
        $semua_kelas = Kelas::all();

        return view('backend.nilai.tambah', compact('semua_siswa', 'semua_guru', 'semua_mapel', 'semua_tipe_nilai', 'title', 'semua_kelas'));
    }

    // public function tambah_nilai_uts($id)
    public function tambah_nilai_uts()
    {
        // semua siswa
        $semua_siswa = User::where('id_role', '5')->get();

        if (Auth::user()->id_role === 3) {
            $semua_siswa = User::where('id_role', '5')->where('id_kelas', Auth::user()->id_kelas)->get();
        }

        if (Auth::user()->id_role === 1) {
            $semua_guru = User::where('id_role', '3')->orWhere('id_role', '4')->orWhere('id_role', '2')->get();
        } else {
            $semua_guru = [];
        }

        if (Auth::user()->id_role === 1) {
            $semua_mapel = MataPelajaran::all();
        } else if (Auth::user()->id_role === 4) {
            // cari nama mapel di tabel MataPelajaran berdasarkan id_mapel di tabel user
            $semua_mapel = MataPelajaran::where('id', Auth::user()->id_mapel)->first();
        } else if (Auth::user()->id_role === 3) {
            // cari semua mapel yang tidak diajar oleh id_role 4
            $semua_mapel = MataPelajaran::whereNotIn('id', User::where('id_role', '4')->pluck('id_mapel'))->get();
        }

        $semua_tipe_nilai = ['Ulangan Harian', 'Tugas', 'UTS', 'UAS', 'Rapor'];
        $title = 'Data Nilai UTS';
        $semua_kelas = Kelas::all();

        return view('backend.nilai.tambah', compact('semua_siswa', 'semua_guru', 'semua_mapel', 'semua_tipe_nilai', 'title', 'semua_kelas'));
    }

    // public function tambah_nilai_uas($id)
    public function tambah_nilai_uas()
    {
        $semua_siswa = User::where('id_role', '5')->get();

        if (Auth::user()->id_role === 3) {
            $semua_siswa = User::where('id_role', '5')->where('id_kelas', Auth::user()->id_kelas)->get();
        }

        if (Auth::user()->id_role === 1) {
            $semua_guru = User::where('id_role', '3')->orWhere('id_role', '4')->orWhere('id_role', '2')->get();
        } else {
            $semua_guru = [];
        }

        if (Auth::user()->id_role === 1) {
            $semua_mapel = MataPelajaran::all();
        } else if (Auth::user()->id_role === 4) {
            // cari nama mapel di tabel MataPelajaran berdasarkan id_mapel di tabel user
            $semua_mapel = MataPelajaran::where('id', Auth::user()->id_mapel)->first();
        } else if (Auth::user()->id_role === 3) {
            // cari semua mapel yang tidak diajar oleh id_role 4
            $semua_mapel = MataPelajaran::whereNotIn('id', User::where('id_role', '4')->pluck('id_mapel'))->get();
        }

        $semua_tipe_nilai = ['Ulangan Harian', 'Tugas', 'UTS', 'UAS', 'Rapor'];
        $title = 'Data Nilai UAS';
        $semua_kelas = Kelas::all();

        return view('backend.nilai.tambah', compact('semua_siswa', 'semua_guru', 'semua_mapel', 'semua_tipe_nilai', 'title', 'semua_kelas'));
    }
    public function tambah_nilai_ujian()
    {
        // semua siswa
        $semua_siswa = User::where('id_role', '5')->get();

        if (Auth::user()->id_role === 3) {
            $semua_siswa = User::where('id_role', '5')->where('id_kelas', Auth::user()->id_kelas)->get();
        }

        if (Auth::user()->id_role === 1) {
            $semua_guru = User::where('id_role', '3')->orWhere('id_role', '4')->orWhere('id_role', '2')->get();
        } else {
            $semua_guru = [];
        }

        if (Auth::user()->id_role === 1) {
            $semua_mapel = MataPelajaran::all();
        } else if (Auth::user()->id_role === 4) {
            // cari nama mapel di tabel MataPelajaran berdasarkan id_mapel di tabel user
            $semua_mapel = MataPelajaran::where('id', Auth::user()->id_mapel)->first();
        } else if (Auth::user()->id_role === 3) {
            // cari semua mapel yang tidak diajar oleh id_role 4
            $semua_mapel = MataPelajaran::whereNotIn('id', User::where('id_role', '4')->pluck('id_mapel'))->get();
        }

        $semua_tipe_nilai = ['Ulangan Harian', 'Tugas', 'UTS', 'UAS', 'Rapor'];
        $title = 'Data Nilai Ujian';
        $semua_kelas = Kelas::all();

        $semua_judul = ['Tulis', 'Praktik'];

        return view('backend.nilai.tambah', compact('semua_siswa', 'semua_guru', 'semua_mapel', 'semua_tipe_nilai', 'title', 'semua_kelas', 'semua_judul'));
    }

    public function simpan(Request $request)
    {
        $validator = $this->validateRequest($request);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        $numberOfStudents = $this->countStudents($request->kelas);

        for ($i = 0; $i < $numberOfStudents; $i++) {
            if ($request->input('nilai' . $i + 1) > 100) {
                return response()->json([
                    'status' => 'error2',
                    'message' => 'Nilai tidak boleh lebih dari 100'
                ]);
            }
        }

        $activeAcademicYear = $this->findActiveAcademicYear();

        if (!$activeAcademicYear) {
            return response()->json([
                'status' => 'error2',
                'message' => 'Tahun Ajaran Aktif Tidak Ditemukan'
            ]);
        }

        $examTitleAlreadyExists = $this->checkExamTitleAlreadyExists($request, $activeAcademicYear);

        if ($examTitleAlreadyExists) {
            return response()->json([
                'status' => 'error3',
                'message' => 'Data nilai sudah ada'
            ]);
        }

        $this->saveExamScores($request, $numberOfStudents, $activeAcademicYear);

        return response()->json([
            'status' => 'success',
            'message' => 'Data Nilai Berhasil Ditambahkan'
        ]);
    }

    private function validateRequest(Request $request)
    {
        return Validator::make($request->all(), [
            'judul' => 'required',
            'guru' => 'required',
            'mapel' => 'required',
            'tipe_nilaii' => 'required',
            'kelas' => 'required',
        ]);
    }

    private function countStudents($kelas)
    {
        return User::where('id_role', '5')
            ->where('id_kelas', $kelas)
            ->count();
    }

    private function findActiveAcademicYear()
    {
        return TahunAjaran::where('status', 'Aktif')
            ->first();
    }

    private function checkExamTitleAlreadyExists($request, $activeAcademicYear)
    {
        if ($request->tipe_nilai = "Ulangan Harian") {
            return Nilai::where('id_kelas_for_nilai', $request->kelas)
                ->where('id_mapel_for_nilai', $request->mapel)
                ->where('tipe_nilai', $request->tipe_nilaii)
                ->where('judul', $request->judul)
                ->where('id_tahun_ajaran_for_nilai', $activeAcademicYear->id)
                ->where('kompetensi_dasar', $request->kompetensi_dasar)
                ->count();
        } else {
            return Nilai::where('id_kelas_for_nilai', $request->kelas)
                ->where('id_guru_for_nilai', $request->guru)
                ->where('id_mapel_for_nilai', $request->mapel)
                ->where('tipe_nilai', $request->tipe_nilaii)
                ->where('judul', $request->judul)
                ->where('id_tahun_ajaran_for_nilai', $activeAcademicYear->id)
                ->count();
        }
    }

    private function saveExamScores($request, $numberOfStudents, $activeAcademicYear)
    {
        $teacherId = $this->getTeacherId($request);

        for ($i = 0; $i < $numberOfStudents; $i++) {

            Nilai::create([
                'judul' => $request->judul,
                'id_kelas_for_nilai' => $request->kelas,
                'id_siswa_for_nilai' => $request->input('siswa' . $i + 1),
                'id_guru_for_nilai' => $teacherId,
                'id_mapel_for_nilai' => $request->mapel,
                'id_tahun_ajaran_for_nilai' => $activeAcademicYear->id,
                'tipe_nilai' => $request->tipe_nilaii,
                'nilai' => $request->input('nilai' . $i + 1),
                'kompetensi_dasar' => $request->kompetensi_dasar
            ]);
        }
    }

    private function getTeacherId($request)
    {
        if (Auth::user()->id_role === 1) {
            return $request->guru;
        } else {
            return Auth::user()->id;
        }
    }

    public function hapus($id)
    {
        $nilai = Nilai::find($id);

        // jika berhasil dihapus
        if ($nilai->delete()) {
            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data.']);
        }
    }

    public function edit($id)
    {
        $nilai = Nilai::find($id);
        $nama_siswa = User::where('id', $nilai->where('id', $id)->first()->id_siswa_for_nilai)->first()->name;

        $semua_guru = User::where('id_role', '3')->orWhere('id_role', '4')->orwhere('id_role', '2')->get();

        if (Auth::user()->id_role === 1 || Auth::user()->id_role === 2) {
            $semua_mapel = MataPelajaran::all();
        } else if (Auth::user()->id_role === 4) {
            // cari nama mapel di tabel MataPelajaran berdasarkan id_mapel di tabel user
            $semua_mapel = MataPelajaran::where('id', Auth::user()->id_mapel)->first();
        } else if (Auth::user()->id_role === 3) {
            // cari semua mapel yang tidak diajar oleh id_role 4
            $semua_mapel = MataPelajaran::whereNotIn('id', User::where('id_role', '4')->pluck('id_mapel'))->get();
        }

        $semua_tipe_nilai = ['Ulangan Harian', 'Tugas', 'UTS', 'UAS', 'Rapor'];
        $title = 'Data Nilai ' . $nilai->tipe_nilai . ' ' . Kelas::find($nilai->id_kelas_for_nilai)->nama;
        $id_kelas = $nilai->id_kelas_for_nilai;
        $judul = $nilai->judul;

        // semua kelas
        $semua_kelas = Kelas::all();

        $semua_kompetensi_dasar = ['KD 1', 'KD 2', 'KD 3', 'KD 4', 'KD 5'];
        $semua_judul = ['PH 1', 'PH 2', 'PH 3'];
        $semua_judul_ujian = ['Tulis', 'Praktik'];

        if ($nilai->tipe_nilai == 'Ulangan Harian') {
            $semua_siswa = Nilai::where('judul', $judul)->where('id_kelas_for_nilai', $nilai->id_kelas_for_nilai)
                ->where('id_guru_for_nilai', $nilai->id_guru_for_nilai)
                ->where('id_mapel_for_nilai', $nilai->id_mapel_for_nilai)
                ->where('tipe_nilai', $nilai->tipe_nilai)
                ->where('id_tahun_ajaran_for_nilai', $nilai->id_tahun_ajaran_for_nilai)
                ->where('kompetensi_dasar', $nilai->kompetensi_dasar)->get();
        } else {
            $semua_siswa = Nilai::where('judul', $judul)->where('id_kelas_for_nilai', $nilai->id_kelas_for_nilai)->where('id_guru_for_nilai', $nilai->id_guru_for_nilai)->where('id_mapel_for_nilai', $nilai->id_mapel_for_nilai)->where('tipe_nilai', $nilai->tipe_nilai)->where('id_tahun_ajaran_for_nilai', $nilai->id_tahun_ajaran_for_nilai)->get();
        }

        return view('backend.nilai.edit', compact('nilai', 'semua_siswa', 'semua_guru', 'semua_mapel', 'semua_tipe_nilai', 'title', 'id_kelas', 'judul', 'semua_kelas', 'semua_kompetensi_dasar', 'semua_judul', 'semua_judul_ujian', 'nama_siswa'));
    }

    /**
     * Update the data of a grade.
     *
     * @param Request $request The HTTP request object.
     * @param int $id The ID of the grade to update.
     * @return \Illuminate\Http\JsonResponse The JSON response containing the status and message.
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'judul' => 'required', // Judul (title) is required
            'guru' => 'required', // Guru (teacher) is required
            'mapel' => 'required', // Mapel (subject) is required
            'tipe_nilai' => 'required', // Tipe Nilai (grade type) is required
            'kelas' => 'required', // Kelas (class) is required
            'nilai' => 'required', // Nilai (grade) is required
        ]);

        // If validation fails, return an error response
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ]);
        }

        // Get the grade for the current student
        $grade = $request->nilai;

        // Check if the grade is greater than 100
        if ($grade > 100) {

            // If the grade is greater than 100, return an error response
            return response()->json([
                'status' => 'error2',
                'message' => 'Nilai tidak boleh lebih dari 100'
            ]);
        }

        // Check if a grade with the same title, class, teacher, subject, and type of grade already exists
        if ($request->tipe_nilai == 'Ulangan Harian') {

            $isTitleExists = Nilai::where('judul', $request->judul)
                ->where('id_kelas_for_nilai', $request->kelas)
                ->where('id_mapel_for_nilai', $request->mapel)
                ->where('tipe_nilai', $request->tipe_nilai)
                ->where('id_tahun_ajaran_for_nilai', $request->old_tahun_ajaran)
                ->where('kompetensi_dasar', $request->kompetensi_dasar)
                ->where('id_siswa_for_nilai', $request->siswa)
                ->where('id_guru_for_nilai', $request->guru)
                ->where('id', '!=', $request->id)
                ->count();
        } else {
            $isTitleExists = Nilai::where('judul', $request->judul)
                ->where('id_kelas_for_nilai', $request->kelas)
                ->where('id_guru_for_nilai', $request->guru)
                ->where('id_mapel_for_nilai', $request->mapel)
                ->where('tipe_nilai', $request->tipe_nilai)
                ->where('id_tahun_ajaran_for_nilai', $request->old_tahun_ajaran)
                ->where('id_siswa_for_nilai', $request->siswa)
                ->where('id', '!=', $request->id)
                ->count();
        }

        // If the title already exists, return an error response
        if ($isTitleExists > 0) {
            return response()->json([
                'status' => 'error2',
                'message' => 'Data nilai sudah ada'
            ]);
        } else {

            // Get the ID of the teacher based on the user's role
            if ($request->user()->id_role === 2 || $request->user()->id_role === 3 || $request->user()->id_role === 4) {
                $guruId = $request->user()->id;
            } elseif ($request->user()->id_role === 1) {
                $guruId = $request->guru;
            }

            // Create a new grade
            if ($request->tipe_nilai == 'Ulangan Harian') {
                $nilai = Nilai::find($request->id);
                $nilai->judul = $request->judul;
                $nilai->id_kelas_for_nilai = $request->kelas;
                $nilai->id_guru_for_nilai = $guruId;
                $nilai->id_mapel_for_nilai = $request->mapel;
                $nilai->id_tahun_ajaran_for_nilai = $request->old_tahun_ajaran;
                $nilai->tipe_nilai = $request->tipe_nilai;
                $nilai->kompetensi_dasar = $request->kompetensi_dasar;
                $nilai->nilai = $request->nilai;

                $nilai->save();
            } else {
                $nilai = Nilai::find($request->id);
                $nilai->judul = $request->judul;
                $nilai->id_kelas_for_nilai = $request->kelas;
                $nilai->id_guru_for_nilai = $guruId;
                $nilai->id_mapel_for_nilai = $request->mapel;
                $nilai->id_tahun_ajaran_for_nilai = $request->old_tahun_ajaran;
                $nilai->tipe_nilai = $request->tipe_nilai;
                $nilai->nilai = $request->nilai;

                $nilai->save();
            }

            // Return a success response
            return response()->json([
                'status' => 'success',
                'message' => 'Data Nilai Berhasil Diubah'
            ]);
        }
    }

    function filter(Request $request)
    {
        $nilai = Nilai::with('kelas', 'siswa', 'guru', 'mapel', 'tahun_ajaran');

        // filter berdasarkan tipe jadwal
        if ($request->tipe_nilai != null) {
            $nilai->where('tipe_nilai', $request->tipe_nilai);
        }

        // filter berdasarkan kelas
        // jika auth user id role tidak sama dengan 5 (siswa)
        if (Auth::user()->id_role != 5) {
            if ($request->kelas != null) {
                $nilai->where('id_kelas_for_nilai', $request->kelas);
            }
        } else {
            $nilai->where('id_kelas_for_nilai', Auth::user()->id_kelas);
        }

        // filter berdasarkan tahun ajaran
        if ($request->tahun_ajaran != null) {
            $nilai->where('id_tahun_ajaran_for_nilai', $request->tahun_ajaran);
        }

        // filter berdasarkan guru jika auth user id_role yang sedang login =2
        if (Auth::user()->id_role === 3 || Auth::user()->id_role === 4) {
            $nilai->where('id_guru_for_nilai', Auth::user()->id);
        } else if (Auth::user()->id_role === 5) {
            $nilai->where('id_siswa_for_nilai', Auth::user()->id);
        }

        $nilai = $nilai->get();

        return response()->json([
            'data' => $nilai
        ]);
    }

    public function getDataSiswa(Request $request)
    {
        $kelas = Nilai::with('kelas', 'siswa', 'guru', 'mapel');

        $kelas = Kelas::findOrFail($request->kelas);

        $daftar_siswa = User::where('id_role', 5)->where('id_kelas', $request->kelas)->get();
        $nilai_siswa = [];
        $id_nilai = [];
        foreach ($daftar_siswa as $siswa) {
            if ($request->tipe_nilaii == 'Ulangan Harian') {
                $nilai = Nilai::where('judul', $request->old_judul)
                    ->where('id_kelas_for_nilai', $request->kelas)
                    ->where('id_guru_for_nilai', $request->old_guru)
                    ->where('id_mapel_for_nilai', $request->old_mapel)
                    ->where('tipe_nilai', $request->tipe_nilaii)
                    ->where('id_siswa_for_nilai', $siswa->id)
                    ->where('id_tahun_ajaran_for_nilai', $request->old_tahun_ajaran)
                    ->where('kompetensi_dasar', $request->old_kompetensi_dasar)
                    ->pluck('nilai')->first() ?? '';
            } else {

                $nilai = Nilai::where('judul', $request->old_judul)
                    ->where('id_kelas_for_nilai', $request->kelas)
                    ->where('id_guru_for_nilai', $request->old_guru)
                    ->where('id_mapel_for_nilai', $request->old_mapel)
                    ->where('tipe_nilai', $request->tipe_nilaii)
                    ->where('id_siswa_for_nilai', $siswa->id)
                    ->where('id_tahun_ajaran_for_nilai', $request->old_tahun_ajaran)
                    ->pluck('nilai')->first() ?? '';
            }


            if ($request->tipe_nilaii == 'Ulangan Harian') {
                $id = Nilai::where('judul', $request->old_judul)
                    ->where('id_kelas_for_nilai', $request->kelas)
                    ->where('id_guru_for_nilai', $request->old_guru)
                    ->where('id_mapel_for_nilai', $request->old_mapel)
                    ->where('tipe_nilai', $request->tipe_nilaii)
                    ->where('id_siswa_for_nilai', $siswa->id)
                    ->where('id_tahun_ajaran_for_nilai', $request->old_tahun_ajaran)
                    ->where('kompetensi_dasar', $request->old_kompetensi_dasar)
                    ->pluck('id')->first() ?? '';
            } else {
                $id = Nilai::where('judul', $request->old_judul)
                    ->where('id_kelas_for_nilai', $request->kelas)
                    ->where('id_guru_for_nilai', $request->old_guru)
                    ->where('id_mapel_for_nilai', $request->old_mapel)
                    ->where('tipe_nilai', $request->tipe_nilaii)
                    ->where('id_siswa_for_nilai', $siswa->id)
                    ->where('id_tahun_ajaran_for_nilai', $request->old_tahun_ajaran)
                    ->pluck('id')->first() ?? '';
            }


            $nilai_siswa[] = $nilai;

            $id_nilai[] = $id;
        }
        return response()->json([
            'kelas' => $kelas->nama,
            'siswa' => $daftar_siswa,
            'nilai' => $nilai_siswa,
            'id_nilai' => $id_nilai
        ]);
    }
}
