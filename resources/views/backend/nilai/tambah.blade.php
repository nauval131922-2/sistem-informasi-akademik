<?php
$route = Route::currentRouteName();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-121">

            <p class="card-title-desc" style="border-bottom: 1px solid rgb(161,179,191)">Lengkapi form
                berikut untuk menambah {{ $title }}.</p>
            <form enctype="multipart/form-data" id="formTambahData" method="POST">
                @csrf

                @if ($route == 'nilai-ulangan-harian-tambah')
                    <div class="row mb-3">
                        <label for="kompetensi_dasar" class="col-md-2 col-form-label">Kompetensi Dasar</label>
                        <div class="col-md-10">
                            <select class="form-select" id="kompetensi_dasar" name="kompetensi_dasar" required>
                                <option value="">Pilih Kompetensi Dasar</option>
                                @foreach ($semua_kompetensi_dasar as $kompetensi_dasar)
                                    @if (old('kompetensi_dasar') == $kompetensi_dasar)
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
                    <div class="row mb-3">
                        <label for="judul" class="col-md-2 col-form-label">Judul</label>
                        <div class="col-md-10">
                            <select class="form-select" id="judul" name="judul" required>
                                <option value="">Pilih Judul</option>
                                @foreach ($semua_judul as $judul)
                                    @if (old('judul') == $judul)
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
                @elseif ($route == 'nilai-ujian-tambah')
                    <div class="row mb-3">
                        <label for="judul" class="col-md-2 col-form-label">Judul</label>
                        <div class="col-md-10">
                            <select class="form-select" id="judul" name="judul" required>
                                <option value="">Pilih Judul</option>
                                @foreach ($semua_judul as $judul)
                                    @if (old('judul') == $judul)
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
                    <div class="row mb-3">
                        <label for="judul" class="col-md-2 col-form-label">Judul</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" name="judul" id="judul"
                                placeholder="Masukkan judul {{ $title }}" value="{{ old('judul') }}" required>
                            <div class="mt-2">
                                <span class="text-danger error-text judul_error"></span>
                            </div>
                        </div>
                    </div>
                @endif


                @if (Auth::user()->id_role == '1')
                    <div class="row mb-3">
                        <label for="guru" class="col-md-2 col-form-label">Guru</label>
                        <div class="col-md-10">
                            <select class="form-select" id="guru" name="guru" required>
                                <option value="">Pilih Guru</option>
                                @foreach ($semua_guru as $guru)
                                    @if (old('guru') == $guru->id)
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
                    <input type="hidden" name="guru" value="{{ Auth::user()->id }}">
                @endif

                @if (Auth::user()->id_role == '1' || Auth::user()->id_role == '2' || Auth::user()->id_role == '3')
                    <div class="row mb-3">
                        <label for="mapel" class="col-md-2 col-form-label">Mata Pelajaran</label>
                        <div class="col-md-10">
                            <select class="form-select" id="mapel" name="mapel" required>
                                <option value="">Pilih Mata Pelajaran</option>
                                @foreach ($semua_mapel as $mapel)
                                    @if (old('mapel') == $mapel->id)
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

                {{-- kelas --}}
                {{-- jika auth user id role == 3 --}}
                @if (Auth::user()->id_role == '3')
                    <input type="hidden" name="kelas" value="{{ Auth::user()->kelas->id }}">
                @else
                    <div class="row mb-3">
                        <label for="kelass" class="col-md-2 col-form-label">Kelas</label>
                        <div class="col-md-10">
                            <select class="form-select" id="kelass" name="kelas" required>
                                <option value="">Pilih Kelas</option>
                                @foreach ($semua_kelas as $kelas)
                                    @if (old('kelas') == $kelas->id)
                                        <option value="{{ $kelas->id }}" selected>
                                            {{ $kelas->nama }}</option>
                                    @else
                                        <option value="{{ $kelas->id }}">{{ $kelas->nama }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <div class="mt-2">
                                <span class="text-danger error-text kelas_error"></span>
                            </div>
                        </div>
                    </div>

                @endif




                @if (Auth::user()->id_role == '3')
                    <p class="card-title-desc" style="border-bottom: 1px solid rgb(161,179,191)"
                        id="judul-daftar-siswa">
                        Daftar Siswa {{ Auth::user()->kelas->nama }}
                    </p>

                    <div id="daftar-siswa">
                        @foreach ($semua_siswa as $index => $siswa)
                            <div class="row mb-3">
                                <label for="nilai{{ $index + 1 }}"
                                    class="col-md-2 col-form-label">{{ $siswa->name }}</label>
                                <input type="hidden" name="siswa{{ $index + 1 }}" value="{{ $siswa->id }}"
                                    required id="siswa{{ $index + 1 }}">
                                <div class="col-md-10">
                                    <input class="form-control" type="number" name="nilai{{ $index + 1 }}"
                                        id="nilai{{ $index + 1 }}" required placeholder="nilai siswa"
                                        value="{{ old('nilai.' . $index) ?? '' }}">
                                    <div class="invalid-feedback" style="background-image: none;">Nilai tidak boleh
                                        lebih dari 100</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="card-title-desc" style="border-bottom: 1px solid rgb(161,179,191)"
                        id="judul-daftar-siswa">
                        Daftar Siswa
                    </p>
                    <div id="daftar-siswa"></div>
                @endif

                @if ($route == 'nilai-ulangan-harian-tambah')
                    <input type="hidden" name="tipe_nilaii" value="Ulangan Harian">
                @elseif ($route == 'nilai-tugas-tambah')
                    <input type="hidden" name="tipe_nilaii" value="Tugas">
                @elseif ($route == 'nilai-uts-tambah')
                    <input type="hidden" name="tipe_nilaii" value="UTS">
                @elseif ($route == 'nilai-uas-tambah')
                    <input type="hidden" name="tipe_nilaii" value="UAS">
                @elseif ($route == 'nilai-ujian-tambah')
                    <input type="hidden" name="tipe_nilaii" value="Ujian">
                @endif

                <button type="submit" class="btn btn-info waves-effect waves-light">
                    <i class="ri-save-3-line align-middle me-1"></i>
                    <span style="vertical-align: middle">Simpan</span>
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

    @if (auth()->user()->id_role != '3')
        $('#kelass').change(function() {
            var kelas = $('#kelass').val();

            if (kelas != '') {
                $.ajax({
                    url: '/get-data-siswa?kelas=' + kelas,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#judul-daftar-siswa').html('Daftar Siswa ' + data.kelas);
                        var siswa_html = '';
                        $.each(data.siswa, function(index, siswa) {
                            siswa_html += '<div class="row mb-3">';
                            siswa_html += '<label for="nilai' + (index + 1) +
                                '" class="col-md-2 col-form-label">' + siswa.name +
                                '</label>';
                            siswa_html += '<input type="hidden" name="siswa' + (index + 1) +
                                '" value="' + siswa.id + '" required id="siswa' + (index +
                                    1) +
                                '">';
                            siswa_html += '<div class="col-md-10">';
                            siswa_html +=
                                '<input class="form-control" type="number" name="nilai' + (
                                    index + 1) + '" id="nilai' + (index + 1) +
                                '" required placeholder="nilai siswa" value="' + (data
                                    .nilai ?
                                    data.nilai[index] : '') + '">';
                            siswa_html +=
                                '<div class="invalid-feedback" style"background-image: none;">Nilai tidak boleh lebih dari 100</div>';
                            siswa_html += '</div>'; // tambahkan tag penutup div
                            siswa_html += '</div>'; // tambahkan tag penutup div
                        });

                        $('#daftar-siswa').html(siswa_html);
                    }
                });
            } else {
                $('#judul-daftar-siswa').html('Daftar Siswa');
                $('#daftar-siswa').html('');
            }
        });
    @endif


    $('#daftar-siswa').on('input', 'input[name^="nilai"]', function() {
        var inputValue = parseInt($(this).val());
        if (inputValue > 100) {
            $(this).val(100);
            $(this).addClass('is-invalid');
            $(this).next('.invalid-feedback').text('Nilai tidak boleh lebih dari 100');
        } else {
            $(this).removeClass('is-invalid');
            $(this).next('.invalid-feedback').text('');
        }
    });



    // insert data
    $('#formTambahData').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData($('#formTambahData')[0]);

        $.ajax({
            url: '{{ route('nilai-simpan') }}',
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

                    // reset form
                    $('#formTambahData')[0].reset();

                    // clear image
                    clearFile();

                    // fetch data
                    filterData();
                }
            }
        })

    })
</script>
