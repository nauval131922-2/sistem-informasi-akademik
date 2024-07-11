<?php
// import
use App\Models\Nilai;
use App\Models\TahunAjaran;

$nilai = Nilai::where('id_siswa_for_nilai', $id_siswa);
$nilai_header = Nilai::where('id_siswa_for_nilai', $id_siswa);
$tahun_ajaran = TahunAjaran::where('status', 'aktif')->first();
$tahun_ajaran_all = TahunAjaran::all();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $nama_file }}</title>
    <style>
        #rapor,
        #rapor th,
        #rapor td,
        #ijazah,
        #ijazah th,
        #ijazah td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center">Data Profil Siswa</h1>
    <table>
        <tr>
            <td width="20%" rowspan="5">
                {{-- foto --}}
                @if (!empty($foto))
                    <img src="{{ asset($foto) }}" width="100">
                @endif
            </td>
        </tr>
        <tr>
            <td width="20%">Nama Lengkap</td>
            <td widh="5%">:</td>
            <td width="65%">{{ $nama_lengkap }}</td>
        </tr>
        <tr>
            <td width="20%">NISN</td>
            <td widh="5%">:</td>
            <td width="65%">{{ $nisn }}</td>
        </tr>
        <tr>
            <td width="20%">NIS Lokal</td>
            <td widh="5%">:</td>
            <td width="65%">{{ $nis_lokal }}</td>
        </tr>
        <tr>
            <td width="20%">NIK</td>
            <td widh="5%">:</td>
            <td width="65%">{{ $nik }}</td>
        </tr>


    </table>
    <br>
    <table>
        <tr>
            <td width="20%">Jenis Kelamin</td>
            <td widh="5%">:</td>
            <td width="25%">{{ $jenis_kelamin }}</td>

            <td width="10%" rowspan="6"></td>

            <td width="25%">Jumlah Saudara</td>
            <td widh="5%">:</td>
            <td width="25%">{{ $jumlah_saudara }}</td>
        </tr>
        <tr>
            <td>Tempat Lahir</td>
            <td>:</td>
            <td>{{ $tempat_lahir }}</td>

            <td>Cita-cita</td>
            <td>:</td>
            <td>{{ $cita_cita }}</td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td>{{ $tanggal_lahir }}</td>

            <td>Hobi</td>
            <td>:</td>
            <td>{{ $hobi }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $alamat }}</td>

            <td>Jarak Rumah-Madrasah</td>
            <td>:</td>
            <td>{{ $jarak_rumah }}</td>
        </tr>
        <tr>
            <td>No. HP</td>
            <td>:</td>
            <td>{{ $nomor_hp }}</td>

            <td>No. KK</td>
            <td>:</td>
            <td>{{ $nomor_kk }}</td>
        </tr>
        <tr>
            <td>Tanggal Masuk</td>
            <td>:</td>
            <td>{{ $tanggal_masuk }}</td>

            <td>No. KIP</td>
            <td>:</td>
            <td>{{ $nomor_kip }}</td>
        </tr>
        <tr>
            <td>Diterima di kelas</td>
            <td>:</td>
            <td>{{ $diterima_di_kelas }}</td>

        </tr>

    </table>
    <br>
    <table>
        <tr>
            <td style="font-weight: bold" colspan="3">PRA SEKOLAH</td>

            <td width="10%" rowspan="6"></td>

            <td style="font-weight: bold" colspan="3">MUTASI/KELULUSAN</td>
        </tr>
        <tr>
            <td width="20%">Jenjang sebelumnya</td>
            <td widh="5%">:</td>
            <td width="25%">{{ $jenjang_sebelumnya }}</td>

            <td width="25%">Jenis Mutasi</td>
            <td widh="5%">:</td>
            <td width="25%">{{ $jenis_mutasi }}</td>
        </tr>
        <tr>
            <td>Nama Sekolah</td>
            <td>:</td>
            <td>{{ $sekolah_pra }}</td>

            <td>Nama Sekolah</td>
            <td>:</td>
            <td>{{ $sekolah_mutasi }}</td>
        </tr>
        <tr>
            <td>NPSN</td>
            <td>:</td>
            <td>{{ $npsn_pra }}</td>

            <td>NPSN</td>
            <td>:</td>
            <td>{{ $npsn_mutasi }}</td>
        </tr>
        <tr>
            <td>NISM</td>
            <td>:</td>
            <td>{{ $nism_pra }}</td>

            <td>NISM</td>
            <td>:</td>
            <td>{{ $nism_mutasi }}</td>
        </tr>
        <tr>
            <td>No. Ijazah</td>
            <td>:</td>
            <td>{{ $nomor_ijazah }}</td>

            <td>Tanggal Mutasi</td>
            <td>:</td>
            <td>{{ $tanggal_mutasi }}</td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td style="font-weight: bold" colspan="3">DATA AYAH</td>

            <td width="10%" rowspan="9"></td>

            <td style="font-weight: bold" colspan="3">DATA IBU</td>
        </tr>
        <tr>
            <td width="20%">Ayah Kandung</td>
            <td widh="5%">:</td>
            <td width="25%">{{ $ayah_kandung }}</td>

            <td width="25%">Ibu Kandung</td>
            <td widh="5%">:</td>
            <td width="25%">{{ $ibu_kandung }}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>:</td>
            <td>{{ $status_ayah }}</td>

            <td>Status</td>
            <td>:</td>
            <td>{{ $status_ibu }}</td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>{{ $nik_ayah }}</td>

            <td>NIK</td>
            <td>:</td>
            <td>{{ $nik_ibu }}</td>
        </tr>
        <tr>
            <td>Tempat Lahir</td>
            <td>:</td>
            <td>{{ $tempat_lahir_ayah }}</td>

            <td>Tempat Lahir</td>
            <td>:</td>
            <td>{{ $tempat_lahir_ibu }}</td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td>{{ $tanggal_lahir_ayah }}</td>

            <td>Tanggal Lahir</td>
            <td>:</td>
            <td>{{ $tanggal_lahir_ibu }}</td>
        </tr>
        <tr>
            <td>Pendidikan terakhir</td>
            <td>:</td>
            <td>{{ $pendidikan_ayah }}</td>

            <td>Pendidikan terakhir</td>
            <td>:</td>
            <td>{{ $pendidikan_ibu }}</td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>:</td>
            <td>{{ $pekerjaan_ayah }}</td>

            <td>Pekerjaan</td>
            <td>:</td>
            <td>{{ $pekerjaan_ibu }}</td>
        </tr>
        <tr>
            <td>No. KKS</td>
            <td>:</td>
            <td>{{ $nomor_kks }}</td>

            <td>No. PKH</td>
            <td>:</td>
            <td>{{ $nomor_pkh }}</td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td style="font-weight: bold" colspan="3">DATA RAPOR</td>

            <td width="10%" rowspan="3"></td>

            <td style="font-weight: bold" colspan="3"></td>
        </tr>
    </table>
    @foreach ($semua_kelas as $kelas)
        @foreach ($semua_semester as $semester)
            @php
                $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                $tahun_ajaran = \App\Models\TahunAjaran::where('status', 'aktif')->first();
                $tahun_ajaran_all = \App\Models\TahunAjaran::all();
            @endphp

            <table>

                <tr>
                    <td width="20%">Kelas</td>
                    <td widh="5%">:</td>
                    <td width="25%">{{ $kelas->id }}</td>

                    <td width="10%" rowspan="3"></td>

                    <td width="25%">Semester</td>
                    <td widh="5%">:</td>
                    <td width="25%">{{ $semester }}</td>
                    @if ($loop->iteration != 1)
                        <br>
                    @endif
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>

                    <td>Tahun Ajaran</td>
                    <td>:</td>
                    <td>{{ $tahun_ajaran_all->where('id', $nilai->where('id_kelas_for_nilai', $kelas->id)->first()->id_tahun_ajaran_for_nilai ?? null)->where('semester', $semester)->first()->tahun ?? null }}
                    </td>

                </tr>

            </table>

            <table id="rapor" width="100%">
                <tr style="text-align: center; font-weight: bold;">
                    <td rowspan="2">No.</td>
                    <td rowspan="2">Mata Pelajaran</td>

                    <td colspan="3">KD 1</td>
                    <td rowspan="2">RT2</td>

                    <td colspan="3">KD 2</td>
                    <td rowspan="2">RT2</td>

                    <td colspan="3">KD 3</td>
                    <td rowspan="2">RT2</td>

                    <td colspan="3">KD 4</td>
                    <td rowspan="2">RT2</td>

                    <td colspan="3">KD 5</td>
                    <td rowspan="2">RT2</td>

                    <td rowspan="2">RT2 PH</td>
                    <td rowspan="2">PTS</td>
                    <td rowspan="2">PAS</td>
                    <td rowspan="2">NA</td>
                </tr>
                <tr style="text-align: center; font-weight: bold">
                    <td>PH 1</td>
                    <td>PH 2</td>
                    <td>PH 3</td>

                    <td>PH 1</td>
                    <td>PH 2</td>
                    <td>PH 3</td>

                    <td>PH 1</td>
                    <td>PH 2</td>
                    <td>PH 3</td>

                    <td>PH 1</td>
                    <td>PH 2</td>
                    <td>PH 3</td>

                    <td>PH 1</td>
                    <td>PH 2</td>
                    <td>PH 3</td>
                </tr>
                {{-- loop semua mata pelajaran --}}
                @php
                    $no = 1;
                @endphp

                @foreach ($semua_mata_pelajaran as $mata_pelajaran)
                    <tr style="text-align: center">
                        <td style="text-align: center ;vertical-align: top">{{ $no++ }}</td>
                        <td style="text-align: left">{{ $mata_pelajaran->mata_pelajaran }}</td>

                        @php
                            $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                            $tahun_ajaran =
                                \App\Models\TahunAjaran::where(
                                    'id',
                                    $nilai->where('id_kelas_for_nilai', $kelas->id)->first()
                                        ->id_tahun_ajaran_for_nilai ?? null,
                                )
                                    ->where('semester', $semester)
                                    ->first()->id ?? null;

                            $nilai_ph_1_kd_1 =
                                $nilai
                                    ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                    ->where('id_kelas_for_nilai', $kelas->id)
                                    ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                    ->where('tipe_nilai', 'Ulangan Harian')
                                    ->where('kompetensi_dasar', 'KD 1')
                                    ->where('judul', 'PH 1')
                                    ->first()->nilai ?? null;

                            $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                            $nilai_ph_2_kd_1 =
                                $nilai
                                    ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                    ->where('id_kelas_for_nilai', $kelas->id)
                                    ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                    ->where('tipe_nilai', 'Ulangan Harian')
                                    ->where('kompetensi_dasar', 'KD 1')
                                    ->where('judul', 'PH 2')
                                    ->first()->nilai ?? null;

                            $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                            $nilai_ph_3_kd_1 =
                                $nilai
                                    ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                    ->where('id_kelas_for_nilai', $kelas->id)
                                    ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                    ->where('tipe_nilai', 'Ulangan Harian')
                                    ->where('kompetensi_dasar', 'KD 1')
                                    ->where('judul', 'PH 3')
                                    ->first()->nilai ?? null;

                            $nilai_kd_1 = [$nilai_ph_1_kd_1, $nilai_ph_2_kd_1, $nilai_ph_3_kd_1];
                            $total_nilai_kd_1_yang_tidak_null = count(
                                array_filter($nilai_kd_1, function ($nilai) {
                                    return !is_null($nilai);
                                }),
                            );

                            $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                            $nilai_ph_1_kd_2 =
                                $nilai
                                    ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                    ->where('id_kelas_for_nilai', $kelas->id)
                                    ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                    ->where('tipe_nilai', 'Ulangan Harian')
                                    ->where('kompetensi_dasar', 'KD 2')
                                    ->where('judul', 'PH 1')
                                    ->first()->nilai ?? null;

                            $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                            $nilai_ph_2_kd_2 =
                                $nilai
                                    ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                    ->where('id_kelas_for_nilai', $kelas->id)
                                    ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                    ->where('tipe_nilai', 'Ulangan Harian')
                                    ->where('kompetensi_dasar', 'KD 2')
                                    ->where('judul', 'PH 2')
                                    ->first()->nilai ?? null;

                            $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                            $nilai_ph_3_kd_2 =
                                $nilai
                                    ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                    ->where('id_kelas_for_nilai', $kelas->id)
                                    ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                    ->where('tipe_nilai', 'Ulangan Harian')
                                    ->where('kompetensi_dasar', 'KD 2')
                                    ->where('judul', 'PH 3')
                                    ->first()->nilai ?? null;

                            $nilai_kd_2 = [$nilai_ph_1_kd_2, $nilai_ph_2_kd_2, $nilai_ph_3_kd_2];
                            $total_nilai_kd_2_yang_tidak_null = count(
                                array_filter($nilai_kd_2, function ($nilai) {
                                    return !is_null($nilai);
                                }),
                            );

                            $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                            $nilai_ph_1_kd_3 =
                                $nilai
                                    ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                    ->where('id_kelas_for_nilai', $kelas->id)
                                    ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                    ->where('tipe_nilai', 'Ulangan Harian')
                                    ->where('kompetensi_dasar', 'KD 3')
                                    ->where('judul', 'PH 1')
                                    ->first()->nilai ?? null;

                            $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                            $nilai_ph_2_kd_3 =
                                $nilai
                                    ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                    ->where('id_kelas_for_nilai', $kelas->id)
                                    ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                    ->where('tipe_nilai', 'Ulangan Harian')
                                    ->where('kompetensi_dasar', 'KD 3')
                                    ->where('judul', 'PH 2')
                                    ->first()->nilai ?? null;

                            $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                            $nilai_ph_3_kd_3 =
                                $nilai
                                    ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                    ->where('id_kelas_for_nilai', $kelas->id)
                                    ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                    ->where('tipe_nilai', 'Ulangan Harian')
                                    ->where('kompetensi_dasar', 'KD 3')
                                    ->where('judul', 'PH 3')
                                    ->first()->nilai ?? null;

                            $nilai_kd_3 = [$nilai_ph_1_kd_3, $nilai_ph_2_kd_3, $nilai_ph_3_kd_3];
                            $total_nilai_kd_3_yang_tidak_null = count(
                                array_filter($nilai_kd_3, function ($nilai) {
                                    return !is_null($nilai);
                                }),
                            );

                            $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                            $nilai_ph_1_kd_4 =
                                $nilai
                                    ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                    ->where('id_kelas_for_nilai', $kelas->id)
                                    ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                    ->where('tipe_nilai', 'Ulangan Harian')
                                    ->where('kompetensi_dasar', 'KD 4')
                                    ->where('judul', 'PH 1')
                                    ->first()->nilai ?? null;

                            $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                            $nilai_ph_2_kd_4 =
                                $nilai
                                    ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                    ->where('id_kelas_for_nilai', $kelas->id)
                                    ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                    ->where('tipe_nilai', 'Ulangan Harian')
                                    ->where('kompetensi_dasar', 'KD 4')
                                    ->where('judul', 'PH 2')
                                    ->first()->nilai ?? null;

                            $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                            $nilai_ph_3_kd_4 =
                                $nilai
                                    ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                    ->where('id_kelas_for_nilai', $kelas->id)
                                    ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                    ->where('tipe_nilai', 'Ulangan Harian')
                                    ->where('kompetensi_dasar', 'KD 4')
                                    ->where('judul', 'PH 3')
                                    ->first()->nilai ?? null;

                            $nilai_kd_4 = [$nilai_ph_1_kd_4, $nilai_ph_2_kd_4, $nilai_ph_3_kd_4];
                            $total_nilai_kd_4_yang_tidak_null = count(
                                array_filter($nilai_kd_4, function ($nilai) {
                                    return !is_null($nilai);
                                }),
                            );

                            $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                            $nilai_ph_1_kd_5 =
                                $nilai
                                    ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                    ->where('id_kelas_for_nilai', $kelas->id)
                                    ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                    ->where('tipe_nilai', 'Ulangan Harian')
                                    ->where('kompetensi_dasar', 'KD 5')
                                    ->where('judul', 'PH 1')
                                    ->first()->nilai ?? null;

                            $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                            $nilai_ph_2_kd_5 =
                                $nilai
                                    ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                    ->where('id_kelas_for_nilai', $kelas->id)
                                    ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                    ->where('tipe_nilai', 'Ulangan Harian')
                                    ->where('kompetensi_dasar', 'KD 5')
                                    ->where('judul', 'PH 2')
                                    ->first()->nilai ?? null;

                            $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                            $nilai_ph_3_kd_5 =
                                $nilai
                                    ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                    ->where('id_kelas_for_nilai', $kelas->id)
                                    ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                    ->where('tipe_nilai', 'Ulangan Harian')
                                    ->where('kompetensi_dasar', 'KD 5')
                                    ->where('judul', 'PH 3')
                                    ->first()->nilai ?? null;

                            $nilai_kd_5 = [$nilai_ph_1_kd_5, $nilai_ph_2_kd_5, $nilai_ph_3_kd_5];
                            $total_nilai_kd_5_yang_tidak_null = count(
                                array_filter($nilai_kd_5, function ($nilai) {
                                    return !is_null($nilai);
                                }),
                            );

                            if ($total_nilai_kd_1_yang_tidak_null == 0) {
                                $rata_rata_ph_kd_1 = null;
                            } else {
                                $rata_rata_ph_kd_1 =
                                    ($nilai_ph_1_kd_1 + $nilai_ph_2_kd_1 + $nilai_ph_3_kd_1) /
                                    $total_nilai_kd_1_yang_tidak_null;
                                $rata_rata_ph_kd_1 =
                                    floor($rata_rata_ph_kd_1) == $rata_rata_ph_kd_1
                                        ? $rata_rata_ph_kd_1
                                        : number_format($rata_rata_ph_kd_1, 2);
                            }

                            if ($total_nilai_kd_2_yang_tidak_null == 0) {
                                $rata_rata_ph_kd_2 = null;
                            } else {
                                $rata_rata_ph_kd_2 =
                                    ($nilai_ph_1_kd_2 + $nilai_ph_2_kd_2 + $nilai_ph_3_kd_2) /
                                    $total_nilai_kd_2_yang_tidak_null;
                                $rata_rata_ph_kd_2 =
                                    floor($rata_rata_ph_kd_2) == $rata_rata_ph_kd_2
                                        ? $rata_rata_ph_kd_2
                                        : number_format($rata_rata_ph_kd_2, 2);
                            }

                            if ($total_nilai_kd_3_yang_tidak_null == 0) {
                                $rata_rata_ph_kd_3 = null;
                            } else {
                                $rata_rata_ph_kd_3 =
                                    ($nilai_ph_1_kd_3 + $nilai_ph_2_kd_3 + $nilai_ph_3_kd_3) /
                                    $total_nilai_kd_3_yang_tidak_null;
                                $rata_rata_ph_kd_3 =
                                    floor($rata_rata_ph_kd_3) == $rata_rata_ph_kd_3
                                        ? $rata_rata_ph_kd_3
                                        : number_format($rata_rata_ph_kd_3, 2);
                            }

                            if ($total_nilai_kd_4_yang_tidak_null == 0) {
                                $rata_rata_ph_kd_4 = null;
                            } else {
                                $rata_rata_ph_kd_4 =
                                    ($nilai_ph_1_kd_4 + $nilai_ph_2_kd_4 + $nilai_ph_3_kd_4) /
                                    $total_nilai_kd_4_yang_tidak_null;
                                $rata_rata_ph_kd_4 =
                                    floor($rata_rata_ph_kd_4) == $rata_rata_ph_kd_4
                                        ? $rata_rata_ph_kd_4
                                        : number_format($rata_rata_ph_kd_4, 2);
                            }

                            if ($total_nilai_kd_5_yang_tidak_null == 0) {
                                $rata_rata_ph_kd_5 = null;
                            } else {
                                $rata_rata_ph_kd_5 =
                                    ($nilai_ph_1_kd_5 + $nilai_ph_2_kd_5 + $nilai_ph_3_kd_5) /
                                    $total_nilai_kd_5_yang_tidak_null;
                                $rata_rata_ph_kd_5 =
                                    floor($rata_rata_ph_kd_5) == $rata_rata_ph_kd_5
                                        ? $rata_rata_ph_kd_5
                                        : number_format($rata_rata_ph_kd_5, 2);
                            }

                            $nilai_rata_ph_all = [
                                $rata_rata_ph_kd_1,
                                $rata_rata_ph_kd_2,
                                $rata_rata_ph_kd_3,
                                $rata_rata_ph_kd_4,
                                $rata_rata_ph_kd_5,
                            ];
                            $total_nilai_rata_ph_yang_tidak_null = count(
                                array_filter($nilai_rata_ph_all, function ($nilai) {
                                    return !is_null($nilai);
                                }),
                            );

                            if ($total_nilai_rata_ph_yang_tidak_null == 0) {
                                $rata_rata_ph = null;
                            } else {
                                $rata_rata_ph =
                                    ($rata_rata_ph_kd_1 +
                                        $rata_rata_ph_kd_2 +
                                        $rata_rata_ph_kd_3 +
                                        $rata_rata_ph_kd_4 +
                                        $rata_rata_ph_kd_5) /
                                    $total_nilai_rata_ph_yang_tidak_null;
                                $rata_rata_ph =
                                    floor($rata_rata_ph) == $rata_rata_ph
                                        ? $rata_rata_ph
                                        : number_format($rata_rata_ph, 2);
                            }

                            $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                            $nilai_uts =
                                $nilai
                                    ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                    ->where('id_kelas_for_nilai', $kelas->id)
                                    ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                    ->where('tipe_nilai', 'UTS')
                                    ->first()->nilai ?? null;

                            $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                            $nilai_uas =
                                $nilai
                                    ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                    ->where('id_kelas_for_nilai', $kelas->id)
                                    ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                    ->where('tipe_nilai', 'UAS')
                                    ->first()->nilai ?? null;

                            if ($nilai_uas == null) {
                                $nilai_rapor = null;
                            } else {
                                $nilai_rapor = (60 / 100) * $rata_rata_ph + (40 / 100) * $nilai_uas;
                                $nilai_rapor =
                                    floor($nilai_rapor) == $nilai_rapor ? $nilai_rapor : number_format($nilai_rapor, 2);
                            }
                        @endphp

                        <td>{{ $nilai_ph_1_kd_1 }}</td>
                        <td>{{ $nilai_ph_2_kd_1 }}</td>
                        <td>{{ $nilai_ph_3_kd_1 }}</td>

                        <td>{{ $rata_rata_ph_kd_1 }}</td>

                        <td>{{ $nilai_ph_1_kd_2 }}</td>
                        <td>{{ $nilai_ph_2_kd_2 }}</td>
                        <td>{{ $nilai_ph_3_kd_2 }}</td>

                        <td>{{ $rata_rata_ph_kd_2 }}</td>

                        <td>{{ $nilai_ph_1_kd_3 }}</td>
                        <td>{{ $nilai_ph_2_kd_3 }}</td>
                        <td>{{ $nilai_ph_3_kd_3 }}</td>

                        <td>{{ $rata_rata_ph_kd_3 }}</td>

                        <td>{{ $nilai_ph_1_kd_4 }}</td>
                        <td>{{ $nilai_ph_2_kd_4 }}</td>
                        <td>{{ $nilai_ph_3_kd_4 }}</td>

                        <td>{{ $rata_rata_ph_kd_4 }}</td>

                        <td>{{ $nilai_ph_1_kd_5 }}</td>
                        <td>{{ $nilai_ph_2_kd_5 }}</td>
                        <td>{{ $nilai_ph_3_kd_5 }}</td>

                        <td>{{ $rata_rata_ph_kd_5 }}</td>

                        <td>{{ $rata_rata_ph }}</td>

                        <td>{{ $nilai_uts }}</td>

                        <td>{{ $nilai_uas }}</td>

                        <td>{{ $nilai_rapor }}</td>
                    </tr>
                @endforeach
            </table>

            @if ($loop->iteration != 1)
                <br>
            @endif
        @endforeach
    @endforeach

    <table>
        <tr>
            <td style="font-weight: bold" colspan="3">DATA NILAI IJAZAH</td>

            <td width="10%" rowspan="3"></td>

            <td style="font-weight: bold" colspan="3"></td>
        </tr>
    </table>

    <table id="ijazah" width="100%">
        <tr style="text-align: center; font-weight: bold;">
            <td rowspan="{{ $semua_mata_pelajaran->count() + 3 }}" width="15%"></td>
            <td rowspan="3" width="10%">Nilai Batas Kelulusan (SKL).</td>

            <td rowspan="3" width="20%">MATA PELAJARAN</td>

            <td colspan="7">NILAI RAPOR PER SEMESTER</td>

            <td rowspan="3">Bobot Rapor (60%)</td>

            <td colspan="3">Nilai Asesmen</td>

            <td rowspan="3">Bobot Nilai Asesmen (40%)</td>

            <td rowspan="3">Nilai Akhir</td>

            <td rowspan="3">L/TL</td>
        </tr>
        <tr style="text-align: center; font-weight: bold">
            <td colspan="2">9</td>
            <td colspan="2">10</td>
            <td colspan="2">11</td>

            <td rowspan="2" width="3%">Rata2</td>

            <td rowspan="2">KI-3</td>
            <td rowspan="2">KI-4</td>

            <td rowspan="2">Rata2 Nilai</td>
        </tr>
        <tr style="text-align: center; font-weight: bold">
            <td width="3%">KI-3</td>
            <td width="3%">KI-4</td>

            <td width="3%">KI-3</td>
            <td width="3%">KI-4</td>

            <td width="3%">KI-3</td>
            <td width="3%">KI-4</td>
        </tr>
        @php
            $no = 1;
        @endphp

        @foreach ($semua_mata_pelajaran as $mata_pelajaran)
            <tr style="text-align: center">
                <td style="text-align: center ;vertical-align: top">{{ $mata_pelajaran->nilai_batas_kelulusan }}</td>
                <td style="text-align: left">{{ $mata_pelajaran->mata_pelajaran }}</td>

                @php
                    $semester9to11 = [9, 10, 11];
                    foreach ($semester9to11 as $k) {
                        if ($k == 9) {
                            $semester = 'Gasal';
                            $kelas = 5;
                        } elseif ($k == 10) {
                            $semester = 'Genap';
                            $kelas = 5;
                        } elseif ($k == 11) {
                            $semester = 'Gasal';
                            $kelas = 6;
                        }

                        $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                        $tahun_ajaran =
                            \App\Models\TahunAjaran::where(
                                'id',
                                $nilai->where('id_kelas_for_nilai', $kelas)->first()->id_tahun_ajaran_for_nilai ?? null,
                            )
                                ->where('semester', $semester)
                                ->first()->id ?? null;

                        $nilai_ph_1_kd_1 =
                            $nilai
                                ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                ->where('id_kelas_for_nilai', $kelas)
                                ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                ->where('tipe_nilai', 'Ulangan Harian')
                                ->where('kompetensi_dasar', 'KD 1')
                                ->where('judul', 'PH 1')
                                ->first()->nilai ?? null;

                        $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                        $nilai_ph_2_kd_1 =
                            $nilai
                                ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                ->where('id_kelas_for_nilai', $kelas)
                                ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                ->where('tipe_nilai', 'Ulangan Harian')
                                ->where('kompetensi_dasar', 'KD 1')
                                ->where('judul', 'PH 2')
                                ->first()->nilai ?? null;

                        $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                        $nilai_ph_3_kd_1 =
                            $nilai
                                ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                ->where('id_kelas_for_nilai', $kelas)
                                ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                ->where('tipe_nilai', 'Ulangan Harian')
                                ->where('kompetensi_dasar', 'KD 1')
                                ->where('judul', 'PH 3')
                                ->first()->nilai ?? null;

                        $nilai_kd_1 = [$nilai_ph_1_kd_1, $nilai_ph_2_kd_1, $nilai_ph_3_kd_1];
                        $total_nilai_kd_1_yang_tidak_null = count(
                            array_filter($nilai_kd_1, function ($nilai) {
                                return !is_null($nilai);
                            }),
                        );

                        $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                        $nilai_ph_1_kd_2 =
                            $nilai
                                ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                ->where('id_kelas_for_nilai', $kelas)
                                ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                ->where('tipe_nilai', 'Ulangan Harian')
                                ->where('kompetensi_dasar', 'KD 2')
                                ->where('judul', 'PH 1')
                                ->first()->nilai ?? null;

                        $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                        $nilai_ph_2_kd_2 =
                            $nilai
                                ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                ->where('id_kelas_for_nilai', $kelas)
                                ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                ->where('tipe_nilai', 'Ulangan Harian')
                                ->where('kompetensi_dasar', 'KD 2')
                                ->where('judul', 'PH 2')
                                ->first()->nilai ?? null;

                        $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                        $nilai_ph_3_kd_2 =
                            $nilai
                                ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                ->where('id_kelas_for_nilai', $kelas)
                                ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                ->where('tipe_nilai', 'Ulangan Harian')
                                ->where('kompetensi_dasar', 'KD 2')
                                ->where('judul', 'PH 3')
                                ->first()->nilai ?? null;

                        $nilai_kd_2 = [$nilai_ph_1_kd_2, $nilai_ph_2_kd_2, $nilai_ph_3_kd_2];
                        $total_nilai_kd_2_yang_tidak_null = count(
                            array_filter($nilai_kd_2, function ($nilai) {
                                return !is_null($nilai);
                            }),
                        );

                        $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                        $nilai_ph_1_kd_3 =
                            $nilai
                                ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                ->where('id_kelas_for_nilai', $kelas)
                                ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                ->where('tipe_nilai', 'Ulangan Harian')
                                ->where('kompetensi_dasar', 'KD 3')
                                ->where('judul', 'PH 1')
                                ->first()->nilai ?? null;

                        $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                        $nilai_ph_2_kd_3 =
                            $nilai
                                ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                ->where('id_kelas_for_nilai', $kelas)
                                ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                ->where('tipe_nilai', 'Ulangan Harian')
                                ->where('kompetensi_dasar', 'KD 3')
                                ->where('judul', 'PH 2')
                                ->first()->nilai ?? null;

                        $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                        $nilai_ph_3_kd_3 =
                            $nilai
                                ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                ->where('id_kelas_for_nilai', $kelas)
                                ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                ->where('tipe_nilai', 'Ulangan Harian')
                                ->where('kompetensi_dasar', 'KD 3')
                                ->where('judul', 'PH 3')
                                ->first()->nilai ?? null;

                        $nilai_kd_3 = [$nilai_ph_1_kd_3, $nilai_ph_2_kd_3, $nilai_ph_3_kd_3];
                        $total_nilai_kd_3_yang_tidak_null = count(
                            array_filter($nilai_kd_3, function ($nilai) {
                                return !is_null($nilai);
                            }),
                        );

                        $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                        $nilai_ph_1_kd_4 =
                            $nilai
                                ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                ->where('id_kelas_for_nilai', $kelas)
                                ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                ->where('tipe_nilai', 'Ulangan Harian')
                                ->where('kompetensi_dasar', 'KD 4')
                                ->where('judul', 'PH 1')
                                ->first()->nilai ?? null;

                        $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                        $nilai_ph_2_kd_4 =
                            $nilai
                                ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                ->where('id_kelas_for_nilai', $kelas)
                                ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                ->where('tipe_nilai', 'Ulangan Harian')
                                ->where('kompetensi_dasar', 'KD 4')
                                ->where('judul', 'PH 2')
                                ->first()->nilai ?? null;

                        $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                        $nilai_ph_3_kd_4 =
                            $nilai
                                ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                ->where('id_kelas_for_nilai', $kelas)
                                ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                ->where('tipe_nilai', 'Ulangan Harian')
                                ->where('kompetensi_dasar', 'KD 4')
                                ->where('judul', 'PH 3')
                                ->first()->nilai ?? null;

                        $nilai_kd_4 = [$nilai_ph_1_kd_4, $nilai_ph_2_kd_4, $nilai_ph_3_kd_4];
                        $total_nilai_kd_4_yang_tidak_null = count(
                            array_filter($nilai_kd_4, function ($nilai) {
                                return !is_null($nilai);
                            }),
                        );

                        $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                        $nilai_ph_1_kd_5 =
                            $nilai
                                ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                ->where('id_kelas_for_nilai', $kelas)
                                ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                ->where('tipe_nilai', 'Ulangan Harian')
                                ->where('kompetensi_dasar', 'KD 5')
                                ->where('judul', 'PH 1')
                                ->first()->nilai ?? null;

                        $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                        $nilai_ph_2_kd_5 =
                            $nilai
                                ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                ->where('id_kelas_for_nilai', $kelas)
                                ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                ->where('tipe_nilai', 'Ulangan Harian')
                                ->where('kompetensi_dasar', 'KD 5')
                                ->where('judul', 'PH 2')
                                ->first()->nilai ?? null;

                        $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                        $nilai_ph_3_kd_5 =
                            $nilai
                                ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                ->where('id_kelas_for_nilai', $kelas)
                                ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                ->where('tipe_nilai', 'Ulangan Harian')
                                ->where('kompetensi_dasar', 'KD 5')
                                ->where('judul', 'PH 3')
                                ->first()->nilai ?? null;

                        $nilai_kd_5 = [$nilai_ph_1_kd_5, $nilai_ph_2_kd_5, $nilai_ph_3_kd_5];
                        $total_nilai_kd_5_yang_tidak_null = count(
                            array_filter($nilai_kd_5, function ($nilai) {
                                return !is_null($nilai);
                            }),
                        );

                        if ($total_nilai_kd_1_yang_tidak_null == 0) {
                            $rata_rata_ph_kd_1 = null;
                        } else {
                            $rata_rata_ph_kd_1 =
                                ($nilai_ph_1_kd_1 + $nilai_ph_2_kd_1 + $nilai_ph_3_kd_1) /
                                $total_nilai_kd_1_yang_tidak_null;
                            $rata_rata_ph_kd_1 =
                                floor($rata_rata_ph_kd_1) == $rata_rata_ph_kd_1
                                    ? $rata_rata_ph_kd_1
                                    : number_format($rata_rata_ph_kd_1, 2);
                        }

                        if ($total_nilai_kd_2_yang_tidak_null == 0) {
                            $rata_rata_ph_kd_2 = null;
                        } else {
                            $rata_rata_ph_kd_2 =
                                ($nilai_ph_1_kd_2 + $nilai_ph_2_kd_2 + $nilai_ph_3_kd_2) /
                                $total_nilai_kd_2_yang_tidak_null;
                            $rata_rata_ph_kd_2 =
                                floor($rata_rata_ph_kd_2) == $rata_rata_ph_kd_2
                                    ? $rata_rata_ph_kd_2
                                    : number_format($rata_rata_ph_kd_2, 2);
                        }

                        if ($total_nilai_kd_3_yang_tidak_null == 0) {
                            $rata_rata_ph_kd_3 = null;
                        } else {
                            $rata_rata_ph_kd_3 =
                                ($nilai_ph_1_kd_3 + $nilai_ph_2_kd_3 + $nilai_ph_3_kd_3) /
                                $total_nilai_kd_3_yang_tidak_null;
                            $rata_rata_ph_kd_3 =
                                floor($rata_rata_ph_kd_3) == $rata_rata_ph_kd_3
                                    ? $rata_rata_ph_kd_3
                                    : number_format($rata_rata_ph_kd_3, 2);
                        }

                        if ($total_nilai_kd_4_yang_tidak_null == 0) {
                            $rata_rata_ph_kd_4 = null;
                        } else {
                            $rata_rata_ph_kd_4 =
                                ($nilai_ph_1_kd_4 + $nilai_ph_2_kd_4 + $nilai_ph_3_kd_4) /
                                $total_nilai_kd_4_yang_tidak_null;
                            $rata_rata_ph_kd_4 =
                                floor($rata_rata_ph_kd_4) == $rata_rata_ph_kd_4
                                    ? $rata_rata_ph_kd_4
                                    : number_format($rata_rata_ph_kd_4, 2);
                        }

                        if ($total_nilai_kd_5_yang_tidak_null == 0) {
                            $rata_rata_ph_kd_5 = null;
                        } else {
                            $rata_rata_ph_kd_5 =
                                ($nilai_ph_1_kd_5 + $nilai_ph_2_kd_5 + $nilai_ph_3_kd_5) /
                                $total_nilai_kd_5_yang_tidak_null;
                            $rata_rata_ph_kd_5 =
                                floor($rata_rata_ph_kd_5) == $rata_rata_ph_kd_5
                                    ? $rata_rata_ph_kd_5
                                    : number_format($rata_rata_ph_kd_5, 2);
                        }

                        $nilai_rata_ph_all = [
                            $rata_rata_ph_kd_1,
                            $rata_rata_ph_kd_2,
                            $rata_rata_ph_kd_3,
                            $rata_rata_ph_kd_4,
                            $rata_rata_ph_kd_5,
                        ];
                        $total_nilai_rata_ph_yang_tidak_null = count(
                            array_filter($nilai_rata_ph_all, function ($nilai) {
                                return !is_null($nilai);
                            }),
                        );

                        if ($total_nilai_rata_ph_yang_tidak_null == 0) {
                            $rata_rata_ph = null;
                        } else {
                            $rata_rata_ph =
                                ($rata_rata_ph_kd_1 +
                                    $rata_rata_ph_kd_2 +
                                    $rata_rata_ph_kd_3 +
                                    $rata_rata_ph_kd_4 +
                                    $rata_rata_ph_kd_5) /
                                $total_nilai_rata_ph_yang_tidak_null;
                            $rata_rata_ph =
                                floor($rata_rata_ph) == $rata_rata_ph ? $rata_rata_ph : number_format($rata_rata_ph, 2);
                        }

                        $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                        $nilai_uts =
                            $nilai
                                ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                ->where('id_kelas_for_nilai', $kelas)
                                ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                ->where('tipe_nilai', 'UTS')
                                ->first()->nilai ?? null;

                        $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                        $nilai_uas =
                            $nilai
                                ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                ->where('id_kelas_for_nilai', $kelas)
                                ->where('id_tahun_ajaran_for_nilai', $tahun_ajaran)
                                ->where('tipe_nilai', 'UAS')
                                ->first()->nilai ?? null;
                                
                        // sini (uncomment untuk code asli)
                        if ($k == 9) {
                            if ($nilai_uas == null) {
                                $nilai_semester_9 = null;
                            } else {
                                $nilai_semester_9 = (60 / 100) * $rata_rata_ph + (40 / 100) * $nilai_uas;
                                $nilai_semester_9 =
                                    floor($nilai_semester_9) == $nilai_semester_9 ? $nilai_semester_9 : number_format($nilai_semester_9, 2);
                            }

                            $nilai_semester_10 = null;
                            $nilai_semester_11 = null;
                        } elseif ($k == 10) {
                            if ($nilai_uas == null) {
                                $nilai_semester_10 = null;
                            } else {
                                $nilai_semester_10 = (60 / 100) * $rata_rata_ph + (40 / 100) * $nilai_uas;
                                $nilai_semester_10 =
                                    floor($nilai_semester_10) == $nilai_semester_10 ? $nilai_semester_10 : number_format($nilai_semester_10, 2);
                            }
                        } elseif ($k == 11) {
                            if ($nilai_uas == null) {
                                $nilai_semester_11 = null;
                            } else {
                                $nilai_semester_11 = (60 / 100) * $rata_rata_ph + (40 / 100) * $nilai_uas;
                                $nilai_semester_11 =
                                    floor($nilai_semester_11) == $nilai_semester_11 ? $nilai_semester_11 : number_format($nilai_semester_11, 2);
                            }
                        }

                        // sini (code testing)
                        // if ($k == 9) {
                        //     $nilai_semester_9 = 90;

                        //     $nilai_semester_10 = null;
                        //     $nilai_semester_11 = null;
                        // } elseif ($k == 10) {
                        //     $nilai_semester_10 = 80;
                        // } elseif ($k == 11) {
                        //     $nilai_semester_11 = null;
                        // }

                        $nilai_rapor_all = [$nilai_semester_9, $nilai_semester_10, $nilai_semester_11];
                        $total_nilai_rapor_yang_tidak_null = count(
                            array_filter($nilai_rapor_all, function ($nilai) {
                                return !is_null($nilai);
                            }),
                        );

                        if ($total_nilai_rapor_yang_tidak_null == 0) {
                            $rata_rata = null;

                            $bobot_rapor_60 = null;
                        } else {
                            $rata_rata =
                                ($nilai_semester_9 + $nilai_semester_10 + $nilai_semester_11) /
                                $total_nilai_rapor_yang_tidak_null;
                            $rata_rata = floor($rata_rata) == $rata_rata ? $rata_rata : number_format($rata_rata, 2);

                            $bobot_rapor_60 = (60 / 100) * $rata_rata;
                            $bobot_rapor_60 = floor($bobot_rapor_60) == $bobot_rapor_60 ? $bobot_rapor_60 : number_format($bobot_rapor_60, 2);
                        }

                        $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                        $nilai_ujian_tulis =
                            $nilai
                                ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                ->where('tipe_nilai', 'Ujian')
                                ->where('judul', 'Tulis')
                                ->first()->nilai ?? null;

                        $nilai = \App\Models\Nilai::where('id_siswa_for_nilai', $id_siswa);
                        $nilai_ujian_praktik =
                            $nilai
                                ->where('id_mapel_for_nilai', $mata_pelajaran->id)
                                ->where('tipe_nilai', 'Ujian')
                                ->where('judul', 'Praktik')
                                ->first()->nilai ?? null;

                        $nilai_ujian_all = [$nilai_ujian_tulis, $nilai_ujian_praktik];
                        $total_nilai_ujian_yang_tidak_null = count(
                            array_filter($nilai_ujian_all, function ($nilai) {
                                return !is_null($nilai);
                            }),
                        );

                        if ($total_nilai_ujian_yang_tidak_null == 0) {
                            $rata_rata_nilai_ujian = null;

                            $bobot_ujian_40 = null;
                        } else {
                            $rata_rata_nilai_ujian =
                                ($nilai_ujian_tulis + $nilai_ujian_praktik) / $total_nilai_ujian_yang_tidak_null;
                            $rata_rata_nilai_ujian =
                                floor($rata_rata_nilai_ujian) == $rata_rata_nilai_ujian
                                    ? $rata_rata_nilai_ujian
                                    : number_format($rata_rata_nilai_ujian, 2);

                            $bobot_ujian_40 = (40 / 100) * $rata_rata_nilai_ujian;
                            $bobot_ujian_40 = floor($bobot_ujian_40) == $bobot_ujian_40 ? $bobot_ujian_40 : number_format($bobot_ujian_40, 2);
                        }

                        $nilai_akhir = $bobot_rapor_60 + $bobot_ujian_40;
                        $nilai_akhir = floor($nilai_akhir) == $nilai_akhir ? $nilai_akhir : number_format($nilai_akhir, 2);
                    }
                    if ($nilai_akhir != null && $mata_pelajaran->nilai_batas_kelulusan != null) {
                        if ($nilai_akhir >= $mata_pelajaran->nilai_batas_kelulusan) {
                            $status = 'L';
                        } else {
                            $status = 'TL';
                        }
                    } else {
                        $status = null;
                    }

                    if ($loop->iteration == 1) {
                        $total_rata_rata = $rata_rata;
                        if ($rata_rata != null) {
                            $jumlah_rata_rata_yang_tidak_null = 1;
                        } else {
                            $jumlah_rata_rata_yang_tidak_null = 0;
                        }

                        $total_rata_rata_nilai_ujian = $rata_rata_nilai_ujian;
                        if ($rata_rata_nilai_ujian != null) {
                            $jumlah_rata_rata_nilai_ujian_yang_tidak_null = 1;
                        } else {
                            $jumlah_rata_rata_nilai_ujian_yang_tidak_null = 0;
                        }

                        $total_nilai_akhir = $nilai_akhir;
                        if ($nilai_akhir != null) {
                            $jumlah_nilai_akhir_yang_tidak_null = 1;
                        } else {
                            $jumlah_nilai_akhir_yang_tidak_null = 0;
                        }
                    } else {
                        $total_rata_rata = $total_rata_rata + $rata_rata;
                        $total_rata_rata = floor($total_rata_rata) == $total_rata_rata ? $total_rata_rata : number_format($total_rata_rata, 2);
                        if ($rata_rata != null) {
                            $jumlah_rata_rata_yang_tidak_null = $jumlah_rata_rata_yang_tidak_null + 1;
                        } else {
                            $jumlah_rata_rata_yang_tidak_null = $jumlah_rata_rata_yang_tidak_null;
                        }

                        $total_rata_rata_nilai_ujian = $total_rata_rata_nilai_ujian + $rata_rata_nilai_ujian;
                        $total_rata_rata_nilai_ujian = floor($total_rata_rata_nilai_ujian) == $total_rata_rata_nilai_ujian ? $total_rata_rata_nilai_ujian : number_format($total_rata_rata_nilai_ujian, 2);
                        if ($rata_rata_nilai_ujian != null) {
                            $jumlah_rata_rata_nilai_ujian_yang_tidak_null =
                                $jumlah_rata_rata_nilai_ujian_yang_tidak_null + 1;
                        } else {
                            $jumlah_rata_rata_nilai_ujian_yang_tidak_null = $jumlah_rata_rata_nilai_ujian_yang_tidak_null;
                        }

                        $total_nilai_akhir = $total_nilai_akhir + $nilai_akhir;
                        $total_nilai_akhir = floor($total_nilai_akhir) == $total_nilai_akhir ? $total_nilai_akhir : number_format($total_nilai_akhir, 2);
                        if ($nilai_akhir != null) {
                            $jumlah_nilai_akhir_yang_tidak_null = $jumlah_nilai_akhir_yang_tidak_null + 1;
                        } else {
                            $jumlah_nilai_akhir_yang_tidak_null = $jumlah_nilai_akhir_yang_tidak_null;
                        }
                    }

                    if ($jumlah_rata_rata_yang_tidak_null == 0) {
                        $rata_rata_jumlah_rata_rata = null;
                    } else {
                        $rata_rata_jumlah_rata_rata = $total_rata_rata / $jumlah_rata_rata_yang_tidak_null;
                        $rata_rata_jumlah_rata_rata = floor($rata_rata_jumlah_rata_rata) == $rata_rata_jumlah_rata_rata ? $rata_rata_jumlah_rata_rata : number_format($rata_rata_jumlah_rata_rata, 2);
                    }

                    if ($jumlah_rata_rata_nilai_ujian_yang_tidak_null == 0) {
                        $rata_rata_jumlah_rata_rata_nilai_ujian = null;
                    } else {
                        $rata_rata_jumlah_rata_rata_nilai_ujian =
                            $total_rata_rata_nilai_ujian / $jumlah_rata_rata_nilai_ujian_yang_tidak_null;
                        $rata_rata_jumlah_rata_rata_nilai_ujian = floor($rata_rata_jumlah_rata_rata_nilai_ujian) == $rata_rata_jumlah_rata_rata_nilai_ujian ? $rata_rata_jumlah_rata_rata_nilai_ujian : number_format($rata_rata_jumlah_rata_rata_nilai_ujian, 2);
                    }

                    if ($jumlah_nilai_akhir_yang_tidak_null == 0) {
                        $rata_rata_jumlah_nilai_akhir = null;
                    } else {
                        $rata_rata_jumlah_nilai_akhir = $total_nilai_akhir / $jumlah_nilai_akhir_yang_tidak_null;
                        $rata_rata_jumlah_nilai_akhir = floor($rata_rata_jumlah_nilai_akhir) == $rata_rata_jumlah_nilai_akhir ? $rata_rata_jumlah_nilai_akhir : number_format($rata_rata_jumlah_nilai_akhir, 2);
                    }
                @endphp

                <td>{{ $nilai_semester_9 }}</td>
                <td></td>

                <td>{{ $nilai_semester_10 }}</td>
                <td></td>

                <td>{{ $nilai_semester_11 }}</td>
                <td></td>

                <td>{{ $rata_rata }}</td>
                <td>{{ $bobot_rapor_60 }}</td>

                <td>{{ $nilai_ujian_tulis }}</td>
                <td>{{ $nilai_ujian_praktik }}</td>
                <td>{{ $rata_rata_nilai_ujian }}</td>

                <td>{{ $bobot_ujian_40 }}</td>
                <td>{{ $nilai_akhir }}</td>
                <td>{{ $status }}</td>
            </tr>
        @endforeach
        <tr style="font-weight: bold">
            @php
                // Ambil semua data dari model MataPelajaran
                $data_nilai_batas_kelulusan = \App\Models\MataPelajaran::all();

                // Filter data untuk mendapatkan hanya mata pelajaran yang memiliki nilai di kolom nilai_batas_kelulusan
                $mata_pelajaran_dengan_nilai = $data_nilai_batas_kelulusan->filter(function ($mataPelajaran) {
                    return !is_null($mataPelajaran->nilai_batas_kelulusan);
                });

                // Jumlahkan nilai dari kolom nilai_batas_kelulusan
                $total_nilai_batas_kelulusan = $mata_pelajaran_dengan_nilai->sum('nilai_batas_kelulusan');


                // Hitung jumlah mata pelajaran yang memiliki nilai di kolom nilai_batas_kelulusan
                $jumlah_mata_pelajaran_dengan_nilai = $mata_pelajaran_dengan_nilai->count();

                // Bagi total nilai dengan jumlah mata pelajaran
                if ($jumlah_mata_pelajaran_dengan_nilai > 0) {
                    $rata_rata_nilai_batas_kelulusan =
                        $total_nilai_batas_kelulusan / $jumlah_mata_pelajaran_dengan_nilai;
                    $rata_rata_nilai_batas_kelulusan = floor($rata_rata_nilai_batas_kelulusan) == $rata_rata_nilai_batas_kelulusan ? $rata_rata_nilai_batas_kelulusan : number_format($rata_rata_nilai_batas_kelulusan, 2);
                } else {
                    $rata_rata_nilai_batas_kelulusan = 0; // atau nilai default lain jika tidak ada mata pelajaran dengan nilai
                }

                if ($rata_rata_jumlah_nilai_akhir != null && $rata_rata_nilai_batas_kelulusan != null) {
                    if ($rata_rata_jumlah_nilai_akhir >= $rata_rata_nilai_batas_kelulusan) {
                        $status_akhir = 'L';
                    } else {
                        $status_akhir = 'TL';
                    }
                } else {
                    $status_akhir = null;
                }
            @endphp

            <td style="" rowspan="2">Nilai Rata-rata Batas Kelulusan</td>
            <td style="text-align: center" rowspan="2">
                {{ $rata_rata_nilai_batas_kelulusan }}</td>
            <td style="">Jumlah</td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center">{{ $total_rata_rata }}</td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center">{{ $total_rata_rata_nilai_ujian }}</td>
            <td style="text-align: center"></td>
            <td style="text-align: center">{{ $total_nilai_akhir }}</td>
            <td style="text-align: center" rowspan="2">{{ $status_akhir }}</td>
        </tr>
        <tr style="font-weight: bold;">
            <td style=""">Rata-rata</td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center">{{ $rata_rata_jumlah_rata_rata }}</td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center"></td>
            <td style="text-align: center">{{ $rata_rata_jumlah_rata_rata_nilai_ujian }}</td>
            <td style="text-align: center"></td>
            <td style="text-align: center">{{ $rata_rata_jumlah_nilai_akhir }}</td>
        </tr>
    </table>
</body>

<script type="text/javascript">
    window.onload = function() {
        window.print();
    };
</script>

</html>
