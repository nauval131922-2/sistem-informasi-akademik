<?php
// get current route name
$route = Route::current()->getName();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $nama_file }}</title>
</head>

<style>
    h3 {
        text-align: center;
        margin-top: 0;
    }

    h4 {
        text-align: center;
        margin-top: -15px;
        font-size: 12px;
    }

    table {
        width: 100%;
        table-layout: fixed;
        font-size: 10px;
    }

    td {
        text-align: center;
        padding: 5px;
    }

    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>

<style>
    .kop-surat-container {
        margin-bottom: 20px;
    }

    .kop-surat {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 10px;
        border-bottom: 2px solid #000;
        /* Garis tebal */
    }

    .kop-surat img {
        max-width: 100px;
    }

    .kop-surat .info {
        text-align: center;
        flex-grow: 1;
    }

    .kop-surat .info h1 {
        margin: 0;
        font-size: 28px;
    }

    .kop-surat .info h2 {
        margin: 0;
        font-size: 20px;
    }

    .kop-surat .info h3 {
        margin: 0;
        font-size: 18px;
    }

    .kop-surat .info p {
        margin: 0;
        font-size: 14px;
    }

    .garis-tipis {
        border-bottom: 1px solid #000;
        /* Garis tipis */
        margin-top: 2px;
    }

    .kop-surat img {
        /* height: 100px;
        width: auto; */
    }
</style>

<body>

    <div class="kop-surat-container">
        <div class="kop-surat">
            <img src="{{ asset('logo/lp.png') }}" alt="Logo Kiri">
            <div class="info">
                <h2>BADAN PELAKSANA PENDIDIKAN MA'ARIF NU</h2>
                <h1>MI NU NURUL ULUM</h1>
                <h3>Terakreditasi A</h3>
                <p style="font-style: italic">Alamat: Jln. Raya Kudus-Colo Km. 09 Piji Dawe Kudus 59353</p>
                <p style="font-style: italic">Email: minunurululum.pijidawe@gmail.com</p>
                <p style="font-style: italic">NPSN: 60712327/NSM: 111233190131</p>
            </div>
            <img src="{{ asset('logo/madrasah.png') }}" alt="Logo Kanan">
        </div>
        <div class="garis-tipis"></div>
    </div>

    @if (auth()->user()->id_role == 1 || auth()->user()->id_role == 2)
        @if ($kepemilikan_jadwal != null && $tipe_jadwal != 'Data Semua Jadwal' && $kelas != 'Semua Kelas')
            <h3>Data Semua Jadwal {{ $tipe_jadwal }} {{ $kepemilikan_jadwal }} khusus {{ $kelas }}</h3>
        @elseif ($kepemilikan_jadwal != null && $tipe_jadwal != 'Data Semua Jadwal' && $kelas == 'Semua Kelas')
            <h3>Data Semua Jadwal {{ $tipe_jadwal }} {{ $kepemilikan_jadwal }}</h3>
        @elseif ($kepemilikan_jadwal != null && $tipe_jadwal == 'Data Semua Jadwal' && $kelas != 'Semua Kelas')
            <h3>Data Semua Jadwal {{ $kepemilikan_jadwal }} khusus {{ $kelas }}</h3>
        @elseif ($kepemilikan_jadwal != null && $tipe_jadwal == 'Data Semua Jadwal' && $kelas == 'Semua Kelas')
            <h3>Data Semua Jadwal {{ $kepemilikan_jadwal }}</h3>
        @elseif ($tipe_jadwal != 'Data Semua Jadwal' && $kelas != 'Semua Kelas')
            <h3>Data Semua Jadwal {{ $tipe_jadwal }} khusus {{ $kelas }}</h3>
        @elseif ($tipe_jadwal != 'Data Semua Jadwal' && $kelas == 'Semua Kelas')
            <h3>Data Semua Jadwal {{ $tipe_jadwal }}</h3>
        @elseif ($tipe_jadwal == 'Data Semua Jadwal' && $kelas != 'Semua Kelas')
            <h3>Data Semua Jadwal khusus {{ $kelas }}</h3>
        @elseif ($tipe_jadwal == 'Data Semua Jadwal' && $kelas == 'Semua Kelas')
            <h3>Data Semua Jadwal</h3>
        @endif
    @elseif (auth()->user()->id_role == 3 || auth()->user()->id_role == 4)
        @if ($kepemilikan_jadwal != null && $tipe_jadwal != 'Data Semua Jadwal' && $kelas != 'Semua Kelas')
            <h3>Data Semua Jadwal {{ $tipe_jadwal }} {{ $kepemilikan_jadwal }} khusus {{ $kelas }}</h3>
        @elseif ($kepemilikan_jadwal != null && $tipe_jadwal != 'Data Semua Jadwal' && $kelas == 'Semua Kelas')
            <h3>Data Semua Jadwal {{ $tipe_jadwal }} {{ $kepemilikan_jadwal }}</h3>
        @elseif ($kepemilikan_jadwal != null && $tipe_jadwal == 'Data Semua Jadwal' && $kelas != 'Semua Kelas')
            <h3>Data Semua Jadwal {{ $kepemilikan_jadwal }} khusus {{ $kelas }}</h3>
        @elseif ($kepemilikan_jadwal != null && $tipe_jadwal == 'Data Semua Jadwal' && $kelas == 'Semua Kelas')
            <h3>Data Semua Jadwal {{ $kepemilikan_jadwal }}</h3>
        @elseif ($tipe_jadwal != 'Data Semua Jadwal' && $kelas != 'Semua Kelas')
            <h3>Data Semua Jadwal {{ $tipe_jadwal }} khusus {{ $kelas }}</h3>
        @elseif ($tipe_jadwal != 'Data Semua Jadwal' && $kelas == 'Semua Kelas')
            <h3>Data Semua Jadwal {{ $tipe_jadwal }}</h3>
        @elseif ($tipe_jadwal == 'Data Semua Jadwal' && $kelas != 'Semua Kelas')
            <h3>Data Semua Jadwal khusus {{ $kelas }}</h3>
        @elseif ($tipe_jadwal == 'Data Semua Jadwal' && $kelas == 'Semua Kelas')
            <h3>Data Semua Jadwal</h3>
        @endif
    @elseif (auth()->user()->id_role == 5)
        @if ($kepemilikan_jadwal != null && $tipe_jadwal != 'Data Semua Jadwal' && $kelas != 'Semua Kelas')
            <h3>Data Semua Jadwal {{ $tipe_jadwal }} {{ $kepemilikan_jadwal }}</h3>
        @elseif ($kepemilikan_jadwal != null && $tipe_jadwal != 'Data Semua Jadwal' && $kelas == 'Semua Kelas')
            <h3>Data Semua Jadwal {{ $tipe_jadwal }} {{ $kepemilikan_jadwal }}</h3>
        @elseif ($kepemilikan_jadwal != null && $tipe_jadwal == 'Data Semua Jadwal' && $kelas != 'Semua Kelas')
            <h3>Data Semua Jadwal {{ $kepemilikan_jadwal }}</h3>
        @elseif ($kepemilikan_jadwal != null && $tipe_jadwal == 'Data Semua Jadwal' && $kelas == 'Semua Kelas')
            <h3>Data Semua Jadwal {{ $kepemilikan_jadwal }}</h3>
        @elseif ($tipe_jadwal != 'Data Semua Jadwal' && $kelas != 'Semua Kelas')
            <h3>Data Semua Jadwal {{ $tipe_jadwal }}</h3>
        @elseif ($tipe_jadwal != 'Data Semua Jadwal' && $kelas == 'Semua Kelas')
            <h3>Data Semua Jadwal {{ $tipe_jadwal }}</h3>
        @elseif ($tipe_jadwal == 'Data Semua Jadwal' && $kelas != 'Semua Kelas')
            <h3>Data Semua Jadwal</h3>
        @elseif ($tipe_jadwal == 'Data Semua Jadwal' && $kelas == 'Semua Kelas')
            <h3>Data Semua Jadwal</h3>
        @endif
    @endif

    <h4>{{ $sekolah->nama }}</h4>
    <h4>Semester: {{ $tahun_ajaran->semester }} {{ $tahun_ajaran->tahun }}</h4>
    {{-- <br> --}}
    <table border="1" cellspacing="1" align="center">
        <tr>
            <td rowspan="2" style="width:5%"><b>No.</b></td>
            {{-- @if ($route == 'jadwal-print-all' || $route == 'jadwal-for-guru-wali-mapel-siswa-print' || $route == 'jadwal-for-kepala-madrasah-print') --}}
            @if ($tipe_jadwal == 'Data Semua Jadwal')
                <td rowspan="2" style="width:15%"><b>Mata Pelajaran / Ekstrakurikuler</b></td>
                {{-- @elseif ($route == 'jadwal-pelajaran-print-all' || $route == 'jadwal-pelajaran-print') --}}
            @elseif ($tipe_jadwal == 'Pelajaran')
                <td rowspan="2" style="width:15%"><b>Mata Pelajaran</b></td>
                {{-- @elseif ($route == 'jadwal-ekstra-print-all' || $route == 'jadwal-ekstra-print') --}}
            @elseif ($tipe_jadwal == 'Ekstrakurikuler')
                <td rowspan="2" style="width:15%"><b>Ekstrakurikuler</b></td>
            @endif

            {{-- @if ($route != 'jadwal-pelajaran-print' && $route != 'jadwal-ekstra-print') --}}
            {{-- @if ($tipe_jadwal != 'Pelajaran' && $tipe_jadwal != 'Ekstrakurikuler') --}}
            {{-- jika $kelas == 'Semua Kelas' --}}
            @if ($kelas == 'Semua Kelas')
                <td rowspan="2" style="width:7%"><b>Kelas</b></td>
            @endif

            {{-- @if ($route != 'jadwal-for-guru-wali-mapel-siswa-print' && $route != 'jadwal-for-kepala-madrasah-print') --}}
            {{-- @if ($tipe_jadwal != 'Pelajaran' && $tipe_jadwal != 'Ekstrakurikuler') --}}
            {{-- jika auth user id role == 1 atau 2 --}}
            @if (auth()->user()->id_role == 1 || auth()->user()->id_role == 2 || auth()->user()->id_role == 5)
                <td rowspan="2"><b>Guru</b></td>
            @endif

            <td colspan="7"><b>Jadwal Tatap Muka</b></td>
        </tr>
        <tr>
            <td><b>Sabtu</b></td>
            <td><b>Ahad</b></td>
            <td><b>Senin</b></td>
            <td><b>Selasa</b></td>
            <td><b>Rabu</b></td>
            <td><b>Kamis</b></td>
            <td><b>Jumat</b></td>
        </tr>
        @php
            $no = 1;
        @endphp

        @foreach ($semua_jadwal as $jadwal_pelajaran)
            <tr>
                <td>
                    {{ $no++ }}
                </td>
                <td>
                    @if ($jadwal_pelajaran->tipe_jadwal == 'Pelajaran')
                        {{ $jadwal_pelajaran->mapel->mata_pelajaran }}
                    @elseif ($jadwal_pelajaran->tipe_jadwal == 'Ekstrakurikuler')
                        {{ $jadwal_pelajaran->ekstra->nama }}
                    @endif
                </td>
                {{-- @if ($route != 'jadwal-pelajaran-print' && $route != 'jadwal-ekstra-print') --}}
                {{-- @if ($tipe_jadwal != 'Pelajaran' && $tipe_jadwal != 'Ekstrakurikuler') --}}
                {{-- jika $kelas == 'Semua Kelas' --}}
                @if ($kelas == 'Semua Kelas')
                    <td>{{ $jadwal_pelajaran->kelas->nama }}</td>
                @endif

                {{-- @if ($route != 'jadwal-for-guru-wali-mapel-siswa-print' && $route != 'jadwal-for-kepala-madrasah-print') --}}
                {{-- @if ($tipe_jadwal != 'Pelajaran' && $tipe_jadwal != 'Ekstrakurikuler') --}}
                @if (auth()->user()->id_role == 1 || auth()->user()->id_role == 2 || auth()->user()->id_role == 5)
                    <td>{{ $jadwal_pelajaran->user->name }}</td>
                @endif

                <td>
                    @if ($jadwal_pelajaran->hari == 'Sabtu')
                        {{-- format H:m --}}
                        {{-- jika tidak ada jam mulai dan jam selesai --}}
                        @if ($jadwal_pelajaran->id_jam_for_jadwal == null)
                            -
                        @else
                            {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} -
                            {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }}
                        @endif
                        {{-- {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }} --}}
                    @endif
                </td>
                <td>
                    @if ($jadwal_pelajaran->hari == 'Minggu')
                        {{-- {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }} --}}

                        @if ($jadwal_pelajaran->id_jam_for_jadwal == null)
                            -
                        @else
                            {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} -
                            {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }}
                        @endif
                    @endif
                </td>
                <td>
                    @if ($jadwal_pelajaran->hari == 'Senin')
                        {{-- {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }} --}}

                        @if ($jadwal_pelajaran->id_jam_for_jadwal == null)
                            -
                        @else
                            {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} -
                            {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }}
                        @endif
                    @endif
                </td>
                <td>
                    @if ($jadwal_pelajaran->hari == 'Selasa')
                        {{-- {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }} --}}

                        @if ($jadwal_pelajaran->id_jam_for_jadwal == null)
                            -
                        @else
                            {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} -
                            {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }}
                        @endif
                    @endif
                </td>
                <td>
                    @if ($jadwal_pelajaran->hari == 'Rabu')
                        {{-- {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }} --}}

                        @if ($jadwal_pelajaran->id_jam_for_jadwal == null)
                            -
                        @else
                            {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} -
                            {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }}
                        @endif
                    @endif
                </td>
                <td>
                    @if ($jadwal_pelajaran->hari == 'Kamis')
                        {{-- {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }} --}}

                        @if ($jadwal_pelajaran->id_jam_for_jadwal == null)
                            -
                        @else
                            {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} -
                            {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }}
                        @endif
                    @endif
                </td>
                <td>
                    @if ($jadwal_pelajaran->hari == 'Jumat')
                        {{-- {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }} --}}

                        @if ($jadwal_pelajaran->id_jam_for_jadwal == null)
                            -
                        @else
                            {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} -
                            {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }}
                        @endif
                    @endif
                </td>
            </tr>
        @endforeach


    </table>
</body>

<script type="text/javascript">
    window.onload = function() {
        window.print();
    };
</script>

</html>
