@extends('backend.main')

@section('title')
    Dashboard | {{ $title }}
@endsection

@section('content')

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

                        {{-- tambah tombol back to list --}}
                        {{-- <a href="{{ route('nilai-ulangan-harian-index-kelas', $id_kelas) }}" class="btn btn-light mb-3" style="
                            /* taruh di samping kanan */
                            float: right;
                            /* background-color lebih muda lagi */
                            /* background-color: rgb(37,43,59); */
                            border-color: rgb(37,43,59);
                        ">Back to List</a> --}}

                      <h4 class="card-title">{{ $title }}</h4>
                      <p class="card-title-desc" style="border-bottom: 1px solid rgb(161,179,191)">Lengkapi form berikut untuk mengubah {{ $title }}.</p>
                      <form action="{{ route('nilai-update', $nilai->id) }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="siswa" class="col-sm-2 col-form-label">Siswa</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="siswa" name="siswa">
                                    <option value="">Pilih Siswa</option>
                                    @foreach ($semua_siswa as $siswa)
                                        @if ($nilai->id_siswa_for_nilai == $siswa->id)  
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

                        @if (Auth::user()->id_role == '1' || Auth::user()->id_role == '2')
                            <div class="row mb-3">
                                <label for="guru" class="col-sm-2 col-form-label">Guru</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="guru" name="guru">
                                        <option value="">Pilih Guru</option>
                                        @foreach ($semua_guru as $guru)
                                            @if ($nilai->id_guru_for_nilai == $guru->id)  
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
                        @endif

                        <div class="row mb-3">
                            <label for="mapel" class="col-sm-2 col-form-label">Mata Pelajaran</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="mapel" name="mapel">
                                    <option value="">Pilih Mata Pelajaran</option>
                                    @foreach ($semua_mapel as $mapel)
                                        @if ($nilai->id_mapel_for_nilai == $mapel->id)  
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
                                <input class="form-control" type="text" placeholder="Masukkan Nilai" id="nilai" name="nilai" value="{{ $nilai->nilai }}">
                                <div class="mt-2">
                                    @error('nilai')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @if ($nilai->tipe_nilai == 'Ulangan Harian')
                            <input type="hidden" name="tipe_nilai" value="Ulangan Harian">
                        @elseif ($nilai->tipe_nilai == 'Tugas')
                            <input type="hidden" name="tipe_nilai" value="Tugas">
                        @elseif ($nilai->tipe_nilai == 'UTS')
                            <input type="hidden" name="tipe_nilai" value="UTS">
                        @elseif ($nilai->tipe_nilai == 'UAS')
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