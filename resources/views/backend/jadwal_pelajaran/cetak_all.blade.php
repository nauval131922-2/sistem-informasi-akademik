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

	/* set all magins to 5px */
	html {
		margin: 25px;
	}

	body {
		font-family: 'Times New Roman', Times, serif;
	}

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

	table, th, td {
		border: 1px solid black;
		border-collapse: collapse;
	}

	td {
		text-align: center;
		padding: 5px;
	}
</style>

<body>

	@if (auth()->user()->id_role == 1 || auth()->user()->id_role == 2)
		@if ($kepemilikan_jadwal != null && $tipe_jadwal != 'Semua Data Jadwal' && $kelas != 'Semua Kelas')
			<h3>Semua Data Jadwal {{ $tipe_jadwal }} {{ $kepemilikan_jadwal }} khusus {{ $kelas }}</h3>
		@elseif ($kepemilikan_jadwal != null && $tipe_jadwal != 'Semua Data Jadwal' && $kelas == 'Semua Kelas')
			<h3>Semua Data Jadwal {{ $tipe_jadwal }} {{ $kepemilikan_jadwal }}</h3>
		@elseif ($kepemilikan_jadwal != null && $tipe_jadwal == 'Semua Data Jadwal' && $kelas != 'Semua Kelas')
			<h3>Semua Data Jadwal {{ $kepemilikan_jadwal }} khusus {{ $kelas }}</h3>
		@elseif ($kepemilikan_jadwal != null && $tipe_jadwal == 'Semua Data Jadwal' && $kelas == 'Semua Kelas')
			<h3>Semua Data Jadwal {{ $kepemilikan_jadwal }}</h3>
		@elseif ($tipe_jadwal != 'Semua Data Jadwal' && $kelas != 'Semua Kelas')
			<h3>Semua Data Jadwal {{ $tipe_jadwal }} khusus {{ $kelas }}</h3>
		@elseif ($tipe_jadwal != 'Semua Data Jadwal' && $kelas == 'Semua Kelas')
			<h3>Semua Data Jadwal {{ $tipe_jadwal }}</h3>
		@elseif ($tipe_jadwal == 'Semua Data Jadwal' && $kelas != 'Semua Kelas')
			<h3>Semua Data Jadwal khusus {{ $kelas }}</h3>
		@elseif ($tipe_jadwal == 'Semua Data Jadwal' && $kelas == 'Semua Kelas')
			<h3>Semua Data Jadwal</h3>
		@endif
	@elseif (auth()->user()->id_role == 3 || auth()->user()->id_role == 4)
		@if ($kepemilikan_jadwal != null && $tipe_jadwal != 'Semua Data Jadwal' && $kelas != 'Semua Kelas')
			<h3>Semua Data Jadwal {{ $tipe_jadwal }} {{ $kepemilikan_jadwal }} khusus {{ $kelas }}</h3>
		@elseif ($kepemilikan_jadwal != null && $tipe_jadwal != 'Semua Data Jadwal' && $kelas == 'Semua Kelas')
			<h3>Semua Data Jadwal {{ $tipe_jadwal }} {{ $kepemilikan_jadwal }}</h3>
		@elseif ($kepemilikan_jadwal != null && $tipe_jadwal == 'Semua Data Jadwal' && $kelas != 'Semua Kelas')
			<h3>Semua Data Jadwal {{ $kepemilikan_jadwal }} khusus {{ $kelas }}</h3>
		@elseif ($kepemilikan_jadwal != null && $tipe_jadwal == 'Semua Data Jadwal' && $kelas == 'Semua Kelas')
			<h3>Semua Data Jadwal {{ $kepemilikan_jadwal }}</h3>
		@elseif ($tipe_jadwal != 'Semua Data Jadwal' && $kelas != 'Semua Kelas')
			<h3>Semua Data Jadwal {{ $tipe_jadwal }} khusus {{ $kelas }}</h3>
		@elseif ($tipe_jadwal != 'Semua Data Jadwal' && $kelas == 'Semua Kelas')
			<h3>Semua Data Jadwal {{ $tipe_jadwal }}</h3>
		@elseif ($tipe_jadwal == 'Semua Data Jadwal' && $kelas != 'Semua Kelas')
			<h3>Semua Data Jadwal khusus {{ $kelas }}</h3>
		@elseif ($tipe_jadwal == 'Semua Data Jadwal' && $kelas == 'Semua Kelas')
			<h3>Semua Data Jadwal</h3>
		@endif
	@elseif (auth()->user()->id_role == 5)
		@if ($kepemilikan_jadwal != null && $tipe_jadwal != 'Semua Data Jadwal' && $kelas != 'Semua Kelas')
			<h3>Semua Data Jadwal {{ $tipe_jadwal }} {{ $kepemilikan_jadwal }}</h3>
		@elseif ($kepemilikan_jadwal != null && $tipe_jadwal != 'Semua Data Jadwal' && $kelas == 'Semua Kelas')
			<h3>Semua Data Jadwal {{ $tipe_jadwal }} {{ $kepemilikan_jadwal }}</h3>
		@elseif ($kepemilikan_jadwal != null && $tipe_jadwal == 'Semua Data Jadwal' && $kelas != 'Semua Kelas')
			<h3>Semua Data Jadwal {{ $kepemilikan_jadwal }}</h3>
		@elseif ($kepemilikan_jadwal != null && $tipe_jadwal == 'Semua Data Jadwal' && $kelas == 'Semua Kelas')
			<h3>Semua Data Jadwal {{ $kepemilikan_jadwal }}</h3>
		@elseif ($tipe_jadwal != 'Semua Data Jadwal' && $kelas != 'Semua Kelas')
			<h3>Semua Data Jadwal {{ $tipe_jadwal }}</h3>
		@elseif ($tipe_jadwal != 'Semua Data Jadwal' && $kelas == 'Semua Kelas')
			<h3>Semua Data Jadwal {{ $tipe_jadwal }}</h3>
		@elseif ($tipe_jadwal == 'Semua Data Jadwal' && $kelas != 'Semua Kelas')
			<h3>Semua Data Jadwal</h3>
		@elseif ($tipe_jadwal == 'Semua Data Jadwal' && $kelas == 'Semua Kelas')
			<h3>Semua Data Jadwal</h3>
		@endif
	@endif

	<h4>{{ $sekolah->nama }}</h4>
	<h4>Semester: {{ $tahun_ajaran->semester }} {{ $tahun_ajaran->tahun }}</h4>
	{{-- <br> --}}
		<table border="1" cellspacing="1" align="center">
			<tr>
				<td rowspan="2" style="width:5%"><b>No.</b></td>
				{{-- @if ($route == 'jadwal-print-all' || $route == 'jadwal-for-guru-wali-mapel-siswa-print' || $route == 'jadwal-for-kepala-madrasah-print') --}}
				@if ($tipe_jadwal == 'Semua Data Jadwal')
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
								{{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }}
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
								{{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }}
							@endif
						@endif
					</td>
					<td>
						@if ($jadwal_pelajaran->hari == 'Senin')
							{{-- {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }} --}}

							@if ($jadwal_pelajaran->id_jam_for_jadwal == null) 
								-
							@else
								{{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }}
							@endif
						@endif
					</td>
					<td>
						@if ($jadwal_pelajaran->hari == 'Selasa')
							{{-- {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }} --}}

							@if ($jadwal_pelajaran->id_jam_for_jadwal == null) 
								-
							@else
								{{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }}
							@endif
						@endif
					</td>
					<td>
						@if ($jadwal_pelajaran->hari == 'Rabu')
							{{-- {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }} --}}

							@if ($jadwal_pelajaran->id_jam_for_jadwal == null) 
								-
							@else
								{{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }}
							@endif
						@endif
					</td>
					<td>
						@if ($jadwal_pelajaran->hari == 'Kamis')
							{{-- {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }} --}}

							@if ($jadwal_pelajaran->id_jam_for_jadwal == null) 
								-
							@else
								{{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }}
							@endif
						@endif
					</td>
					<td>
						@if ($jadwal_pelajaran->hari == 'Jumat')
							{{-- {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }} --}}

							@if ($jadwal_pelajaran->id_jam_for_jadwal == null) 
								-
							@else
								{{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }}
							@endif
						@endif
					</td>
				</tr>
			@endforeach
		</table>
</body>
</html>
