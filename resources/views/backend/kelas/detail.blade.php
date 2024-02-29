@extends('backend.main')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Detail {{ $kelas->nama }}</h4>
                        <p class="card-title-desc">Berikut adalah detail {{ $kelas->nama }}.</p>

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#wali_kelas" role="tab" aria-selected="true">
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block">Wali Kelas</span>    
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#siswa" role="tab" aria-selected="true">
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block">Siswa</span>    
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#jadwal_pelajaran" role="tab" aria-selected="false">
                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                    <span class="d-none d-sm-block">Jadwal</span>    
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content p-3 text-muted">
                            <div class="tab-pane" id="wali_kelas" role="tabpanel">
                                <form action="{{ route('guru-update', $wali_kelas->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3 mt-3">
                                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" placeholder="Nama guru" id="nama" name="nama" value="{{ $wali_kelas->nama }}">
                                            <div class="mt-2">
                                                @error('nama')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" placeholder="NIP" id="nip" name="nip" value="{{ $wali_kelas->nip }}">
                                            <div class="mt-2">
                                                @error('nip')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" placeholder="Tempat lahir" id="tempat_lahir" name="tempat_lahir" value="{{ $wali_kelas->tempat_lahir }}">
                                            <div class="mt-2">
                                                @error('tempat_lahir')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="date" value="{{ today()->format('Y-m-d') }}" id="tanggal_lahir" name="tanggal_lahir" value="{{ $wali_kelas->tanggal_lahir }}">
                                            <div class="mt-2">
                                                @error('tanggal_lahir')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                        <div class="col-sm-10">
                                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                                <option value="Laki-laki" {{ $wali_kelas->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="Perempuan" {{ $wali_kelas->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                            <div class="mt-2">
                                                @error('jenis_kelamin')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" placeholder="Alamat" id="alamat" name="alamat" value="{{ $wali_kelas->alamat }}">
                                            <div class="mt-2">
                                                @error('alamat')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="nomor_hp" class="col-sm-2 col-form-label">Nomor HP</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" placeholder="Nomor HP" id="nomor_hp" name="nomor_hp" value="{{ $wali_kelas->nomor_hp }}">
                                            <div class="mt-2">
                                                @error('nomor_hp')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="image" class="col-sm-2 col-form-label">Foto</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="file" id="image" name="foto">
                                            <div class="mt-2">
                                                @error('foto')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="showImage" class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">
                                        <img src="
                                            @if($wali_kelas->foto)
                                            {{ asset($wali_kelas->foto) }}
                                            @else
                                            {{ asset('upload/no_image.jpg') }}
                                            @endif"
                                        alt="{{ $wali_kelas->nama }}" class="img-thumbnail" width="100" id="showImage">
                                        </div>
                                    </div>

                                    <input type="submit" value="Update" class="btn btn-info waves-effect waves-light">
                                </form>
                            </div>
                            
                            <div class="tab-pane active" id="siswa" role="tabpanel">
                                <a class="btn btn-primary mb-3" href="{{ route('kelas-tambah-siswa', $kelas->id) }}" role="button">Tambah</a>

                                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline collapsed" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable-buttons_info">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>NIS</th>
                                            <th>Tempat Lahir</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Alamat</th>
                                            <th>Nomor HP</th>
                                            <th>Nama Ayah</th>
                                            <th>Nama Ibu</th>
                                            <th>Asal Sekolah</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Foto</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($semua_siswa as $no => $siswa)
                                        <tr>
                                            <td>{{ $no+1 }}</td>
                                            <td>{{ $siswa->nama }}</td>
                                            <td>{{ $siswa->nis }}</td>
                                            <td>{{ $siswa->tempat_lahir }}</td>
                                            <td>{{ $siswa->tanggal_lahir }}</td>
                                            <td>{{ $siswa->jenis_kelamin }}</td>
                                            <td>{{ $siswa->alamat }}</td>
                                            <td>{{ $siswa->nomor_hp }}</td>
                                            <td>{{ $siswa->nama_ayah }}</td>
                                            <td>{{ $siswa->nama_ibu }}</td>
                                            <td>{{ $siswa->asal_sekolah }}</td>
                                            <td>{{ $siswa->tanggal_masuk }}</td>
                                            <td>
                                                <img src="{{ asset($siswa->foto) }}" alt="{{ $siswa->nama }}" width="100px">
                                            </td>
                                            <td>
                                                <a href="{{ route('kelas-edit-siswa', [$kelas->id, $siswa->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="{{ route('kelas-hapus-siswa', [$kelas->id, $siswa->id]) }}" class="btn btn-danger btn-sm" id="delete">Hapus</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="tab-pane" id="jadwal_pelajaran" role="tabpanel">
                                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline collapsed" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable-buttons_info">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Senin</th>
                                            <th>Selasa</th>
                                            <th>Rabu</th>
                                            <th>Kamis</th>
                                            <th>Jumat</th>
                                            <th>Sabtu</th>
                                            <th>Minggu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jadwal_pelajaran as $no => $jadwal)
                                        <tr>
                                            <td>{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                                           <td>
                                                @if($jadwal->hari == 'Senin')
                                                    {{ $jadwal->mapel->mata_pelajaran }}
                                                @endif
                                           </td>
                                           <td>
                                                @if($jadwal->hari == 'Selasa')
                                                    {{ $jadwal->mapel->mata_pelajaran }}
                                                @endif
                                           </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline collapsed" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable-buttons_info">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Hari</th>
                                            <th>Kelas</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Guru</th>
                                            <th>Jam Mulai</th>
                                            <th>Jam Selesai</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jadwal_pelajaran as $no => $jadwal)
                                        <tr>
                                            <td>{{ $no+1 }}</td>
                                            <td>{{ $jadwal->hari }}</td>
                                            <td>{{ $jadwal->kelas->nama }}</td>
                                            <td>{{ $jadwal->mapel->mata_pelajaran }}</td>
                                            <td>{{ $jadwal->guru->nama }}</td>
                                            <td>{{ $jadwal->jam_mulai }}</td>
                                            <td>{{ $jadwal->jam_selesai }}</td>
                                            <td>
                                                <a href="{{ route('jadwal-pelajaran-edit', $jadwal->id) }}" class="btn btn-info btn-sm">Edit</a>
                                                <a href="{{ route('jadwal-pelajaran-hapus', $jadwal->id) }}" class="btn btn-danger btn-sm" id="delete">Hapus</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection