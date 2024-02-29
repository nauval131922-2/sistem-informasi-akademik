@extends('backend.main')

@section('content')
  <div class="page-content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12">
              <div class="card">
                  <div class="card-body">

                      <h4 class="card-title">Kelas</h4>
                      <p class="card-title-desc">Berikut adalah data kelas.
                      </p>

                      <a class="btn btn-primary mb-3" href="{{ route('kelas-tambah') }}" role="button">Tambah</a>

                      {{-- <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;"> --}}
                      <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline collapsed" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable-buttons_info">
                          <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($semua_kelas as $no => $kelas)
                              <tr>
                                  <td>{{ $no+1 }}</td>
                                  <td>{{ $kelas->nama }}</td>
                                  <td>
                                    <a href="{{ route('kelas-detail', $kelas->id) }}" class="btn btn-success btn-sm">Detail</a>
                                    <a href="{{ route('kelas-edit', $kelas->id) }}" class="btn btn-info btn-sm">Edit</a>
                                    <a href="{{ route('kelas-hapus', $kelas->id) }}" class="btn btn-danger btn-sm" id="delete">Hapus</a>
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