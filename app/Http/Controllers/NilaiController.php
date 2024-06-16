<?php

namespace App\Http\Controllers;

use Whoops\Run;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class NilaiController extends Controller
{
    public function index()
    {
        $semua_nilai = Nilai::all();
        $title = 'Data Nilai';

        return view('backend.nilai.index', compact('semua_nilai', 'title'));
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
        } else if (Auth::user()->id_role === 2 || Auth::user()->id_role === 3 || Auth::user()->id_role === 4) {
            // If the user is a teacher or lecturer, fetch the user's data
            $semua_guru = User::where('id', Auth::user()->id)->get();
        }

        // Check the user's role and fetch the list of subjects
        if (Auth::user()->id_role === 1 || Auth::user()->id_role === 2) {
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

        // Render the 'backend.nilai.tambah' view with the necessary data
        return view('backend.nilai.tambah', compact('semua_siswa', 'semua_guru', 'semua_mapel', 'semua_tipe_nilai', 'title', 'semua_kelas'));
    }

    // public function tambah_nilai_tugas($id)
    public function tambah_nilai_tugas()
    {
        // $semua_siswa = User::where('id_role', '5')->where('id_kelas', $id)->get();
        // $semua_guru = User::where('id_role', '3')->orWhere('id_role', '4')->get();

        // semua siswa
        $semua_siswa = User::where('id_role', '5')->get();

        if (Auth::user()->id_role === 3) {
            $semua_siswa = User::where('id_role', '5')->where('id_kelas', Auth::user()->id_kelas)->get();
        }

        if (Auth::user()->id_role === 1) {
            $semua_guru = User::where('id_role', '3')->orWhere('id_role', '4')->orWhere('id_role', '2')->get();
        } else if (Auth::user()->id_role === 2 || Auth::user()->id_role === 3 || Auth::user()->id_role === 4) {
            $semua_guru = User::where('id', Auth::user()->id)->get();
        }

        // $semua_mapel = MataPelajaran::all();

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
        $title = 'Data Nilai Tugas';
        // $id_kelas = $id;
        // $nama_kelas = Kelas::find($id)->nama;
        // semua kelas
        $semua_kelas = Kelas::all();

        return view('backend.nilai.tambah', compact('semua_siswa', 'semua_guru', 'semua_mapel', 'semua_tipe_nilai', 'title', 'semua_kelas'));
    }

    // public function tambah_nilai_uts($id)
    public function tambah_nilai_uts()
    {
        // $semua_siswa = User::where('id_role', '5')->where('id_kelas', $id)->get();
        // $semua_guru = User::where('id_role', '3')->orWhere('id_role', '4')->get();

        // semua siswa
        $semua_siswa = User::where('id_role', '5')->get();

        if (Auth::user()->id_role === 3) {
            $semua_siswa = User::where('id_role', '5')->where('id_kelas', Auth::user()->id_kelas)->get();
        }

        if (Auth::user()->id_role === 1) {
            $semua_guru = User::where('id_role', '3')->orWhere('id_role', '4')->orWhere('id_role', '2')->get();
        } else if (Auth::user()->id_role === 2 || Auth::user()->id_role === 3 || Auth::user()->id_role === 4) {
            $semua_guru = User::where('id', Auth::user()->id)->get();
        }

        // $semua_mapel = MataPelajaran::all();

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
        $title = 'Data Nilai UTS';
        // $id_kelas = $id;
        // $nama_kelas = Kelas::find($id)->nama;
        // semua kelas
        $semua_kelas = Kelas::all();

        return view('backend.nilai.tambah', compact('semua_siswa', 'semua_guru', 'semua_mapel', 'semua_tipe_nilai', 'title', 'semua_kelas'));
    }

    // public function tambah_nilai_uas($id)
    public function tambah_nilai_uas()
    {
        // $semua_siswa = User::where('id_role', '5')->where('id_kelas', $id)->get();
        // $semua_guru = User::where('id_role', '3')->orWhere('id_role', '4')->get();

        // semua siswa
        $semua_siswa = User::where('id_role', '5')->get();

        if (Auth::user()->id_role === 3) {
            $semua_siswa = User::where('id_role', '5')->where('id_kelas', Auth::user()->id_kelas)->get();
        }

        if (Auth::user()->id_role === 1) {
            $semua_guru = User::where('id_role', '3')->orWhere('id_role', '4')->orWhere('id_role', '2')->get();
        } else if (Auth::user()->id_role === 2 || Auth::user()->id_role === 3 || Auth::user()->id_role === 4) {
            $semua_guru = User::where('id', Auth::user()->id)->get();
        }

        // $semua_mapel = MataPelajaran::all();

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
        $title = 'Data Nilai UAS';
        // $id_kelas = $id;
        // $nama_kelas = Kelas::find($id)->nama;

        // semua kelas
        $semua_kelas = Kelas::all();

        return view('backend.nilai.tambah', compact('semua_siswa', 'semua_guru', 'semua_mapel', 'semua_tipe_nilai', 'title', 'semua_kelas'));
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
            'tipe_nilai' => 'required',
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
        return Nilai::where('id_kelas_for_nilai', $request->kelas)
            ->where('id_guru_for_nilai', $request->guru)
            ->where('id_mapel_for_nilai', $request->mapel)
            ->where('tipe_nilai', $request->tipe_nilai)
            ->where('judul', $request->judul)
            ->where('id_tahun_ajaran_for_nilai', $activeAcademicYear->id)
            ->count();
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
                'tipe_nilai' => $request->tipe_nilai,
                'nilai' => $request->input('nilai' . $i + 1),
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
        // $semua_siswa = User::where('id_role', '5')->where('id_kelas', $nilai->id_kelas_for_nilai)->get();
        $semua_guru = User::where('id_role', '3')->orWhere('id_role', '4')->orwhere('id_role', '2')->get();
        // $semua_mapel = MataPelajaran::all();

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
        // get judul nilai
        $judul = $nilai->judul;

        // semua kelas
        $semua_kelas = Kelas::all();

        // get semua nilai siswa dengan judul, id_kelas_for_nilai, id_guru_for_nilai, id_mapel_for_nilai, dan tipe_nilai yang sama dengan old data dari nilai yang akan diedit
        $semua_siswa = Nilai::where('judul', $judul)->where('id_kelas_for_nilai', $nilai->id_kelas_for_nilai)->where('id_guru_for_nilai', $nilai->id_guru_for_nilai)->where('id_mapel_for_nilai', $nilai->id_mapel_for_nilai)->where('tipe_nilai', $nilai->tipe_nilai)->where('id_tahun_ajaran_for_nilai', $nilai->id_tahun_ajaran_for_nilai)->get();

        return view('backend.nilai.edit', compact('nilai', 'semua_siswa', 'semua_guru', 'semua_mapel', 'semua_tipe_nilai', 'title', 'id_kelas', 'judul', 'semua_kelas'));
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
        ]);

        // If validation fails, return an error response
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ]);
        }

        // Get the class name from the request
        $className = $request->kelas;

        // Get the count of all students in the class
        $allStudentsCount = User::where('id_role', 5)
            ->where('id_kelas', $className)
            ->count();

        // Create an array to store all student IDs
        $allStudentIds = [];

        // Loop through all students and add their IDs to the array
        for ($i = 0; $i < $allStudentsCount; $i++) {
            $allStudentIds[] = $request->input('id_nilai' . ($i + 1));
        }

        // Get the active year from the database
        $activeYear = TahunAjaran::where('status', 'Aktif')->first();

        // Get the number of students in the class
        $numberOfStudents = $this->countStudents($request->kelas);

        // Loop through all the students and check their grades
        for ($i = 0; $i < $numberOfStudents; $i++) {

            // Get the grade for the current student
            $grade = $request->input('nilai' . ($i + 1));

            // Check if the grade is greater than 100
            if ($grade > 100) {

                // If the grade is greater than 100, return an error response
                return response()->json([
                    'status' => 'error2',
                    'message' => 'Nilai tidak boleh lebih dari 100'
                ]);
            }
        }

        // Check if a grade with the same title, class, teacher, subject, and type of grade already exists
        $isTitleExists = Nilai::where('judul', $request->judul)
            ->where('id_kelas_for_nilai', $className)
            ->where('id_guru_for_nilai', $request->guru)
            ->where('id_mapel_for_nilai', $request->mapel)
            ->where('tipe_nilai', $request->tipe_nilai)
            ->where('id_tahun_ajaran_for_nilai', $request->old_tahun_ajaran)
            ->whereNotIn('id', $allStudentIds)
            ->count();

        // If the title already exists, return an error response
        if ($isTitleExists > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data nilai sudah ada'
            ]);
        } else {
            // Delete all grades with the same title, class, teacher, subject, and type of grade
            Nilai::where('judul', $request->old_judul)
                ->where('id_kelas_for_nilai', $className)
                ->where('id_guru_for_nilai', $request->old_guru)
                ->where('id_mapel_for_nilai', $request->old_mapel)
                ->where('tipe_nilai', $request->tipe_nilai)
                ->where('id_tahun_ajaran_for_nilai', $request->old_tahun_ajaran)
                ->delete();

            // Loop through all students and create new grades for them
            for ($i = 0; $i < $allStudentsCount; $i++) {
                $studentId = $request->input('siswa' . ($i + 1));

                // Get the ID of the teacher based on the user's role
                if ($request->user()->id_role === 2 || $request->user()->id_role === 3 || $request->user()->id_role === 4) {
                    $guruId = $request->user()->id;
                } elseif ($request->user()->id_role === 1) {
                    $guruId = $request->guru;
                }

                // Create a new grade
                Nilai::create([
                    'judul' => $request->judul,
                    'id_kelas_for_nilai' => $className,
                    'id_siswa_for_nilai' => $studentId,
                    'id_guru_for_nilai' => $guruId,
                    'id_mapel_for_nilai' => $request->mapel,
                    'id_tahun_ajaran_for_nilai' => $request->old_tahun_ajaran,
                    'tipe_nilai' => $request->tipe_nilai,
                    'nilai' => $request->input('nilai' . ($i + 1)),
                ]);
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
        $nilai = Nilai::with('kelas', 'siswa', 'guru', 'mapel');

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
        if (Auth::user()->id_role === 2) {
            if ($request->guru != null) {
                $nilai->where('id_guru_for_nilai', $request->guru);
            }
        } else if (Auth::user()->id_role === 3 || Auth::user()->id_role === 4) {
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

        // $kelas = Kelas::findOrFail($id);
        // get id_kelas_for_nilai dari nilai yang akan diedit
        $kelas = Nilai::with('kelas', 'siswa', 'guru', 'mapel');
        // $id_kelas = $kelas->where('id', $request->id)->pluck('id_kelas_for_nilai')->first();

        $kelas = Kelas::findOrFail($request->kelas);

        // get nama kelas dari nilai yang akan diedit
        // $kelas = Kelas::where('id', $id_kelas)->pluck('nama')->first();

        $daftar_siswa = User::where('id_role', 5)->where('id_kelas', $request->kelas)->get();
        $nilai_siswa = [];
        $id_nilai = [];
        foreach ($daftar_siswa as $siswa) {


            // $nilai = Nilai::where('id_siswa_for_nilai', $siswa->id)->pluck('nilai')->first() ?? '';

            // get nilai siswa berdasarkan old_judul, old_kelas, old_guru, old_mapel, dan tipe_nilai
            $nilai = Nilai::where('judul', $request->old_judul)->where('id_kelas_for_nilai', $request->kelas)->where('id_guru_for_nilai', $request->old_guru)->where('id_mapel_for_nilai', $request->old_mapel)->where('tipe_nilai', $request->tipe_nilaii)->where('id_siswa_for_nilai', $siswa->id)->where('id_tahun_ajaran_for_nilai', $request->old_tahun_ajaran)->pluck('nilai')->first() ?? '';

            // $semua_siswa = Nilai::where('judul', $judul)->where('id_kelas_for_nilai', $nilai->id_kelas_for_nilai)->where('id_guru_for_nilai', $nilai->id_guru_for_nilai)->where('id_mapel_for_nilai', $nilai->id_mapel_for_nilai)->where('tipe_nilai', $nilai->tipe_nilai)->get();

            $id = Nilai::where('judul', $request->old_judul)->where('id_kelas_for_nilai', $request->kelas)->where('id_guru_for_nilai', $request->old_guru)->where('id_mapel_for_nilai', $request->old_mapel)->where('tipe_nilai', $request->tipe_nilaii)->where('id_siswa_for_nilai', $siswa->id)->where('id_tahun_ajaran_for_nilai', $request->old_tahun_ajaran)->pluck('id')->first() ?? '';

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
