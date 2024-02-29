@extends('backend.main')

@section('content')
  <div class="page-content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12">
              <div class="card">
                  <div class="card-body">

                      <h4 class="card-title">User Role</h4>
                      <p class="card-title-desc">Berikut adalah data user role.
                      </p>

                      <a class="btn btn-primary mb-3" href="{{ route('jabatan-tambah') }}" role="button">Tambah</a>

                      <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline collapsed" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid" aria-describedby="datatable-buttons_info">
                          <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nama Role</th>
                                <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($semua_jabatan as $jabatan)
                              <tr>
                                  <td>{{ $jabatan->id }}</td>
                                  <td>{{ $jabatan->nama }}</td>
                                  <td>
                                    <a href="{{ route('jabatan-edit', $jabatan->id) }}" class="btn btn-info btn-sm">Edit</a>
                                    <a href="{{ route('jabatan-hapus', $jabatan->id) }}" class="btn btn-danger btn-sm" id="delete">Hapus</a>
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