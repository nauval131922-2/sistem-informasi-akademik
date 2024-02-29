{{-- @extends('backend.main')

@section('title')
    Dashboard | Ubah {{ $title }}
@endsection

@section('content') --}}

<?php
// get route name
$route = Route::currentRouteName();
?>

{{-- <div class="page-content"> --}}
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            {{-- <div class="card">
                        <div class="card-body"> --}}



            {{-- @if ($nilai->tipe_nilai == 'Ulangan Harian')
                                <a href="{{ route('nilai-ulangan-harian-index-kelas', $id_kelas) }}"
                                    class="btn btn-light mb-3"
                                    style="
                                float: right;
                                border-color: rgb(37,43,59);
                            ">
                            <i class="ri-arrow-go-back-line align-middle me-1"></i>
                            <span style="vertical-align: middle">Back to List</span>    
                        </a>
                            @elseif ($nilai->tipe_nilai == 'Tugas')
                                <a href="{{ route('nilai-tugas-index-kelas', $id_kelas) }}" class="btn btn-light mb-3"
                                    style="
                                float: right;
                                border-color: rgb(37,43,59);
                            ">
                            <i class="ri-arrow-go-back-line align-middle me-1"></i>
                            <span style="vertical-align: middle">Back to List</span>    
                        </a>
                            @elseif ($nilai->tipe_nilai == 'UTS')
                                <a href="{{ route('nilai-uts-index-kelas', $id_kelas) }}" class="btn btn-light mb-3"
                                    style="
                                float: right;
                                border-color: rgb(37,43,59);
                            ">
                            <i class="ri-arrow-go-back-line align-middle me-1"></i>
                            <span style="vertical-align: middle">Back to List</span>    
                        </a>
                            @elseif ($nilai->tipe_nilai == 'UAS')
                                <a href="{{ route('nilai-uas-index-kelas', $id_kelas) }}" class="btn btn-light mb-3"
                                    style="
                                float: right;
                                border-color: rgb(37,43,59);
                            ">
                            <i class="ri-arrow-go-back-line align-middle me-1"></i>
                            <span style="vertical-align: middle">Back to List</span>    
                        </a>
                            @endif

                            <h4 class="card-title">Ubah {{ $title }}</h4> --}}
            <p class="card-title-desc" style="border-bottom: 1px solid rgb(161,179,191)">Lengkapi form
                berikut untuk mengubah {{ $title }}.</p>
            {{-- <form action="{{ route('nilai-update', $nilai->id) }}" method="POST"> --}}
            <form enctype="multipart/form-data" id="formUbahData" method="POST">
                @csrf

                {{-- id --}}
                <input type="hidden" name="id" id="id" value="{{ $nilai->id }}">

                {{-- old judul --}}
                <input type="hidden" name="old_judul" id="old_judul" value="{{ $nilai->judul }}">



                <div class="row mb-3">
                    <label for="judul" class="col-md-2 col-form-label">Judul</label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" name="judul" id="judul"
                            placeholder="Ubah judul {{ $title }}" value="{{ old('judul') ?? $nilai->judul }}"
                            required>
                        <div class="mt-2">
                            {{-- @error('judul')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror --}}
                            <span class="text-danger error-text judul_error"></span>
                        </div>
                    </div>
                </div>

                @if (Auth::user()->id_role == '1' || Auth::user()->id_role == '2')
                    {{-- old guru --}}
                    <input type="hidden" name="old_guru" id="old_guru" value="{{ $nilai->id_guru_for_nilai }}">

                    <div class="row mb-3">
                        <label for="guru" class="col-sm-2 col-form-label">Guru</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="guru" name="guru" required>
                                <option value="">Pilih Guru</option>
                                @foreach ($semua_guru as $guru)
                                    @if ($nilai->id_guru_for_nilai == $guru->id ?? old('guru') == $guru->id)
                                        <option value="{{ $guru->id }}" selected>{{ $guru->name }}
                                        </option>
                                    @else
                                        <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <div class="mt-2">
                                {{-- @error('guru')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                                <span class="text-danger error-text guru_error"></span>
                            </div>
                        </div>
                    </div>
                @else
                    <input type="hidden" name="old_guru" id="old_guru" value="{{ Auth::user()->id }}">

                    {{-- input hidden guru --}}
                    <input type="hidden" name="guru" id="guru" value="{{ Auth::user()->id }}">
                @endif

                {{-- old mapel --}}
                <input type="hidden" name="old_mapel" id="old_mapel" value="{{ $nilai->id_mapel_for_nilai }}">

                @if (Auth::user()->id_role == '1' || Auth::user()->id_role == '2' || Auth::user()->id_role == '3')
                    <div class="row mb-3">
                        <label for="mapel" class="col-sm-2 col-form-label">Mata Pelajaran</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="mapel" name="mapel" required>
                                <option value="">Pilih Mata Pelajaran</option>
                                @foreach ($semua_mapel as $mapel)
                                    @if ($nilai->id_mapel_for_nilai == $mapel->id ?? old('mapel') == $mapel->id)
                                        <option value="{{ $mapel->id }}" selected>
                                            {{ $mapel->mata_pelajaran }}</option>
                                    @else
                                        <option value="{{ $mapel->id }}">{{ $mapel->mata_pelajaran }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <div class="mt-2">
                                {{-- @error('mapel')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                                <span class="text-danger error-text mapel_error"></span>
                            </div>
                        </div>
                    </div>
                @elseif (Auth::user()->id_role == '4')
                    {{-- dsiable form mapel, buat textbox saja, jangan pake select --}}
                    <div class="row mb-3">
                        <label for="mapell" class="col-md-2 col-form-label">Mata Pelajaran</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="mapell" id="mapell"
                                placeholder="Masukkan mata pelajaran" value="{{ $semua_mapel->mata_pelajaran }}" required disabled>
                            <div class="mt-2">
                                {{-- @error('mapel')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                                <span class="text-danger error-text mapell_error"></span>
                            </div>
                        </div>
                    </div>
                    
                    {{-- id_mapel --}}
                    <input type="hidden" name="mapel" id="mapel" value="{{ $semua_mapel->id }}">
                @endif

                {{-- old kelas --}}
                <input type="hidden" name="old_kelas" id="old_kelas" value="{{ $nilai->id_kelas_for_nilai }}">

                {{-- kelas --}}
                <div class="row mb-3">
                    <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="kelass" name="kelas" required>
                            <option value="">Pilih Kelas</option>
                            @foreach ($semua_kelas as $kelas)
                                @if ($nilai->id_kelas_for_nilai == $kelas->id ?? old('kelas') == $kelas->id)
                                    <option value="{{ $kelas->id }}" selected>{{ $kelas->nama }}
                                    </option>
                                @else
                                    <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="mt-2">
                            {{-- @error('kelas')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror --}}
                            <span class="text-danger error-text kelas_error"></span>
                        </div>
                    </div>
                </div>

                {{-- input tahun ajaran --}}
                <input class="form-control" type="hidden" placeholder="Masukkan Tahun Ajaran" id="old_tahun_ajaran"
                    name="old_tahun_ajaran" value="{{ $nilai->id_tahun_ajaran_for_nilai ?? old('tahun_ajaran') }}"
                    required>

                {{-- <div class="row mb-3">
                    <label for="siswa" class="col-sm-2 col-form-label">Siswa</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" placeholder="Masukkan Nama Siswa" id="siswa"
                            name="siswa" value="{{ $nilai->siswa->name }}" disabled>
                        <div class="mt-2">
                            @error('siswa')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="nilai" class="col-sm-2 col-form-label">Nilai</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" placeholder="Masukkan Nilai" id="nilai"
                            name="nilai" value="{{ $nilai->nilai ?? old('nilai') }}" required>
                        <div class="mt-2">
                            @error('nilai')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div> --}}

                <p class="card-title-desc" style="border-bottom: 1px solid rgb(161,179,191)" id="judul-daftar-siswa">
                    Daftar Siswa
                </p>

                <div id="daftar-siswa">
                    {{-- @foreach ($semua_siswa as $no => $siswa)
                        <div class="row mb-3">
                            <label for="nilai{{ $no + 1 }}"
                                class="col-md-2 col-form-label">{{ $siswa->siswa->name }}</label>
                            <input type="hidden" name="siswa{{ $no + 1 }}" value="{{ $siswa->id }}" required
                                id="siswa{{ $no + 1 }}">
                            <div class="col-md-10">
                                <input class="form-control" type="number" name="nilai{{ $no + 1 }}"
                                    id="nilai{{ $no + 1 }}" required placeholder="Masukkan nilai siswa"
                                    value="{{ $siswa->nilai ?? old('nilai' . ($no + 1)) }}">
                                <div class="mt-2">
                                    @error('nilai')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @endforeach --}}
                </div>

                @if ($nilai->tipe_nilai == 'Ulangan Harian')
                    <input type="hidden" name="tipe_nilai" id="tipe_nilaii" value="Ulangan Harian">
                @elseif ($nilai->tipe_nilai == 'Tugas')
                    <input type="hidden" name="tipe_nilai" id="tipe_nilaii" value="Tugas">
                @elseif ($nilai->tipe_nilai == 'UTS')
                    <input type="hidden" name="tipe_nilai" id="tipe_nilaii" value="UTS">
                @elseif ($nilai->tipe_nilai == 'UAS')
                    <input type="hidden" name="tipe_nilai" id="tipe_nilaii" value="UAS">
                @endif
                {{-- <input type="submit" value="Update" class="btn btn-info waves-effect waves-light"> --}}
                <button type="submit" class="btn btn-info waves-effect waves-light">
                    <i class="ri-refresh-line align-middle me-1"></i>
                    <span style="vertical-align: middle">Update</span>
                </button>
            </form>

        </div>
    </div>
</div> <!-- end col -->
{{-- </div>
</div>
</div>
@endsection --}}

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var id = $('#id').val();
        var judul = $('#old_judul').val();
        var guru = $('#old_guru').val();
        var mapel = $('#old_mapel').val();
        var kelas = $('#kelass').val();
        var tipe_nilai = $('#tipe_nilaii').val();
        var tahun_ajaran = $('#old_tahun_ajaran').val();

        // var kelas = $('#kelass').val();
        if (kelas != '') {
            $.ajax({
                url: '/get-data-siswa?id=' + id + '&old_judul=' + judul + '&old_guru=' + guru +
                    '&old_mapel=' + mapel +
                    '&kelas=' + kelas + '&tipe_nilaii=' + tipe_nilai + '&old_tahun_ajaran=' + tahun_ajaran,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#judul-daftar-siswa').html('Daftar Siswa ' + data.kelas);
                    var siswa_html = '';
                    var siswa_html = '';
                    $.each(data.siswa, function(index, siswa) {
                        siswa_html += '<div class="row mb-3">';
                        siswa_html += '<label for="nilai' + (index + 1) +
                            '" class="col-md-2 col-form-label">' + siswa.name + '</label>';
                        siswa_html += '<input type="hidden" name="siswa' + (index + 1) +
                            '" value="' + siswa.id + '" required id="siswa' + (index + 1) +
                            '">';
                        siswa_html += '<div class="col-md-10">';
                        siswa_html +=
                            '<input class="form-control" type="number" name="nilai' + (
                                index + 1) + '" id="nilai' + (index + 1) +
                            '" required placeholder="Masukkan nilai siswa" value="' + (data
                                .nilai ? data.nilai[index] : '') + '">';
                        siswa_html += '</div>'; // tambahkan tag penutup div
                        siswa_html += '</div>'; // tambahkan tag penutup div
                        // tambah input id nilai
                        siswa_html += '<input type="hidden" name="id_nilai' + (index + 1) +
                            '" value="' + (data.id_nilai ? data.id_nilai[index] : '') +
                            '"  id="id_nilai' + (index + 1) +
                            '">';

                    });

                    $('#daftar-siswa').html(siswa_html);
                }
            });
        } else {
            $('#judul-daftar-siswa').html('Daftar Siswa');
            $('#daftar-siswa').html('');
        }

    });

    $('#kelass').change(function() {
        var id = $('#id').val();
        var judul = $('#old_judul').val();
        var guru = $('#old_guru').val();
        var mapel = $('#old_mapel').val();
        var kelas = $('#kelass').val();
        var tipe_nilai = $('#tipe_nilaii').val();
        var tahun_ajaran = $('#old_tahun_ajaran').val();

        // var kelas = $('#kelass').val();
        if (kelas != '') {
            $.ajax({
                url: '/get-data-siswa?id=' + id + '&old_judul=' + judul + '&old_guru=' + guru +
                    '&old_mapel=' + mapel +
                    '&kelas=' + kelas + '&tipe_nilaii=' + tipe_nilai + '&old_tahun_ajaran=' + tahun_ajaran,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#judul-daftar-siswa').html('Daftar Siswa ' + data.kelas);
                    var siswa_html = '';
                    var siswa_html = '';
                    $.each(data.siswa, function(index, siswa) {
                        siswa_html += '<div class="row mb-3">';
                        siswa_html += '<label for="nilai' + (index + 1) +
                            '" class="col-md-2 col-form-label">' + siswa.name + '</label>';
                        siswa_html += '<input type="hidden" name="siswa' + (index + 1) +
                            '" value="' + siswa.id + '" required id="siswa' + (index + 1) +
                            '">';
                        siswa_html += '<div class="col-md-10">';
                        siswa_html +=
                            '<input class="form-control" type="number" name="nilai' + (
                                index + 1) + '" id="nilai' + (index + 1) +
                            '" required placeholder="Masukkan nilai siswa" value="' + (data
                                .nilai ? data.nilai[index] : '') + '">';
                        siswa_html += '</div>'; // tambahkan tag penutup div
                        siswa_html += '</div>'; // tambahkan tag penutup div
                        // tambah input id nilai
                        siswa_html += '<input type="hidden" name="id_nilai' + (index + 1) +
                            '" value="' + (data.id_nilai ? data.id_nilai[index] : '') +
                            '"  id="id_nilai' + (index + 1) +
                            '">';

                    });

                    $('#daftar-siswa').html(siswa_html);
                }
            });
        } else {
            $('#judul-daftar-siswa').html('Daftar Siswa');
            $('#daftar-siswa').html('');
        }
    });

    $('#formUbahData').on('submit', function(e) {
        e.preventDefault();

        var id = {{ $nilai->id }};
        let formData = new FormData($('#formUbahData')[0]);
        $.ajax({
            url: '/data-nilai/update/' + id,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $(document).find('span.error-text').text('');
            },
            success: function(response) {

                if (response.status == 'error') {
                    $.each(response.message, function(prefix, val) {
                        $('span.' + prefix + '_error').text(val[0]);
                    });
                } else if (response.status == 'error2' || response.status == 'error3') {
                    toastr.warning(response.message, "", {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "100",
                        "hideDuration": "100",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    });
                } else {

                    // toastr success message
                    toastr.success(response.message, "", {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "100",
                        "hideDuration": "100",
                        "timeOut": "1500",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    });

                    // hide modal
                    $('#exampleModalScrollable').modal('hide');

                    // fetch data
                    filterData();
                }
            }
        })

    })
</script>
