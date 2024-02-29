@extends('backend.main')

@section('title')
    Dashboard | {{ $title }}
@endsection

@section('content')
  <div class="page-content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-8">
              <div class="card">
                  <div class="card-body">

                      <h4 class="card-title">Galeri</h4>
                      <p class="card-title-desc">Berikut adalah data galeri.
                      </p>

                      <a class="btn btn-primary mb-3" href="{{ route('galeri-tambah') }}" role="button">Tambah</a>

                      <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline collapsed" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable-buttons_info">
                          <thead>
                            <tr>
                                <th>#</th>
                                <th>Judul</th>
                                <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($semua_galeri as $no => $galeri)
                              <tr>
                                  <td>{{ $no+1 }}</td>
                                  <td>{{ $galeri->judul }}</td>
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