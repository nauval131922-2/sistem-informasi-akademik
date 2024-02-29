@extends('backend.main')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <div class="page-content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-lg-10">
              <div class="card">
                  <div class="card-body">

                      <h4 class="card-title">Tambah Data Guru</h4>
                      <p class="card-title-desc">Lengkapi form berikut untuk menambah data Guru.</p>
                      <form action="{{ route('guru-simpan') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Nama guru" id="nama" name="nama">
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
                                <input class="form-control" type="text" placeholder="NIP" id="nip" name="nip">
                                <div class="mt-2">
                                    @error('nip')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="jabatan" name="jabatan">
                                    <option value="">Pilih Jabatan</option>
                                    @foreach ($semua_jabatan as $jabatan)
                                        <option value="{{ $jabatan->id }}">{{ $jabatan->nama }}</option>
                                    @endforeach
                                </select>
                                <div class="mt-2">
                                    @error('jabatan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3" id="kelass">
                            <label for="jabatan" class="col-sm-2 col-form-label">Kelas</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="kelas" name="kelas">
                                    <option value="">Pilih Kelas</option>
                                    @foreach ($semua_kelas as $kelas)
                                        <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                                    @endforeach
                                </select>
                                <div class="mt-2">
                                    @error('kelas')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3" id="mapell">
                            <label for="jabatan" class="col-sm-2 col-form-label">Mata Pelajaran</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="mapel" name="mapel">
                                    <option value="">Pilih Mata Pelajaran</option>
                                    @foreach ($semua_mapel as $mapel)
                                        <option value="{{ $mapel->id }}">{{ $mapel->mata_pelajaran }}</option>
                                    @endforeach
                                </select>
                                <div class="mt-2">
                                    @error('mapel')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Tempat lahir" id="tempat_lahir" name="tempat_lahir">
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
                                    <option value="">Pilih Jenis Kelamin</option>
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

  <script>
    $(document).ready(function(){
        $('#kelass').hide();
        $('#mapell').hide();
        
        $('#jabatan').change(function(){
            if($(this).val() == '2'){
                $('#kelass').show();
                $('#mapell').hide();
            }else if($(this).val() == '3'){
                $('#kelass').hide();
                $('#mapell').show();
            }else{
                $('#kelass').hide();
                $('#mapell').hide();
            }
        });
    });
  </script>

@endsection