<?php
// get route name
$route = Route::currentRouteName();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <p class="card-title-desc" style="border-bottom: 1px solid rgb(161,179,191)">Lengkapi form
                berikut untuk mengubah {{ $title }}.</p>
            <form enctype="multipart/form-data" id="formUbahData" method="POST">
                @csrf

                {{-- id --}}
                <input type="hidden" name="id" id="id" value="{{ $nilai->id }}">



                @if ($nilai->tipe_nilai == 'Ulangan Harian')
                    {{-- old kompetensi dasar --}}
                    <input type="hidden" name="old_kompetensi_dasar" id="old_kompetensi_dasar"
                        value="{{ $nilai->kompetensi_dasar }}">



                    <div class="row mb-3">
                        <label for="kompetensi_dasar" class="col-md-2 col-form-label">Kompetensi Dasar</label>
                        <div class="col-md-10">
                            <select class="form-select" id="kompetensi_dasar" name="kompetensi_dasar" required>
                                <option value="">Pilih Kompetensi Dasar</option>
                                @foreach ($semua_kompetensi_dasar as $kompetensi_dasar)
                                    @if ($nilai->kompetensi_dasar == $kompetensi_dasar ?? old('kompetensi_dasar') == $kompetensi_dasar)
                                        <option value="{{ $kompetensi_dasar }}" selected>{{ $kompetensi_dasar }}
                                        </option>
                                    @else
                                        <option value="{{ $kompetensi_dasar }}">{{ $kompetensi_dasar }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <div class="mt-2">
                                <span class="text-danger error-text kompetensi_dasar_error"></span>
                            </div>
                        </div>
                    </div>

                    {{-- old judul --}}
                    <input type="hidden" name="old_judul" id="old_judul" value="{{ $nilai->judul }}">

                    <div class="row mb-3">
                        <label for="judul" class="col-md-2 col-form-label">Judul</label>
                        <div class="col-md-10">
                            <select class="form-select" id="judul" name="judul" required>
                                <option value="">Pilih Judul</option>
                                @foreach ($semua_judul as $judul)
                                    @if ($nilai->judul == $judul ?? old('judul') == $judul)
                                        <option value="{{ $judul }}" selected>{{ $judul }}
                                        </option>
                                    @else
                                        <option value="{{ $judul }}">{{ $judul }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <div class="mt-2">
                                <span class="text-danger error-text judul_error"></span>
                            </div>
                        </div>
                    </div>
                @elseif ($nilai->tipe_nilai == 'Ujian')
                    {{-- old judul --}}
                    <input type="hidden" name="old_judul" id="old_judul" value="{{ $nilai->judul }}">

                    <div class="row mb-3">
                        <label for="judul" class="col-md-2 col-form-label">Judul</label>
                        <div class="col-md-10">
                            <select class="form-select" id="judul" name="judul" required>
                                <option value="">Pilih Judul</option>
                                @foreach ($semua_judul_ujian as $judul)
                                    @if ($nilai->judul == $judul ?? old('judul') == $judul)
                                        <option value="{{ $judul }}" selected>{{ $judul }}
                                        </option>
                                    @else
                                        <option value="{{ $judul }}">{{ $judul }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <div class="mt-2">
                                <span class="text-danger error-text judul_error"></span>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- old judul --}}
                    <input type="hidden" name="old_judul" id="old_judul" value="{{ $nilai->judul }}">

                    <div class="row mb-3">
                        <label for="judul" class="col-md-2 col-form-label">Judul</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="judul" id="judul"
                                placeholder="Ubah judul {{ $title }}"
                                value="{{ old('judul') ?? $nilai->judul }}" required>
                            <div class="mt-2">
                                <span class="text-danger error-text judul_error"></span>
                            </div>
                        </div>
                    </div>
                @endif

                @if (Auth::user()->id_role == '1')
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
                                placeholder="Masukkan mata pelajaran" value="{{ $semua_mapel->mata_pelajaran }}"
                                required disabled>
                            <div class="mt-2">
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
                            <span class="text-danger error-text kelas_error"></span>
                        </div>
                    </div>
                </div>

                {{-- input tahun ajaran --}}
                <input class="form-control" type="hidden" placeholder="Masukkan Tahun Ajaran" id="old_tahun_ajaran"
                    name="old_tahun_ajaran" value="{{ $nilai->id_tahun_ajaran_for_nilai ?? old('tahun_ajaran') }}"
                    required>


                <p class="card-title-desc" style="border-bottom: 1px solid rgb(161,179,191)" id="judul-daftar-siswa">
                    Siswa
                </p>

                <div id="daftar-siswa">
                    {{-- old nilai --}}
                    <input type="hidden" name="old_nilai" id="old_nilai" value="{{ $nilai->nilai }}">

                    {{-- old siswa --}}
                    <input type="hidden" name="siswa" id="siswa" value="{{ $nilai->id_siswa_for_nilai }}">

                    <div class="row mb-3">
                        <label for="nilai" class="col-md-2 col-form-label">{{ $nama_siswa }}</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="nilai" id="nilai"
                                placeholder="Ubah nilai" value="{{ old('nilai') ?? $nilai->nilai }}" required>
                            <div class="invalid-feedback" style="background-image: none;">Nilai tidak boleh lebih dari
                                100</div>
                            <div class="mt-2">
                                <span class="text-danger error-text nilai_error"></span>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($nilai->tipe_nilai == 'Ulangan Harian')
                    <input type="hidden" name="tipe_nilai" id="tipe_nilaii" value="Ulangan Harian">
                @elseif ($nilai->tipe_nilai == 'Tugas')
                    <input type="hidden" name="tipe_nilai" id="tipe_nilaii" value="Tugas">
                @elseif ($nilai->tipe_nilai == 'UTS')
                    <input type="hidden" name="tipe_nilai" id="tipe_nilaii" value="UTS">
                @elseif ($nilai->tipe_nilai == 'UAS')
                    <input type="hidden" name="tipe_nilai" id="tipe_nilaii" value="UAS">
                @elseif ($nilai->tipe_nilai == 'Ujian')
                    <input type="hidden" name="tipe_nilai" id="tipe_nilaii" value="Ujian">
                @endif
                <button type="submit" class="btn btn-info waves-effect waves-light">
                    <i class="ri-refresh-line align-middle me-1"></i>
                    <span style="vertical-align: middle">Update</span>
                </button>
            </form>

        </div>
    </div>
</div> <!-- end col -->

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    $('#nilai').on('input', function() {
        var inputValue = $(this).val();
        if (inputValue > 100) {
            $(this).val(100);
            $(this).addClass('is-invalid');
            $(this).next('.invalid-feedback').text('Nilai tidak boleh lebih dari 100');
        } else {
            $(this).removeClass('is-invalid');
            $(this).next('.invalid-feedback').text('');
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
