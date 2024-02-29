{{-- @extends('backend.main')

@section('title')
    Dashboard | Tambah {{ $title }}
@endsection

@section('content') --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}

<?php
$route = Route::currentRouteName();
?>

{{-- <div class="page-content"> --}}
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-121">
            {{-- <div class="card">
                        <div class="card-body"> --}}


            {{-- @if ($route == 'nilai-ulangan-harian-tambah')
                                <a href="{{ route('nilai-ulangan-harian-index-kelas', $id_kelas) }}"
                                    class="btn btn-light mb-3"
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
                            @elseif ($route == 'nilai-tugas-tambah')
                                <a href="{{ route('nilai-tugas-index-kelas', $id_kelas) }}" class="btn btn-light mb-3"
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
                            @elseif ($route == 'nilai-uts-tambah')
                                <a href="{{ route('nilai-uts-index-kelas', $id_kelas) }}" class="btn btn-light mb-3"
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
                            @elseif ($route == 'nilai-uas-tambah')
                                <a href="{{ route('nilai-uas-index-kelas', $id_kelas) }}" class="btn btn-light mb-3"
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


            {{-- <h4 class="card-title">Tambah {{ $title }}</h4> --}}
            <p class="card-title-desc" style="border-bottom: 1px solid rgb(161,179,191)">Lengkapi form
                berikut untuk menambah {{ $title }}.</p>
            <form enctype="multipart/form-data" id="formTambahData" method="POST">
                @csrf
                <div class="row mb-3">
                    <label for="judul" class="col-md-2 col-form-label">Judul</label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" name="judul" id="judul"
                            placeholder="Masukkan judul {{ $title }}" value="{{ old('judul') }}" required>
                        <div class="mt-2">
                            {{-- @error('judul')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror --}}
                            <span class="text-danger error-text judul_error"></span>
                        </div>
                    </div>
                </div>

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
                                {{-- @error('guru')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                                <span class="text-danger error-text guru_error"></span>
                            </div>
                        </div>
                    </div>
                @else
                    <input type="hidden" name="guru" value="{{ Auth::user()->id }}">
                @endif

                {{-- jika auth user admin/1 atau kepala madrasah/2 atau guru walikelas/3 maka tampikan form mapel, tetapi jika auth user guru/4 maka disable form mapel --}}
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

                {{-- kelas --}}
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
                            {{-- @error('kelas')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror --}}
                            <span class="text-danger error-text kelas_error"></span>
                        </div>
                    </div>
                </div>

                <p class="card-title-desc" style="border-bottom: 1px solid rgb(161,179,191)" id="judul-daftar-siswa">
                    Daftar Siswa
                </p>

                <?php
                // $no = 1;
                // $no2 = 1;
                // $no3 = 1;
                ?>
                {{-- @foreach ($semua_siswa as $no => $siswa)
                    <div class="row mb-3">
                        <label for="nilai{{ $no + 1 }}"
                            class="col-md-2 col-form-label">{{ $siswa->name }}</label>
                        <input type="hidden" name="siswa{{ $no + 1 }}" value="{{ $siswa->id }}" required
                            id="siswa{{ $no + 1 }}">
                        <div class="col-md-10">
                            <input class="form-control" type="number" name="nilai{{ $no + 1 }}"
                                id="nilai{{ $no + 1 }}" required placeholder="Masukkan nilai siswa"
                                value="{{ old('nilai' . $no + 1) }}">
                            <div class="mt-2">
                                @error('nilai')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endforeach --}}

                <div id="daftar-siswa"></div>

                @if ($route == 'nilai-ulangan-harian-tambah')
                    <input type="hidden" name="tipe_nilai" value="Ulangan Harian">
                @elseif ($route == 'nilai-tugas-tambah')
                    <input type="hidden" name="tipe_nilai" value="Tugas">
                @elseif ($route == 'nilai-uts-tambah')
                    <input type="hidden" name="tipe_nilai" value="UTS">
                @elseif ($route == 'nilai-uas-tambah')
                    <input type="hidden" name="tipe_nilai" value="UAS">
                @endif

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

    $('#kelass').change(function() {
        // var id = $('#id').val();
        // var judul = $('#judul').val();
        // var guru = $('#guru').val();
        // var mapel = $('#mapel').val();
        var kelas = $('#kelass').val();
        // var tipe_nilaii = $('#tipe_nilai').val();

        if (kelas != '') {
            $.ajax({
                url: '/get-data-siswa?kelas=' + kelas,
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
                    });

                    $('#daftar-siswa').html(siswa_html);
                }
            });
        } else {
            $('#judul-daftar-siswa').html('Daftar Siswa');
            $('#daftar-siswa').html('');
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
