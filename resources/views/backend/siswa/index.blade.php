@extends('backend.main')

@section('title')
    Dashboard | {{ $title }}
@endsection

@section('content')
  <div class="page-content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12">
              <div class="card">
                  <div class="card-body">

                      <h4 class="card-title">Siswa</h4>
                      <p class="card-title-desc">Berikut adalah data para Siswa.
                      </p>

                      <a class="btn btn-primary mb-3" href="{{ route('user-tambah') }}" role="button">Tambah</a>

                      <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline collapsed" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable-buttons_info">
                          <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Kelas</th>
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
                                  <td>{{ $siswa->name }}</td>
                                  <td>{{ $siswa->kelas->nama }}</td>
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
                                    <a href="{{ route('siswa-edit', $siswa->id) }}" class="btn btn-info btn-sm">Edit</a>
                                    <a href="{{ route('siswa-hapus', $siswa->id) }}" class="btn btn-danger btn-sm" id="delete">Hapus</a>
                                  </td>
                              </tr>
                            @endforeach
                          </tbody>
                      </table>

                  </div>
              </div>
          </div> 
      </div>
    </div>
  </div>
@endsection