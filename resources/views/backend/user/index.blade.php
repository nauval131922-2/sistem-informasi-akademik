@extends('backend.main')

@section('title')
    {{-- jika id role = 2 maka judulnya jangan ada kata 'Semua' --}}
    {{-- @if ($id_role == '2')
        Dashboard | {{ $title }}
    @else --}}
    Dashboard | Semua {{ $title }}
    {{-- @endif --}}
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

                            {{-- @if ($route == 'user-index-all')
                                <h4 class="card-title">Semua {{ $title }}</h4>
                                <p class="card-title-desc" style="border-bottom: 1px solid rgb(161,179,191)">Berikut adalah
                                    semua {{ $title }}.</p>
                            @else
                                @if ($id_role == '2')
                                    <h4 class="card-title">{{ $title }}</h4>
                                    <p class="card-title-desc" style="border-bottom: 1px solid rgb(161,179,191)">Berikut
                                        adalah {{ $title }}.</p>
                                @else
                                    <h4 class="card-title">Semua {{ $title }}</h4>
                                    <p class="card-title-desc" style="border-bottom: 1px solid rgb(161,179,191)">Berikut
                                        adalah semua {{ $title }}.</p>
                                @endif
                            @endif

                            @can('admin')
                                @if ($id_role == '1' || $id_role == '3' || $id_role == '4' || $id_role == '5')
                                    <a class="btn btn-primary mb-3" href="{{ route('user-tambah', $id_role) }}" role="button">
                                        <i class="ri-add-line align-middle me-1"></i>
                                        <span style="vertical-align: middle">Tambah</span>
                                    </a>
                                @endif
                            @endcan --}}

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
                                                <li><button class="dropdown-item" onclick="tambahData({{ $role->id }})"
                                                        data-bs-toggle="modal" data-bs-target="#exampleModalScrollable"
                                                        id="buttonTambah">{{ $role->nama }}</button>
                                            @endforeach



                                            {{-- <li><button class="dropdown-item" onclick="tambahDataGuruWali()"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">Guru
                                                    Wali</button></li>
                                            <li><button class="dropdown-item" onclick="tambahDataGuruMapel()"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">Guru
                                                    Mata Pelajaran</button></li>
                                            <li><button class="dropdown-item" onclick="tambahDataSiswa()"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalScrollable">Siswa</button></li> --}}
                                        </ul>
                                    </div>
                                </div>

                            </div>

                            <hr style="margin: 0 0 1rem 0">


                            <div class="row">
                                <div class="col-md-4">
                                    <label for="filterData">Filter</label>
                                </div>
                            </div>
                            <div class="row justify-content-start">
                                <div class="col-md-4">
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
                                <div class="col-md-4">
                                    <button class="btn btn-light" style="margin-right: 5px" onclick="resetFilter()">
                                        <i class="ri-refresh-line align-middle me-1"></i>
                                        <span style="vertical-align: middle">Reset</span>
                                    </button>
                                </div>
                            </div>



                            <hr style="margin: 0.5rem 0 1rem 0">

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
                                        {{-- @if ($id_role == '3' || $id_role == '5')
                                            <th>Kelas</th>
                                        @elseif($id_role == '4')
                                            <th>Mata Pelajaran</th> --}}
                                        {{-- @elseif($route == 'user-index-all') --}}
                                        <th>Kelas</th>
                                        <th>Mata Pelajaran</th>
                                        {{-- @endif --}}
                                        @can('admin')
                                            <th>Action</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($semua_user as $no => $user)
                                        <tr>
                                            <td>{{ $no + 1 }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->role->nama }}</td>
                                            @if ($id_role == '3' || $id_role == '5')
                                                <td>{{ $user->kelas->nama }}</td>
                                            @elseif($id_role == '4')
                                                <td>
                                                    @if ($user->mapel == null)
                                                        -
                                                    @else
                                                        {{ $user->mapel->mata_pelajaran }}
                                                    @endif
                                                </td>
                                            @elseif($route == 'user-index-all')
                                                @if ($user->id_role === 3 || $user->id_role === 5)
                                                    <td>{{ $user->kelas->nama }}</td>
                                                    <td></td>
                                                @elseif($user->id_role === 4)
                                                    <td></td>
                                                    <td>
                                                        @if ($user->mapel == null)
                                                            -
                                                        @else
                                                            {{ $user->mapel->mata_pelajaran }}
                                                        @endif
                                                    </td>
                                                @else
                                                    <td></td>
                                                    <td></td>
                                                @endif
                                            @endif
                                            @can('admin')
                                                <td>
                                                    <a href="{{ route('user-edit', $user->id) }}" class="btn btn-info btn-sm">
                                                        <i class="ri-edit-2-line align-middle me-1"></i>
                                                        <span style="vertical-align: middle">Edit</span>
                                                    </a>
                                                    @if ($user->id != Auth::user()->id && $user->id_role != '2')
                                                        <a href="{{ route('user-hapus', $user->id) }}"
                                                            class="btn btn-danger btn-sm" id="delete">
                                                            <i class="ri-delete-bin-2-line align-middle me-1"></i>
                                                            <span style="vertical-align: middle">Hapus</span>
                                                        </a>
                                                    @endif
                                                </td>
                                            @endcan
                                        </tr>
                                    @endforeach --}}
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
        $(document).ready(function() {

            filterData();

        });


        // fetch data all jam
        function filterData() {

            $.ajax({
                url: '{{ route('user-filter') }}?tipe_pengguna=' + $('#tipe_pengguna').val(),
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#datatable').DataTable().destroy();
                    $('#datatable tbody').empty();
                    var data = response.data;
                    $.each(data, function(key, value) {
                        var editButton = '';
                        var deleteButton = '';

                        editButton =
                            '<button class="btn btn-info btn-sm" id="btnEditData" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable" style="margin-right: 5px;" onclick="editData(' +
                            value.id +
                            ')"><i class="ri-edit-2-line align-middle me-1"></i><span style="vertical-align: middle">Edit</span></button>';

                        deleteButton =
                            '<button class="btn btn-danger btn-sm" id="delete" onclick="deleteData(' +
                            value.id +
                            ')"><i class="ri-delete-bin-2-line align-middle me-1"></i><span style="vertical-align: middle">Hapus</span></button>';

                        $('#datatable tbody').append(
                            '<tr>' +
                            '<td>' + (key + 1) + '</td>' +
                            '<td>' + value.name + '</td>' +
                            '<td>' + (value.email == null ? '' : value.email) + '</td>' +
                            '<td>' + value.username + '</td>' +
                            '<td>' + value.role.nama + '</td>' +
                            '<td>' + (value.id_role == '3' || value.id_role == '5' ? value.kelas
                                .nama : '') + '</td>' +
                            '<td>' + (value.id_role == '4' && value.mapel != null ? value.mapel
                                .mata_pelajaran : '') + '</td>' +
                            // jangan tampikan tombol delete jika user yang login adalah user yang sedang di edit
                            @can('admin')
                                '<td>' + (value.id != '{{ Auth::user()->id }}' && value.id_role !=
                                    '2' ?
                                    editButton +
                                    deleteButton : editButton) + '</td>' +
                            @endcan
                            '</tr>');


                    });
                    $('#datatable').DataTable();
                }
            });
        }

        // reset filter jam
        function resetFilter() {
            $('#tipe_pengguna').val('');
            filterData();
        };

        // fungsi menampilkan modal tambah data jadwal pelajaran
        function tambahData(id) {

            // console.log(id);

            $.ajax({
                url: '/data-user/tambah/' + id,
                type: 'GET',
                success: function(response) {
                    $('#content').html(response);
                    // modal title tulisan dari dropdown button yang dipilih
                    $('#exampleModalScrollableTitle').html('Tambah Data User');
                }
            });
        }

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
                        // // success message menggunakan div class session
                        // var alertHtml =
                        //     '<div class="alert alert-warning" style="position: fixed; top: 10px; left: 0; right: 0; margin: auto; z-index: 9999; max-width: 500px; width: auto;text-align: center;" role="alert">' +
                        //     '<strong>' + response.message + '</strong>' +
                        //     '</div>';
                        // $('.session').html(alertHtml);

                        // setTimeout(function() {
                        //     $('.session').html('');
                        // }, 1500);

                        // // set width dynamically based on the message length
                        // var messageLength = response.message.length;
                        // var alertWidth = messageLength * 10;
                        // $('.alert').css('width', alertWidth);

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
                        $('#exampleModalScrollableTitle').html('Ubah Data Siswa');
                    }
                }
            });
        }
    </script>
@endsection
