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
		font-size: 11px;
	}

	table, th, td {
		border: 1px solid black;
		border-collapse: collapse;
	}

	td {
		text-align: center;
	}
</style>

<body>
	@if ($route == 'jadwal-print-all')
		<h3>Daftar Semua Jadwal</h3>
	@elseif ($route == 'jadwal-pelajaran-print-all')
		<h3>Daftar Semua Jadwal Pelajaran</h3>
	@elseif ($route == 'jadwal-ekstra-print-all')
		<h3>Daftar Semua Jadwal Ekstrakurikuler</h3>
	@elseif ($route == 'jadwal-pelajaran-print')
		<h3>Jadwal Pelajaran {{ $kelas->nama }}</h3>
	@endif
	<h4>{{ $sekolah->nama }}</h4>
	<h4>Semester: {{ $tahun_ajaran->semester }} {{ $tahun_ajaran->tahun }}</h4>
	{{-- <br> --}}
		<table border="1" cellspacing="1" align="center">
			<tr>
				<td rowspan="2" style="width:5%"><b>No.</b></td>
				@if ($route == 'jadwal-print-all')
					<td rowspan="2" style="width:15%"><b>Mata Pelajaran / Ekstrakurikuler</b></td>
				@elseif ($route == 'jadwal-pelajaran-print-all' || $route == 'jadwal-pelajaran-print')
					<td rowspan="2" style="width:15%"><b>Mata Pelajaran</b></td>
				@elseif ($route == 'jadwal-ekstra-print-all')
					<td rowspan="2" style="width:15%"><b>Ekstrakurikuler</b></td>
				@endif

				@if ($route != 'jadwal-pelajaran-print')
					<td rowspan="2" style="width:7%"><b>Kelas</b></td>
				@endif
				<td rowspan="2"><b>Guru</b></td>
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
					@if ($route != 'jadwal-pelajaran-print')
						<td>{{ $jadwal_pelajaran->kelas->nama }}</td>
					@endif
					<td>{{ $jadwal_pelajaran->user->name }}</td>
					<td>
						@if ($jadwal_pelajaran->hari == 'Sabtu')
							{{-- format H:m --}}
							{{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }}
						@endif
					</td>
					<td>
						@if ($jadwal_pelajaran->hari == 'Minggu')
							{{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }}
						@endif
					</td>
					<td>
						@if ($jadwal_pelajaran->hari == 'Senin')
							{{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }}
						@endif
					</td>
					<td>
						@if ($jadwal_pelajaran->hari == 'Selasa')
							{{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }}
						@endif
					</td>
					<td>
						@if ($jadwal_pelajaran->hari == 'Rabu')
							{{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }}
						@endif
					</td>
					<td>
						@if ($jadwal_pelajaran->hari == 'Kamis')
							{{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }}
						@endif
					</td>
					<td>
						@if ($jadwal_pelajaran->hari == 'Jumat')
							{{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal_pelajaran->jam->jam_selesai)) }}
						@endif
					</td>
				</tr>
			@endforeach
		</table>





		<br><br>

		<table border="1" cellspacing="1" align="center">
			<tr>
				<td align="center" height="30"
					width="70">
					<b>Day/Period</b>
				</td>
				<td align="center" height="30"
					width="70">
					<b>I<br>9:30-10:20</b>
				</td>
				<td align="center" height="30"
					width="70">
					<b>II<br>10:20-11:10</b>
				</td>
				<td align="center" height="30"
					width="70">
					<b>III<br>11:10-12:00</b>
				</td>
				<td align="center" height="30"
					width="70">
					<b>12:00-12:40</b>
				</td>
				<td align="center" height="30"
					width="70">
					<b>IV<br>12:40-1:30</b>
				</td>
				<td align="center" height="30"
					width="70">
					<b>V<br>1:30-2:20</b>
				</td>
				<td align="center" height="30"
					width="70">
					<b>VI<br>2:20-3:10</b>
				</td>
				<td align="center" height="30"
					width="70">
					<b>VII<br>3:10-4:00</b>
				</td>
			</tr>
			<tr>
				<td align="center" height="30">
					<b>Monday</b></td>
				<td align="center" height="30">Eng</td>
				<td align="center" height="30">Mat</td>
				<td align="center" height="30">Che</td>
				<td rowspan="6" align="center" height="30">
					<h2>L<br>U<br>N<br>C<br>H</h2>
				</td>
				<td colspan="3" align="center"
					height="30">LAB</td>
				<td align="center" height="30">Phy</td>
			</tr>
			<tr>
				<td align="center" height="30">
					<b>Tuesday</b>
				</td>
				<td colspan="3" align="center"
					height="30">LAB
				</td>
				<td align="center" height="30">Eng</td>
				<td align="center" height="30">Che</td>
				<td align="center" height="30">Mat</td>
				<td align="center" height="30">SPORTS</td>
			</tr>
			<tr>
				<td align="center" height="30">
					<b>Wednesday</b>
				</td>
				<td align="center" height="30">Mat</td>
				<td align="center" height="30">phy</td>
				<td align="center" height="30">Eng</td>
				<td align="center" height="30">Che</td>
				<td colspan="3" align="center"
					height="30">LIBRARY
				</td>
			</tr>
			<tr>
				<td align="center" height="30">
					<b>Thursday</b>
				</td>
				<td align="center" height="30">Phy</td>
				<td align="center" height="30">Eng</td>
				<td align="center" height="30">Che</td>
				<td colspan="3" align="center"
					height="30">LAB
				</td>
				<td align="center" height="30">Mat</td>
			</tr>
			<tr>
				<td align="center" height="30">
					<b>Friday</b>
				</td>
				<td colspan="3" align="center"
					height="30">LAB
				</td>
				<td align="center" height="30">Mat</td>
				<td align="center" height="30">Che</td>
				<td align="center" height="30">Eng</td>
				<td align="center" height="30">Phy</td>
			</tr>
			<tr>
				<td align="center" height="30">
					<b>Saturday</b>
				</td>
				<td align="center" height="30">Eng</td>
				<td align="center" height="30">Che</td>
				<td align="center" height="30">Mat</td>
				<td colspan="3" align="center"
					height="30">SEMINAR
				</td>
				<td align="center" height="30">SPORTS</td>
			</tr>
		</table>
</body>
</html>
