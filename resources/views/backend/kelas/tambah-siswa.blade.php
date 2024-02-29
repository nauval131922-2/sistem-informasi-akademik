@extends('backend.main')

@section('content')
  <div class="page-content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-lg-10">
              <div class="card">
                  <div class="card-body">

                      <h4 class="card-title">Tambah Data Siswa {{ $kelas->nama }}</h4>
                      <p class="card-title-desc">Lengkapi form berikut untuk menambah data Siswa {{ $kelas->nama }}.</p>
                      <form action="{{ route('kelas-simpan-siswa', $kelas->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_kelas" value="{{ $kelas->id }}">
                        <div class="row mb-3">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Nama siswa" id="nama" name="nama">
                                <div class="mt-2">
                                    @error('nama')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Nomor Induk Siswa" id="nis" name="nis">
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
                                <input class="form-control" type="text" placeholder="Tempat lahir siswa" id="tempat_lahir" name="tempat_lahir">
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
                                <input class="form-control" type="date" value="{{ today()->format('Y-m-d') }}" id="tanggal_lahir" name="tanggal_lahir">
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
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <div class="mt-2">
                                    @error('jenis_kelamin')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="desa" class="col-sm-2 col-form-label">Desa</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Desa" id="desa" name="desa">
                                <div class="mt-2">
                                    @error('desa')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="rt" class="col-sm-2 col-form-label">RT</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="RT" id="rt" name="rt">
                                <div class="mt-2">
                                    @error('rt')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="rw" class="col-sm-2 col-form-label">RW</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="RW" id="rw" name="rw">
                                <div class="mt-2">
                                    @error('rw')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Kecamatan" id="kecamatan" name="kecamatan">
                                <div class="mt-2">
                                    @error('kecamatan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="kabupaten" class="col-sm-2 col-form-label">Kabupaten</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Kabupaten" id="kabupaten" name="kabupaten">
                                <div class="mt-2">
                                    @error('kabupaten')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nomor_hp" class="col-sm-2 col-form-label">Nomor HP</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Nomor HP" id="nomor_hp" name="nomor_hp">
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
                                <input class="form-control" type="text" placeholder="Nama Ayah Siswa" id="nama_ayah" name="nama_ayah">
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
                                <input class="form-control" type="text" placeholder="Nama Ibu Siswa" id="nama_ibu" name="nama_ibu">
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
                                <input class="form-control" type="text" placeholder="Asal sekolah Siswa" id="asal_sekolah" name="asal_sekolah">
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
                                <input class="form-control" type="date" value="{{ today()->format('Y-m-d') }}" id="tanggal_masuk" name="tanggal_masuk">
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
                                <img class="rounded avatar-lg" src="{{url('upload/no_image.jpg') }}" alt="Card image cap" id="showImage">
                            </div>
                        </div>

                        <input type="submit" value="Simpan" class="btn btn-info waves-effect waves-light">
                      </form>
                      
                  </div>
              </div>
          </div> <!-- end col -->
      </div>
    </div>
  </div>
@endsection