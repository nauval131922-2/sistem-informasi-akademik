@extends('backend.main')

@section('title')
    Dashboard | {{ $title }}
@endsection

@section('content')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}

    <?php
        // get route name
        $route = Route::currentRouteName();
    ?>
   
  <div class="page-content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-lg-10">
              <div class="card">
                  <div class="card-body">

                      <h4 class="card-title">{{ $title }}</h4>
                      <p class="card-title-desc">Lengkapi form berikut untuk menambah {{ $title }}.</p>
                      <form action="{{ route('nilai-simpan', $id_kelas) }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="siswa" class="col-sm-2 col-form-label">Siswa</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="siswa" name="siswa">
                                    <option value="">Pilih Siswa</option>
                                    @foreach ($semua_siswa as $siswa)
                                        @if (old('siswa') == $siswa->id)  
                                            <option value="{{ $siswa->id }}" selected>{{ $siswa->name }}</option>
                                        @else
                                            <option value="{{ $siswa->id }}">{{ $siswa->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="mt-2">
                                    @error('siswa')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                         <div class="row mb-3">
                            <label for="guru" class="col-sm-2 col-form-label">Guru</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="guru" name="guru">
                                    <option value="">Pilih Guru</option>
                                    @foreach ($semua_guru as $guru)
                                        @if (old('guru') == $guru->id)  
                                            <option value="{{ $guru->id }}" selected>{{ $guru->name }}</option>
                                        @else
                                            <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="mt-2">
                                    @error('guru')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="mapel" class="col-sm-2 col-form-label">Mata Pelajaran</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="mapel" name="mapel">
                                    <option value="">Pilih Mata Pelajaran</option>
                                    @foreach ($semua_mapel as $mapel)
                                        @if (old('mapel') == $mapel->id)  
                                            <option value="{{ $mapel->id }}" selected>{{ $mapel->mata_pelajaran }}</option>
                                        @else
                                            <option value="{{ $mapel->id }}">{{ $mapel->mata_pelajaran }}</option>
                                        @endif
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
                            <label for="nilai" class="col-sm-2 col-form-label">Nilai</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Masukkan Nilai" id="nilai" name="nilai">
                                <div class="mt-2">
                                    @error('nilai')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @if ($route == 'nilai-ulangan-harian-tambah')
                            <input type="hidden" name="tipe_nilai" value="Ulangan Harian">
                        @elseif ($route == 'nilai-tugas-tambah')
                            <input type="hidden" name="tipe_nilai" value="Tugas">
                        @elseif ($route == 'nilai-uts-tambah')
                            <input type="hidden" name="tipe_nilai" value="UTS">
                        @elseif ($route == 'nilai-uas-tambah')
                            <input type="hidden" name="tipe_nilai" value="UAS">
                        @endif
                        <input type="submit" value="Simpan" class="btn btn-info waves-effect waves-light">
                      </form>
                      
                  </div>
              </div>
          </div> <!-- end col -->
      </div>
    </div>
  </div>

@endsection