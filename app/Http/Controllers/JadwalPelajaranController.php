<?php

namespace App\Http\Controllers;

use PDF;
use Dompdf\Dompdf;
use App\Models\Guru;
use App\Models\User;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use App\Models\JamPelajaran;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Models\ProfilSekolah;
use App\Models\Ekstrakurikuler;
use App\Models\Jabatan;
use App\Models\JadwalPelajaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class JadwalPelajaranController extends Controller
{
    public function index_all_jadwal()
    {
        // jadwal pelajaran berdasarkan id kelas

        if (Auth::user()->id_role === 1 || Auth::user()->id_role === 2) {
            $jadwal_pelajaran = JadwalPelajaran::all();
        } else if (Auth::user()->id_role === 3 || Auth::user()->id_role === 4) {
            $jadwal_pelajaran = JadwalPelajaran::where('id_guru_for_jadwal', Auth::user()->id)->get();
        } else if (Auth::user()->id_role === 5) {
            $jadwal_pelajaran = JadwalPelajaran::where('id_kelas_for_jadwal', Auth::user()->id_kelas)->get();
        }

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

        // $jadwal_pelajaran = JadwalPelajaran::all();
        $title = 'Data Jadwal';

        $id_kelas = '';

        return view('backend.jadwal_pelajaran.index', compact('jadwal_pelajaran', 'title', 'id_kelas', 'tahun_ajaran_aktif', 'tahun_ajaran_aktif_semester', 'tahun_ajaran_aktif_tahun'));
    }
    // public function jadwal_pelajaran_tambah($id)
    public function jadwal_pelajaran_tambah()
    {
        // $semua_kelas = Kelas::all();
        $semua_mapel = MataPelajaran::all();
        $semua_guru = User::where('id_role', 3)->orWhere('id_role', 4)->orWhere('id_role', 2)->get();
        $semua_hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $semua_ekstra = Ekstrakurikuler::all();
        // $title = 'Data Jadwal Pelajaran ' . Kelas::find($id)->nama;
        $title = 'Data Jadwal Pelajaran';
        // semua kelas
        $semua_kelas = Kelas::all();

        // semua jam pelajaran kecuali jam pelajaran dengan tipe jam Istirahat
        $semua_jam_pelajaran = JamPelajaran::where('tipe_jam', '!=', 'Istirahat')->orderBy('jam_ke', 'asc')->get();

        // get id kelas
        // $id_kelas = Kelas::find($id);

        return view('backend.jadwal_pelajaran.tambah', compact('semua_mapel', 'semua_guru', 'semua_hari', 'semua_ekstra', 'title', 'semua_jam_pelajaran', 'semua_kelas'));
    }

    public function jadwal_simpan(Request $request)
    {
        // validator
        $validator = Validator::make($request->all(), [
            'kelas' => 'required',
            'hari' => 'required',
            'jam_ke' => 'required',
            'guru' => 'required',
        ]);

        // jika validator gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }


        $jadwal_pelajaran = new JadwalPelajaran;
        $jadwal_pelajaran->hari = $request->hari;
        $jadwal_pelajaran->id_kelas_for_jadwal = $request->kelas;
        $jadwal_pelajaran->id_mapel_for_jadwal = $request->mapel;
        $jadwal_pelajaran->id_ekstra_for_jadwal = $request->ekstra;
        $jadwal_pelajaran->id_guru_for_jadwal = $request->guru;
        $jadwal_pelajaran->id_jam_for_jadwal = $request->jam_ke;
        // get tahun ajaran dengan status aktif
        $tahun_ajaran = TahunAjaran::where('status', 'Aktif')->first();

        // cek jika $tahun_ajaran tidak ada
        if (!$tahun_ajaran) {
            return response()->json([
                'status' => 'error2',
                'message' => 'Tahun Ajaran Aktif tidak ditemukan'
            ]);
        }

        $jadwal_pelajaran->id_tahun_ajaran_for_jadwal = $tahun_ajaran->id;
        $jadwal_pelajaran->tipe_jadwal = $request->tipe_jadwal;

        $cek_jadwal = JadwalPelajaran::where('hari', $request->hari)
            ->where('id_guru_for_jadwal', $request->guru)
            ->where('id_jam_for_jadwal', $request->jam_ke)
            ->where('id_kelas_for_jadwal', $request->kelas)
            ->where('id_tahun_ajaran_for_jadwal', $tahun_ajaran->id)
            ->first();

        $cek_jadwal_1_2 = JadwalPelajaran::where('hari', $request->hari)
            ->where('id_guru_for_jadwal', $request->guru)
            ->where('id_jam_for_jadwal', $request->jam_ke)
            ->where('id_tahun_ajaran_for_jadwal', $tahun_ajaran->id)
            ->first();

        $cek_jadwal_1_3 = JadwalPelajaran::where('hari', $request->hari)
            ->where('id_jam_for_jadwal', $request->jam_ke)
            ->where('id_kelas_for_jadwal', $request->kelas)
            ->where('id_tahun_ajaran_for_jadwal', $tahun_ajaran->id)
            ->first();

        if ($cek_jadwal || $cek_jadwal_1_2 || $cek_jadwal_1_3) {

            return response()->json([
                'status' => 'error2',
                'message' => 'Jadwal sudah ada/bentrok'
            ]);
        }



        // jika berhasil disimpan
        if ($jadwal_pelajaran->save()) {
            return response()->json(['status' => 'success', 'message' => 'Data berhasil disimpan.']);
        } else {
            return response()->json(['status' => 'error3', 'message' => 'Gagal menyimpan data.']);
        }
    }

    // public function jadwal_ekstra_tambah($id)
    public function jadwal_ekstra_tambah()
    {
        $semua_mapel = MataPelajaran::all();
        $semua_guru = User::where('id_role', 3)->orWhere('id_role', 4)->orWhere('id_role', 2)->get();
        $semua_hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $semua_ekstra = Ekstrakurikuler::all();
        $title = 'Data Jadwal Ekstrakurikuler';
        // semua kelas
        $semua_kelas = Kelas::all();

        // semua jam pelajaran kecuali jam pelajaran dengan tipe jam Istirahat
        $semua_jam_pelajaran = JamPelajaran::where('tipe_jam', '!=', 'Istirahat')->orderBy('jam_ke', 'asc')->get();


        return view('backend.jadwal_pelajaran.tambah', compact('semua_mapel', 'semua_guru', 'semua_hari', 'semua_ekstra', 'title', 'semua_jam_pelajaran', 'semua_kelas'));
    }

    public function jadwal_hapus($id)
    {
        $jadwal_pelajaran = JadwalPelajaran::find($id);

        if ($jadwal_pelajaran->delete()) {
            return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus.']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data.']);
        }
    }

    public function jadwal_edit($id)
    {
        $jadwal = JadwalPelajaran::find($id);

        $kelas = Kelas::find($jadwal->id_kelas_for_jadwal);

        $title = 'Data Jadwal ' . $jadwal->tipe_jadwal . ' ' . $kelas->nama;

        $semua_hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        $semua_guru = Guru::all();

        $semua_mapel = MataPelajaran::all();

        $semua_guru = User::where('id_role', 3)->orWhere('id_role', 4)->orWhere('id_role', 2)->get();

        $semua_ekstra = Ekstrakurikuler::all();

        $semua_jam_pelajaran = JamPelajaran::where('tipe_jam', '!=', 'Istirahat')->orderBy('jam_ke', 'asc')->get();

        $semua_kelas = Kelas::all();

        return view('backend.jadwal_pelajaran.edit', compact('jadwal', 'title', 'kelas', 'semua_hari', 'semua_guru', 'semua_mapel', 'semua_guru', 'semua_ekstra', 'semua_jam_pelajaran', 'semua_kelas'));
    }

    public function jadwal_update(Request $request, $id)
    {

        // validator
        $validator = Validator::make($request->all(), [
            'kelas' => 'required',
            'hari' => 'required',
            'jam_ke' => 'required',
            'guru' => 'required',
        ]);

        // jika validator gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->toArray()
            ]);
        }

        $jadwal_pelajaran = JadwalPelajaran::find($id);
        $jadwal_pelajaran->hari = $request->hari;
        $jadwal_pelajaran->id_mapel_for_jadwal = $request->mapel;
        $jadwal_pelajaran->id_ekstra_for_jadwal = $request->ekstra;
        $jadwal_pelajaran->id_guru_for_jadwal = $request->guru;
        $jadwal_pelajaran->id_jam_for_jadwal = $request->jam_ke;
        // get tahun ajaran dengan status Aktif
        // $tahun_ajaran = TahunAjaran::where('status', 'Aktif')->first();
        // $jadwal_pelajaran->id_tahun_ajaran_for_jadwal = $tahun_ajaran->id;

        $cek_jadwal = JadwalPelajaran::where('hari', $request->hari)
            ->where('id_guru_for_jadwal', $request->guru)
            ->where('id_jam_for_jadwal', $request->jam_ke)
            ->where('id_kelas_for_jadwal', $jadwal_pelajaran->id_kelas_for_jadwal)
            ->where('id_tahun_ajaran_for_jadwal', $jadwal_pelajaran->id_tahun_ajaran_for_jadwal)
            ->where('id', '!=', $id)
            ->first();

        $cek_jadwal_1_2 = JadwalPelajaran::where('hari', $request->hari)
            ->where('id_guru_for_jadwal', $request->guru)
            ->where('id_jam_for_jadwal', $request->jam_ke)
            ->where('id_tahun_ajaran_for_jadwal', $jadwal_pelajaran->id_tahun_ajaran_for_jadwal)
            ->where('id', '!=', $id)
            ->first();

        $cek_jadwal_1_3 = JadwalPelajaran::where('hari', $request->hari)
            ->where('id_jam_for_jadwal', $request->jam_ke)
            ->where('id_kelas_for_jadwal', $jadwal_pelajaran->id_kelas_for_jadwal)
            ->where('id_tahun_ajaran_for_jadwal', $jadwal_pelajaran->id_tahun_ajaran_for_jadwal)
            ->where('id', '!=', $id)
            ->first();

        if (($cek_jadwal)
            || ($cek_jadwal_1_2)
            || ($cek_jadwal_1_3)
        ) {

            return response()->json([
                'status' => 'error2',
                'message' => 'Jadwal sudah ada/bentrok'
            ]);
        }


        // jika berhasil diubah
        if ($jadwal_pelajaran->save()) {
            return response()->json(['status' => 'success', 'message' => 'Data berhasil diubah.']);
        } else {
            return response()->json(['status' => 'error3', 'message' => 'Gagal menyimpan data.']);
        }
    }

    // filter_jadwal
    function filter_jadwal(Request $request)
    {
        $jadwal = JadwalPelajaran::with('kelas', 'mapel', 'ekstra', 'user', 'jam', 'tahun_ajaran');

        // filter berdasarkan tipe jadwal
        if ($request->tipe_jadwal != null) {
            $jadwal->where('tipe_jadwal', $request->tipe_jadwal);
        }

        // filter berdasarkan kelas
        // jika auth id role tidak sama dengan 5
        if (Auth::user()->id_role != 5) {
            if ($request->kelas != null) {
                $jadwal->where('id_kelas_for_jadwal', $request->kelas);
            }
        } else {
            $jadwal->where('id_kelas_for_jadwal', Auth::user()->id_kelas);
        }

        // filter berdasarkan tahun ajaran
        if ($request->tahun_ajaran != null) {
            $jadwal->where('id_tahun_ajaran_for_jadwal', $request->tahun_ajaran);
        }

        // filter berdasarkan kepemilikian jadwal
        if (Auth::user()->id_role === 3 || Auth::user()->id_role === 4) {
            $jadwal->where('id_guru_for_jadwal', Auth::user()->id);
        } else if (Auth::user()->id_role === 5) {
            $jadwal->where('id_kelas_for_jadwal', Auth::user()->id_kelas);
        }

        $jadwal = $jadwal->get();

        return response()->json([
            'data' => $jadwal
        ]);
    }

    public function getHariIndex($hari)
    {
        $days = [
            'Sabtu' => 1,
            'Minggu' => 2,
            'Senin' => 3,
            'Selasa' => 4,
            'Rabu' => 5,
            'Kamis' => 6,
            'Jumat' => 7,
        ];

        return $days[$hari] ?? 8; // Jika hari tidak ditemukan, berikan nilai yang besar untuk mengurutkan di akhir
    }

    public function checkJumlahJadwal(Request $request)
    {
        $query = JadwalPelajaran::with('kelas', 'mapel', 'ekstra', 'user', 'jam');

        // tahun ajaran aktif
        $tahun_ajaran = TahunAjaran::where('status', "Aktif")->first();
        if (!$tahun_ajaran) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tidak ada tahun ajaran aktif!'
            ]);
        };

        if ($request->tipe_jadwal != null) {
            $query->where('tipe_jadwal', $request->tipe_jadwal);
        }

        if (auth()->user()->id_role != 5) {
            if ($request->kelas != null) {
                $query->where('id_kelas_for_jadwal', $request->kelas);
            } else {
                // Handle the case where no specific class is selected
            }
        } else {
            $query->where('id_kelas_for_jadwal', auth()->user()->id_kelas);
        }

        if ($request->tahun_ajaran != null) {
            $query->where('id_tahun_ajaran_for_jadwal', $request->tahun_ajaran);
        } else {
            $tahun_ajaran = TahunAjaran::where('status', "Aktif")->first();
            $query->where('id_tahun_ajaran_for_jadwal', $tahun_ajaran->id);
        }

        if (auth()->user()->id_role === 1 || auth()->user()->id_role === 2) {
            if ($request->kepemilikan_jadwal != null) {
                $query->where('id_guru_for_jadwal', $request->kepemilikan_jadwal);
            }
        } else if (auth()->user()->id_role === 3) {
            $query->where('id_guru_for_jadwal', auth()->user()->id);
        } else if (auth()->user()->id_role === 4) {
            $query->where('id_guru_for_jadwal', auth()->user()->id);
        }

        $jumlahJadwal = $query->count();

        if ($jumlahJadwal == 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tidak ada jadwal!'
            ]);
        }



        return response()->json([
            'status' => 'success',
            'jumlah_jadwal' => $jumlahJadwal
        ]);
    }

    public function cetak_jadwal(Request $request)
    {
        $semua_jadwal = JadwalPelajaran::with('kelas', 'mapel', 'ekstra', 'user', 'jam');

        if ($request->tipe_jadwal != null) {
            $semua_jadwal->where('tipe_jadwal', $request->tipe_jadwal);
            $tipe_jadwal = $request->tipe_jadwal;
        } else {
            $tipe_jadwal = 'Data Semua Jadwal';
        }

        // jika auth id role user tidak sama dengan 5
        if (auth()->user()->id_role != 5) {
            if ($request->kelas != null) {
                $kelas = Kelas::find($request->kelas)->nama;
                $semua_jadwal->where('id_kelas_for_jadwal', $request->kelas);
            } else {
                $kelas = 'Semua Kelas';
            }
        } else {
            $kelas = Kelas::find(auth()->user()->id_kelas)->nama;
            $semua_jadwal->where('id_kelas_for_jadwal', auth()->user()->id_kelas);
        }

        if ($request->tahun_ajaran != null) {
            $tahun_ajaran = TahunAjaran::find($request->tahun_ajaran);
            $semua_jadwal->where('id_tahun_ajaran_for_jadwal', $request->tahun_ajaran);
        } else {
            $tahun_ajaran = TahunAjaran::where('status', "Aktif")->first();
        }

        // kepemilikian jadwal
        if (auth()->user()->id_role === 1 || auth()->user()->id_role === 2) {
            if ($request->kepemilikan_jadwal != null) {
                $kepemilikan_jadwal = User::find($request->kepemilikan_jadwal)->id_role;
                // get nama id role
                $kepemilikan_jadwal = Jabatan::find($kepemilikan_jadwal)->nama;
                $semua_jadwal->where('id_guru_for_jadwal', $request->kepemilikan_jadwal);
            } else {
                $kepemilikan_jadwal = '';
            }
        } else if (auth()->user()->id_role === 3) {
            $kepemilikan_jadwal = User::find(auth()->user()->id)->id_role;
            $kelas_untuk_id_role_3 = Kelas::find(auth()->user()->id_kelas)->nama;
            // get nama id role
            $kepemilikan_jadwal = Jabatan::find($kepemilikan_jadwal)->nama . ' ' . $kelas_untuk_id_role_3;

            $semua_jadwal->where('id_guru_for_jadwal', auth()->user()->id);
        } else if (auth()->user()->id_role === 4) {
            $kepemilikan_jadwal = User::find(auth()->user()->id)->id_role;
            // get nama id role
            $kepemilikan_jadwal = Jabatan::find($kepemilikan_jadwal)->nama;

            // get id_mapel dari tabel user
            $mapel = User::find(auth()->user()->id)->id_mapel;

            $kepemilikan_jadwal = $kepemilikan_jadwal . ' ' . MataPelajaran::find($mapel)->mata_pelajaran;

            $semua_jadwal->where('id_guru_for_jadwal', auth()->user()->id);
        } else if (auth()->user()->id_role === 5) {
            $kepemilikan_jadwal = User::find(auth()->user()->id)->id_role;
            $kelas_untuk_id_role_5 = Kelas::find(auth()->user()->id_kelas)->nama;
            // get nama id role
            $kepemilikan_jadwal = Jabatan::find($kepemilikan_jadwal)->nama . ' ' . $kelas_untuk_id_role_5;
        }

        $semua_jadwal->where('id_tahun_ajaran_for_jadwal', $tahun_ajaran->id);

        $semua_jadwal = $semua_jadwal->get();

        $semua_jadwal = $semua_jadwal->map(function ($jadwal) {
            $jadwal->hari_index = $this->getHariIndex($jadwal->hari); // Asumsikan ada kolom 'hari' di jadwal
            return $jadwal;
        });

        $semua_jadwal = $semua_jadwal->sortBy([
            ['id_kelas_for_jadwal', 'asc'],
            ['hari_index', 'asc'],
            ['id_jam_for_jadwal', 'asc']
        ]);


        // $tahun_ajaran = TahunAjaran::where('status', "Aktif")->first();
        $sekolah = ProfilSekolah::first();
        $logo = public_path($sekolah->logo);



        $tahun = explode('/', $tahun_ajaran->tahun);
        // jika auth id role user tidak sama dengan 5
        if (auth()->user()->id_role != 5) {
            if ($request->tipe_jadwal != null && $kepemilikan_jadwal != null) {
                $nama_file = 'Cetak Data Semua Jadwal ' . $tipe_jadwal . ' ' . $kepemilikan_jadwal . ' | ' . $kelas . ' | ' . 'Semester' . ' ' . $tahun_ajaran->semester . ' ' . $tahun[0] . '-' . $tahun[1] . '.pdf';
            } else if ($request->tipe_jadwal != null && $kepemilikan_jadwal == null) {
                $nama_file = 'Cetak Data Semua Jadwal ' . $tipe_jadwal . ' | ' . $kelas . ' | ' . 'Semester' . ' ' . $tahun_ajaran->semester . ' ' . $tahun[0] . '-' . $tahun[1] . '.pdf';
            } else if ($request->tipe_jadwal == null && $kepemilikan_jadwal != null) {
                $nama_file = 'Cetak Data Semua Jadwal ' . $kepemilikan_jadwal . ' | ' . $kelas . ' | ' . 'Semester' . ' ' . $tahun_ajaran->semester . ' ' . $tahun[0] . '-' . $tahun[1] . '.pdf';
            } else {
                $nama_file = 'Cetak Data Semua Jadwal | ' . $kelas . ' | ' . 'Semester' . ' ' . $tahun_ajaran->semester . ' ' . $tahun[0] . '-' . $tahun[1] . '.pdf';
            }
        } else {
            if ($request->tipe_jadwal != null && $kepemilikan_jadwal != null) {
                $nama_file = 'Cetak Data Semua Jadwal ' . $tipe_jadwal . ' ' . $kepemilikan_jadwal . ' | ' . 'Semester' . ' ' . $tahun_ajaran->semester . ' ' . $tahun[0] . '-' . $tahun[1] . '.pdf';
            } else if ($request->tipe_jadwal != null && $kepemilikan_jadwal == null) {
                $nama_file = 'Cetak Data Semua Jadwal ' . $tipe_jadwal . ' | ' . 'Semester' . ' ' . $tahun_ajaran->semester . ' ' . $tahun[0] . '-' . $tahun[1] . '.pdf';
            } else if ($request->tipe_jadwal == null && $kepemilikan_jadwal != null) {
                $nama_file = 'Cetak Data Semua Jadwal ' . $kepemilikan_jadwal . ' | ' . 'Semester' . ' ' . $tahun_ajaran->semester . ' ' . $tahun[0] . '-' . $tahun[1] . '.pdf';
            } else {
                $nama_file = 'Cetak Data Semua Jadwal | ' . 'Semester' . ' ' . $tahun_ajaran->semester . ' ' . $tahun[0] . '-' . $tahun[1] . '.pdf';
            }
        }

        $dompdf = new Dompdf();

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->loadHtml(view('backend.jadwal_pelajaran.cetak_all', compact('semua_jadwal', 'tahun_ajaran', 'logo', 'sekolah', 'nama_file', 'kelas', 'tipe_jadwal', 'kepemilikan_jadwal')));

        $dompdf->render();

        $dompdf->stream($nama_file, ['Attachment' => 0]);
    }
}
