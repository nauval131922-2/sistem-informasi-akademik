{{-- @extends('backend.main')

@section('title')
    Dashboard | Tambah {{ $title }}
@endsection

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}

<?php
$route = Route::current()->getName();
?>

{{-- <div class="page-content"> --}}
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            {{-- <div class="card">
                        <div class="card-body"> --}}

            {{-- @if ($route == 'jadwal-pelajaran-tambah')
                                <a href="{{ route('jadwal-pelajaran-index', $id_kelas) }}" class="btn btn-light mb-3"
                                    style="
                        /* taruh di samping kanan */
                        float: right;
                        /* background-color lebih muda lagi */
                        /* background-color: rgb(37,43,59); */
                        border-color: rgb(37,43,59);
                        ">
                                    <i class="ri-arrow-go-back-line align-middle me-1"></i>
                                    <span style="vertical-align: middle">Back to List</span>
                                </a>
                            @elseif ($route == 'jadwal-ekstra-tambah')
                                <a href="{{ route('jadwal-ekstra-index', $id_kelas) }}" class="btn btn-light mb-3"
                                    style="
                        /* taruh di samping kanan */
                        float: right;
                        /* background-color lebih muda lagi */
                        /* background-color: rgb(37,43,59); */
                        border-color: rgb(37,43,59);
                        ">
                                    <i class="ri-arrow-go-back-line align-middle me-1"></i>
                                    <span style="vertical-align: middle">Back to List</span>
                                </a>
                            @endif --}}

            @if ($route == 'jadwal-pelajaran-tambah')
                {{-- <h4 class="card-title">Tambah {{ $title }}</h4> --}}
                <p class="card-title-desc" style="border-bottom: 1px solid rgb(161,179,191)">Lengkapi form
                    berikut untuk menambah {{ $title }}.</p>
            @endif
            @if ($route == 'jadwal-ekstra-tambah')
                {{-- <h4 class="card-title">Tambah {{ $title }}</h4> --}}
                <p class="card-title-desc" style="border-bottom: 1px solid rgb(161,179,191)">Lengkapi form
                    berikut untuk menambah {{ $title }}.</p>
            @endif

            {{-- @if ($route == 'jadwal-pelajaran-tambah')
                <form action="{{ route('jadwal-pelajaran-simpan', $id_kelas) }}" method="POST">
                @elseif ($route == 'jadwal-ekstra-tambah')
                    <form action="{{ route('jadwal-ekstra-simpan', $id_kelas) }}" method="POST">
            @endif --}}
            <form enctype="multipart/form-data" id="formTambahData" method="POST">
                @csrf

                {{-- kelas --}}
                <div class="row mb-3">
                    <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="kelas" name="kelas" required>
                            <option value="">Pilih Kelas</option>
                            @foreach ($semua_kelas as $kelas)
                                @if (old('kelas') == $kelas->id)
                                    <option value="{{ $kelas->id }}" selected>{{ $kelas->nama }}</option>
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

                <div class="row mb-3">
                    <label for="hari" class="col-sm-2 col-form-label">Hari</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="hari" class="form-control" id="hari" required>
                            <option value="">Pilih Hari</option>
                            @foreach ($semua_hari as $hari)
                                @if (old('hari') == $hari)
                                    <option value="{{ $hari }}" selected>{{ $hari }}</option>
                                @else
                                    <option value="{{ $hari }}">{{ $hari }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="mt-2">
                            {{-- @error('hari')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror --}}
                            <span class="text-danger error-text hari_error"></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="guru" class="col-sm-2 col-form-label">Guru</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="guru" name="guru" required>
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
                            {{-- @error('guru')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror --}}
                            <span class="text-danger error-text guru_error"></span>
                        </div>
                    </div>
                </div>
                @if ($route == 'jadwal-pelajaran-tambah')
                    <input type="hidden" name="tipe_jadwal" value="Pelajaran">
                    <div class="row mb-3">
                        <label for="mapel" class="col-sm-2 col-form-label">Mata Pelajaran</label>
                        <div class="col-sm-10">
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
                                {{-- @error('mapel')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                                <span class="text-danger error-text mapel_error"></span>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($route == 'jadwal-ekstra-tambah')
                    <input type="hidden" name="tipe_jadwal" value="Ekstrakurikuler">
                    <div class="row mb-3">
                        <label for="ekstra" class="col-sm-2 col-form-label">Ekstrakurikuler</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="ekstra" name="ekstra" required>
                                <option value="">Pilih Ekstrakurikuler</option>
                                @foreach ($semua_ekstra as $ekstra)
                                    @if (old('mapel') == $ekstra->id)
                                        <option value="{{ $ekstra->id }}" selected>{{ $ekstra->nama }}
                                        </option>
                                    @else
                                        <option value="{{ $ekstra->id }}">{{ $ekstra->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <div class="mt-2">
                                {{-- @error('ekstra')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                                <span class="text-danger error-text ekstra_error"></span>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row mb-3">
                    <label for="jam_ke" class="col-sm-2 col-form-label">Jam ke</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="jam_ke" name="jam_ke" required>
                            <option value="">Pilih Jam ke</option>
                            @foreach ($semua_jam_pelajaran as $jam_pelajaran)
                                @if (old('jam_pelajaran') == $jam_pelajaran->id)
                                    <option value="{{ $jam_pelajaran->id }}" selected>
                                        {{ $jam_pelajaran->jam_ke }}</option>
                                @else
                                    <option value="{{ $jam_pelajaran->id }}">{{ $jam_pelajaran->jam_ke }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        <div class="mt-2">
                            {{-- @error('jam_ke')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror --}}
                            <span class="text-danger error-text jam_ke_error"></span>
                        </div>
                    </div>
                </div>

                {{-- <input type="submit" value="Simpan" class="btn btn-info waves-effect waves-light"> --}}
                <button type="submit" class="btn btn-info waves-effect waves-light">
                    <i class="ri-save-3-line align-middle me-1"></i>
                    <span style="vertical-align: middle">Simpan</span>
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
    });

    // insert data
    $('#formTambahData').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData($('#formTambahData')[0]);

        $.ajax({
            url: '{{ route('jadwal-simpan') }}',
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
