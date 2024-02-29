@extends('backend.main')

@section('content')
  <div class="page-content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-lg-10">
              <div class="card">
                  <div class="card-body">

                      <h4 class="card-title">Edit Data Siswa</h4>
                      <p class="card-title-desc">Lengkapi form berikut untuk mengubah data Siswa.</p>
                      <form action="{{ route('siswa-update', $siswa->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Nama siswa" id="nama" name="nama" value="{{ $siswa->nama }}">
                                <div class="mt-2">
                                    @error('nama')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="kelas" name="kelas">
                                    <option value="">Pilih Kelas</option>
                                    @foreach ($semua_kelas as $kelas)
                                        <option value="{{ $kelas->id }}" {{ $kelas->id == $siswa->id_kelas ? 'selected' : '' }}>{{ $kelas->nama }}</option>
                                    @endforeach
                                </select>
                                <div class="mt-2">
                                    @error('kelas')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Nomor Induk Siswa" id="nis" name="nis" value="{{ $siswa->nis }}">
                                <div class="mt-2">
                                    @error('nis')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Tempat lahir siswa" id="tempat_lahir" name="tempat_lahir" value="{{ $siswa->tempat_lahir }}">
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
                                <input class="form-control" type="date" value="{{ $siswa->tanggal_lahir }}" id="tanggal_lahir" name="tanggal_lahir">
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
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ $siswa->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ $siswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
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
                                <input class="form-control" type="text" placeholder="Alamat" id="alamat" name="alamat" value="{{ $siswa->alamat }}">
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
                                <input class="form-control" type="text" placeholder="Nomor HP" id="nomor_hp" name="nomor_hp" value="{{ $siswa->nomor_hp }}">
                                <div class="mt-2">
                                    @error('nomor_hp')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nama_ayah" class="col-sm-2 col-form-label">Nama Ayah</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Nama Ayah Siswa" id="nama_ayah" name="nama_ayah" value="{{ $siswa->nama_ayah }}">
                                <div class="mt-2">
                                    @error('nama_ayah')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nama_ibu" class="col-sm-2 col-form-label">Nama Ibu</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Nama Ibu Siswa" id="nama_ibu" name="nama_ibu" value="{{ $siswa->nama_ibu }}">
                                <div class="mt-2">
                                    @error('nama_ibu')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="asal_sekolah" class="col-sm-2 col-form-label">Asal Sekolah</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Asal sekolah Siswa" id="asal_sekolah" name="asal_sekolah" value="{{ $siswa->asal_sekolah }}">
                                <div class="mt-2">
                                    @error('asal_sekolah')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tanggal_masuk" class="col-sm-2 col-form-label">Tanggal Masuk</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="date" value="{{ $siswa->tanggal_masuk }}" id="tanggal_masuk" name="tanggal_masuk">
                                <div class="mt-2">
                                    @error('tanggal_masuk')
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
                                @if($siswa->foto)
                                  {{ asset($siswa->foto) }}
                                @else
                                  {{ asset('upload/no_image.jpg') }}
                                @endif"
                              alt="{{ $siswa->nama }}" class="img-thumbnail" width="100" id="showImage">
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