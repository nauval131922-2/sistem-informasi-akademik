@extends('backend.main')

@section('title')
    Dashboard | Semua {{ $title }}
@endsection

<?php
$route = Route::current()->getName();
// get all jabatan
$jabatan = App\Models\Jabatan::all();
?>

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-auto me-auto">
                                    <h4 class="card-title">Semua {{ $title }}</h4>
                                    <p class="card-title-desc mb-0">Berikut adalah semua
                                        {{ $title }}</p>
                                    </p>

                                </div>

                                <div class="col-auto mb-2">
                                    <div class="dropdown">
                                        @can('admin')
                                            <button class="btn btn-primary dropdown-toggle" id="dropdownMenuLink"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-add-line align-middle me-1"></i>
                                                <span style="vertical-align: middle">Tambah</span>
                                            </button>
                                        @endcan

                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">


                                            @foreach ($semua_role as $role)
                                                <li>
                                                    <button class="dropdown-item" onclick="tambahData({{ $role->id }})"
                                                        data-bs-toggle="modal" data-bs-target="#exampleModalScrollable"
                                                        id="buttonTambah">
                                                        {{ $role->nama }}
                                                    </button>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                            </div>

                            <hr style="margin: 0 0 1rem 0">


                            <div class="row">
                                <div class="col-md-3">
                                    <label for="filterData">Filter</label>
                                </div>
                            </div>
                            <div class="row justify-content-start">
                                <div class="col-md-3">
                                    <select name="tipe_pengguna" id="tipe_pengguna" class="form-select mb-2"
                                        onchange="filterData()">
                                        <option value="">Tipe Pengguna</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Kepala Madrasah</option>
                                        <option value="3">Guru Wali</option>
                                        <option value="4">Guru Mata Pelajaran</option>
                                        <option value="5">Siswa</option>
                                    </select>
                                </div>
                                {{-- filter kelas --}}
                                <div class="col-md-3">
                                    <select name="kelas" id="kelas" class="form-select mb-2" onchange="filterData()">
                                        <option value="">Kelas</option>
                                        @foreach ($kelas as $k)
                                            <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- filter mata pelajaran --}}
                                <div class="col-md-3">
                                    <select name="mapel" id="mapel" class="form-select mb-2" onchange="filterData()">
                                        <option value="">Mata Pelajaran</option>
                                        @foreach ($mapel as $m)
                                            <option value="{{ $m->id }}">{{ $m->mata_pelajaran }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-light" style="margin-right: 5px" onclick="resetFilter()">
                                        <i class="ri-refresh-line align-middle me-1"></i>
                                        <span style="vertical-align: middle">Reset</span>
                                    </button>
                                </div>
                            </div>



                            <hr style="margin: 0.5rem 0 1rem 0">


                            {{-- tahun ajaran aktif --}}
                            <div class="row">
                                <div class="col-lg-12">
                                    @if ($tahun_ajaran_aktif_semester != '' && $tahun_ajaran_aktif_tahun != '')
                                        <label for="">Tahun ajaran aktif:
                                            <span class="badge bg-success" style="font-size: 14px; font-weight:bold">
                                                {{ $tahun_ajaran_aktif_semester }} {{ $tahun_ajaran_aktif_tahun }}
                                            </span>
                                        </label>
                                    @else
                                        <label for="">Tahun ajaran aktif:
                                            <span class="badge bg-danger" style="font-size: 14px; font-weight:bold">
                                                Belum ada tahun ajaran aktif
                                            </span>
                                        </label>
                                    @endif
                                </div>

                            </div>
                            <hr style="margin: 0.5rem 0 1rem 0">

                            @can('admin')
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="filterData">Kenaikan Kelas</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="col-md-12">
                                            <button class="btn btn-outline-success" style="margin-right: 5px"
                                                onclick="naikKelas()">
                                                <i class="ri-arrow-up-line align-middle me-1"></i>
                                                <span style="vertical-align: middle">Naik Kelas</span>
                                            </button>
                                            <button class="btn btn-outline-danger" style="margin-right: 5px"
                                                onclick="turunKelas()">
                                                <i class="ri-arrow-down-line align-middle me-1"></i>
                                                <span style="vertical-align: middle">Turun Kelas</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <hr style="margin: 1rem 0 1rem 0">

                                <div class="row mb-3">
                                    <div class="col-lg-12">
                                        <h4 class="card-title">Upload File Excel Daftar Siswa</h4>
                                        <p class="card-title-desc">Pilih file yang ingin anda unggah, <em>Pilih File…</em> dan
                                            Upload. Download template file <em style="font-weight: bold">Excel</em>-nya <a
                                                href="{{ asset('template/daftar-siswa.xlsx') }}">di sini</a>.</p>
                                        <form id="formUploadData" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="input-group mb-2">
                                                <input class="form-control" type="file" id="formFile" name="file"
                                                    accept=".xls, .xlsx, .csv, .xlsm, .xlsb, .xltx, .xltm">
                                                <button class="btn btn-primary" type="submit">
                                                    <i class="ri-upload-2-line align-middle me-1"></i>
                                                    <span style="vertical-align: middle">Upload</span>
                                                </button>

                                            </div>
                                            <div class="mb-2">
                                                <span class="text-danger error-text file_error"></span>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <hr style="margin: 0 0 1rem 0">
                            @endcan

                            <table id="datatable"
                                class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline collapsed"
                                style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid"
                                aria-describedby="datatable-buttons_info">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Kelas</th>
                                        <th>Mata Pelajaran</th>
                                        @canany(['admin', 'kepala_madrasah'])
                                            <th>Action</th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="content">
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
        function tambahData(id) {
            $.ajax({
                url: '/data-user/tambah/' + id,
                type: 'GET',
                success: function(response) {
                    $('#content').html(response);
                    $('#exampleModalScrollableTitle').html('Tambah Data User');
                    $('#exampleModalScrollable').modal(
                        'show'); // Menampilkan modal secara manual jika AJAX berhasil
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        window.location = "{{ route('login') }}";
                    } else {
                        console.error('An error occurred:', xhr);
                    }
                }
            });
        }
    </script>

    <script>
        $(document).ready(function() {

            filterData();

        });


        // fetch data all jam
        function filterData() {
            $.ajax({
                url: '{{ route('user-filter') }}?tipe_pengguna=' + $('#tipe_pengguna').val() + '&kelas=' +
                    $('#kelas').val() + '&mapel=' + $('#mapel').val(),
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var table = $('#datatable').DataTable();

                    if ($.fn.DataTable.isDataTable('#datatable')) {
                        table.clear();
                    }

                    var data = response.data;
                    $.each(data, function(key, value) {
                        var editButton = '';
                        var deleteButton = '';
                        var detailButton = '';

                        editButton =
                            '<button class="btn btn-info btn-sm" id="btnEditData" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable" style="margin-right: 5px;" onclick="editData(' +
                            value.id +
                            ')"><i class="ri-edit-2-line align-middle me-1"></i><span style="vertical-align: middle">Edit</span></button>';

                        detailButton =
                            '<button class="btn btn-warning btn-sm" id="btnEditData" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable" style="margin-right: 5px;" onclick="editData(' +
                            value.id +
                            ')"><i class="ri-edit-2-line align-middle me-1"></i><span style="vertical-align: middle">Detail</span></button>';

                        deleteButton =
                            '<button class="btn btn-danger btn-sm" id="delete" onclick="deleteData(' +
                            value.id +
                            ')"><i class="ri-delete-bin-2-line align-middle me-1"></i><span style="vertical-align: middle">Hapus</span></button>';

                        cetakButton =
                            '<div class="dropdown">' +
                            '<button class="btn btn-success" id="dropdownMenuLink" style="margin-top: -10px" data-bs-toggle="dropdown" aria-expanded="false">' +
                            '<i class="ri-printer-line align-middle me-1"></i>' +
                            '<span style="vertical-align: middle">Cetak</span>' +
                            '</button>' +
                            '<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">' +
                            '<li><button class="dropdown-item" onclick="cetakData(' + value.id +
                            ')">Riwayat Pendidikan Siswa</button></li>' +
                            '<li><button class="dropdown-item" onclick="cetakRapor( ' + value.id +
                            ' )">Rapor Semester</button></li>' +
                            '</ul>' +
                            '</div>';


                        table.row.add([
                            key + 1,
                            value.name,
                            value.email == null ? '' : value.email,
                            value.username,
                            value.role.nama,
                            (value.id_role == '3' || value.id_role == '5') ? (value.kelas ?
                                value.kelas.nama : null) :
                            '',
                            ((value.id_role == '4' || value.id_role == '3') && value.mapel !=
                                null) ? value.mapel.mata_pelajaran : '',
                            @if (Auth::user()->id_role == 1)
                                (value.id != '{{ Auth::user()->id }}' && value.id_role == '5' ?
                                    detailButton + deleteButton : value.id !=
                                    '{{ Auth::user()->id }}' && value.id_role != '2' ?
                                    editButton + deleteButton : editButton)
                            @elseif (Auth::user()->id_role == 2)
                                (value.id != '{{ Auth::user()->id }}' && value.id_role == '5' ?
                                    cetakButton : '')
                            @else
                                ''
                            @endif
                        ]).draw(false);
                    });
                    table.columns.adjust().draw();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        function cetakData(id_siswa) {
            var url = '/data-user/print?';

            if (id_siswa) {
                url += 'id_siswa=' + id_siswa;
            }

            window.open(url, '_blank');
        }

        function cetakRapor(id_siswa) {
            var url = '/data-rapor/print?';

            if (id_siswa) {
                url += 'id_siswa=' + id_siswa;
            }

            window.open(url, '_blank');
        }





        // reset filter jam
        function resetFilter() {
            $('#tipe_pengguna').val('');
            $('#kelas').val('');
            $('#mapel').val('');
            filterData();
        };



        // make delete function
        function deleteData(id) {
            if (confirm('Apakah anda yakin ingin menghapus data ini?')) {

                $.ajax({
                    url: '/data-user/hapus/' + id,
                    type: 'get',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {

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

                        filterData();
                    }
                });
            }
        }

        // menampilkan modal edit data
        function editData(id) {
            $.ajax({
                url: '/data-user/edit/' + id,
                type: 'GET',
                success: function(response) {
                    $('#content').html(response);
                    // modal title
                    if (response.includes('Admin')) {
                        $('#exampleModalScrollableTitle').html('Ubah Data Admin');
                    } else if (response.includes('Kepala Madrasah')) {
                        $('#exampleModalScrollableTitle').html('Ubah Data Kepala Madrasah');
                    } else if (response.includes('Guru Wali')) {
                        $('#exampleModalScrollableTitle').html('Ubah Data Guru Wali');
                    } else if (response.includes('Guru Mata Pelajaran')) {
                        $('#exampleModalScrollableTitle').html('Ubah Data Guru Mata Pelajaran');
                    } else if (response.includes('Siswa')) {
                        $('#exampleModalScrollableTitle').html('Detail Data Siswa');
                    }
                }
            });
        }

        // naik kelas function
        function naikKelas() {
            if (confirm('Apakah anda yakin?')) {
                $.ajax({
                    url: '{{ route('user-naik-kelas') }}',
                    type: 'post',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            toastr.success(response.message, "", {
                                closeButton: false,
                                debug: false,
                                newestOnTop: true,
                                progressBar: false,
                                positionClass: "toast-top-right",
                                preventDuplicates: false,
                                onclick: null,
                                showDuration: "100",
                                hideDuration: "100",
                                timeOut: "1500",
                                extendedTimeOut: "1000",
                                showEasing: "swing",
                                hideEasing: "linear",
                                showMethod: "fadeIn",
                                hideMethod: "fadeOut"
                            });

                            filterData();

                        } else if (response.status == 'warning') {
                            toastr.warning(response.message, "", {
                                closeButton: false,
                                debug: false,
                                newestOnTop: true,
                                progressBar: false,
                                positionClass: "toast-top-right",
                                preventDuplicates: false,
                                onclick: null,
                                showDuration: "100",
                                hideDuration: "100",
                                timeOut: "1500",
                                extendedTimeOut: "1000",
                                showEasing: "swing",
                                hideEasing: "linear",
                                showMethod: "fadeIn",
                                hideMethod: "fadeOut"
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Terjadi kesalahan. Silakan coba lagi.');
                        console.error(xhr.responseText);
                        console.error(status);
                        console.error(error);
                    }
                });
            }
        }

        // turun kelas function
        function turunKelas() {
            if (confirm('Apakah anda yakin?')) {
                $.ajax({
                    url: '{{ route('user-turun-kelas') }}',
                    type: 'post',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            toastr.success(response.message, "", {
                                closeButton: false,
                                debug: false,
                                newestOnTop: true,
                                progressBar: false,
                                positionClass: "toast-top-right",
                                preventDuplicates: false,
                                onclick: null,
                                showDuration: "100",
                                hideDuration: "100",
                                timeOut: "1500",
                                extendedTimeOut: "1000",
                                showEasing: "swing",
                                hideEasing: "linear",
                                showMethod: "fadeIn",
                                hideMethod: "fadeOut"
                            });

                            filterData();

                        } else if (response.status == 'warning') {
                            toastr.warning(response.message, "", {
                                closeButton: false,
                                debug: false,
                                newestOnTop: true,
                                progressBar: false,
                                positionClass: "toast-top-right",
                                preventDuplicates: false,
                                onclick: null,
                                showDuration: "100",
                                hideDuration: "100",
                                timeOut: "1500",
                                extendedTimeOut: "1000",
                                showEasing: "swing",
                                hideEasing: "linear",
                                showMethod: "fadeIn",
                                hideMethod: "fadeOut"
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Terjadi kesalahan. Silakan coba lagi.');
                        console.error(xhr.responseText);
                        console.error(status);
                        console.error(error);
                    }
                });
            }
        }

        $('#formUploadData').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData($('#formUploadData')[0]);

            $.ajax({
                url: '{{ route('file-import-data-siswa') }}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(response) {
                    if (response.status == 'success') {
                        toastr.success(response.message, "", {
                            closeButton: false,
                            debug: false,
                            newestOnTop: true,
                            progressBar: false,
                            positionClass: "toast-top-right",
                            preventDuplicates: false,
                            onclick: null,
                            showDuration: "100",
                            hideDuration: "100",
                            timeOut: "1500",
                            extendedTimeOut: "1000",
                            showEasing: "swing",
                            hideEasing: "linear",
                            showMethod: "fadeIn",
                            hideMethod: "fadeOut"
                        });

                        $('#formUploadData')[0].reset();

                        filterData();

                    } else if (response.status == 'warning') {
                        toastr.warning(response.message, "", {
                            closeButton: false,
                            debug: false,
                            newestOnTop: true,
                            progressBar: false,
                            positionClass: "toast-top-right",
                            preventDuplicates: false,
                            onclick: null,
                            showDuration: "100",
                            hideDuration: "100",
                            timeOut: "1500",
                            extendedTimeOut: "1000",
                            showEasing: "swing",
                            hideEasing: "linear",
                            showMethod: "fadeIn",
                            hideMethod: "fadeOut"
                        });
                    } else if (response.status == 'error') {
                        $.each(response.message, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    } else if (response.status == 'error2') {
                        toastr.error(response.message, "", {
                            closeButton: false,
                            debug: false,
                            newestOnTop: true,
                            progressBar: false,
                            positionClass: "toast-top-right",
                            preventDuplicates: false,
                            onclick: null,
                            showDuration: "100",
                            hideDuration: "100",
                            timeOut: "1500",
                            extendedTimeOut: "1000",
                            showEasing: "swing",
                            hideEasing: "linear",
                            showMethod: "fadeIn",
                            hideMethod: "fadeOut"
                        });
                    }

                },
                error: function(xhr, status, error) {
                    toastr.error('Terjadi kesalahan. Silakan coba lagi.');
                    console.error(xhr.responseText);
                    console.error(status);
                    console.error(error);
                }
            })

        })
    </script>
@endsection
