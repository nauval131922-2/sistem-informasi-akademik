@extends('backend.main')

@section('content')
  <div class="page-content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-lg-8">
              <div class="card">
                  <div class="card-body">

                      <h4 class="card-title">Ubah Data Guru</h4>
                      <p class="card-title-desc">Lengkapi form berikut untuk mengubah data mata Guru.</p>
                      <form action="{{ route('guru-update', $guru->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Nama guru" id="nama" name="nama" value="{{ $guru->nama }}">
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
                                <input class="form-control" type="text" placeholder="NIP" id="nip" name="nip" value="{{ $guru->nip }}">
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
                                <input class="form-control" type="text" placeholder="Tempat lahir" id="tempat_lahir" name="tempat_lahir" value="{{ $guru->tempat_lahir }}">
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
                                <input class="form-control" type="date" value="{{ today()->format('Y-m-d') }}" id="tanggal_lahir" name="tanggal_lahir" value="{{ $guru->tanggal_lahir }}">
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
                                    <option value="Laki-laki" {{ $guru->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ $guru->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
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
                                <input class="form-control" type="text" placeholder="Alamat" id="alamat" name="alamat" value="{{ $guru->alamat }}">
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
                                <input class="form-control" type="text" placeholder="Nomor HP" id="nomor_hp" name="nomor_hp" value="{{ $guru->nomor_hp }}">
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
                                @if($guru->foto)
                                  {{ asset($guru->foto) }}
                                @else
                                  {{ asset('upload/no_image.jpg') }}
                                @endif"
                              alt="{{ $guru->nama }}" class="img-thumbnail" width="100" id="showImage">
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