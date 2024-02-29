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

                      <h4 class="card-title">Guru</h4>
                      <p class="card-title-desc">Berikut adalah data para Guru.
                      </p>

                      <a class="btn btn-primary mb-3" href="{{ route('user-tambah') }}" role="button">Tambah</a>

                      <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline collapsed" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable-buttons_info">
                          <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Jabatan</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Nomor HP</th>
                                <th>Foto</th>
                                <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($semua_user as $no => $user)
                              <tr>
                                  <td>{{ $no+1 }}</td>
                                  <td>{{ $user->name }}</td>
                                  <td>{{ $user->nip }}</td>
                                  <td>
                                    @if (!empty($user->id_kelas))
                                      Guru Wali {{ $user->kelas->nama }}
                                    @elseif (!empty($user->id_mapel))
                                      Guru Mata Pelajaran {{ $user->mapel->mata_pelajaran }}
                                    @elseif ($user->id_jabatan == 1)
                                      Kepala Sekolah
                                    @endif
                                  </td>
                                  <td>{{ $user->tempat_lahir }}</td>
                                  <td>{{ $user->tanggal_lahir }}</td>
                                  <td>{{ $user->jenis_kelamin }}</td>
                                  <td>{{ $user->alamat }}</td>
                                  <td>{{ $user->nomor_hp }}</td>
                                  <td>
                                    @if (!empty($user->foto))
                                      <img src="{{ asset($user->foto) }}" alt="{{ $user->nama }}" width="100">
                                    @else
                                      <img src="{{ asset('upload/no_image.jpg') }}" alt="{{ $user->nama }}" width="100">
                                    @endif
                                  </td>
                                  <td>
                                    <a href="" class="btn btn-info btn-sm">Edit</a>
                                    <a href="" class="btn btn-danger btn-sm" id="delete">Hapus</a>
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