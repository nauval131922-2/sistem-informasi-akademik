@extends('backend.main')

@section('content')
  <div class="page-content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-lg-8">
              <div class="card">
                  <div class="card-body">

                      <h4 class="card-title">Ubah Data Jabatan</h4>
                      <p class="card-title-desc">Lengkapi form berikut untuk mengubah data jabatan.</p>
                      <form action="{{ route('jabatan-update', $jabatan->id) }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Nama jabatan" id="nama" name="nama" value="{{ $jabatan->nama }}">
                                <div class="mt-2">
                                    @error('nama')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <input type="submit" value="Update" class="btn btn-info waves-effect waves-light">
                      </form>
                      
                  </div>
              </div>
          </div> <!-- end col -->
      </div>
    </div>
  </div>
@endsection