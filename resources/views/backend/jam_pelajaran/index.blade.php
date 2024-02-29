@extends('backend.main')

@section('title')
    Dashboard | Semua {{ $title }}
@endsection

@php
    // get current route name
    $route = Route::current()->getName();
@endphp

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">

                            {{-- session --}}
                            <div class="session"></div>

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
                                            <li><button class="dropdown-item" onclick="tambahDataJamPelajaran()"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">Jam
                                                    Pelajaran</button></li>
                                            <li><button class="dropdown-item" onclick="tambahDataJamIstirahat()"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">Jam
                                                    Istirahat</button></li>
                                        </ul>
                                    </div>
                                </div>

                            </div>

                            <hr style="margin: 0 0 1rem 0">


                            <div class="row">
                                <div class="col-md-4">
                                    <label for="filterJam">Filter</label>
                                </div>
                            </div>
                            <div class="row justify-content-start">
                                <div class="col-md-4">
                                    <select name="tipe_jam" id="tipe_jam" class="form-select mb-2" onchange="filterJam()">
                                        <option value="">Tipe Jam</option>
                                        <option value="Pelajaran">Jam Pelajaran</option>
                                        <option value="Istirahat">Jam Istirahat</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    {{-- button reset filter --}}
                                    <button class="btn btn-light" onclick="resetFilter()">
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
                                        <th>Jam ke</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Selesai</th>
                                        <th>Tipe Jam</th>
                                        @can('admin')
                                            <th>Action</th>
                                        @endcan
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
        <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered">
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

            filterJam();

        });


        // fungsi menampilkan modal tambah data jam pelajaran
        function tambahDataJamPelajaran() {

            $.ajax({
                url: '{{ route('jam-pelajaran-tambah') }}',
                type: 'GET',
                success: function(response) {
                    $('#content').html(response);
                    // modal title
                    $('#exampleModalScrollableTitle').html('Tambah Data Jam Pelajaran');
                }
            });
        }

        // fungsi menampilkan modal tambah data jam istirahat
        function tambahDataJamIstirahat() {

            $.ajax({
                url: '{{ route('jam-istirahat-tambah') }}',
                type: 'GET',
                success: function(response) {
                    $('#content').html(response);
                    // modal title
                    $('#exampleModalScrollableTitle').html('Tambah Data Jam Istirahat');
                }
            });
        }

        // fetch data all jam
        function filterJam() {

            $.ajax({
                url: '{{ route('jam-filter') }}?tipe_jam=' + $('#tipe_jam').val(),
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
                            '<td>' + value.jam_ke + '</td>' +
                            '<td>' + value.jam_mulai + '</td>' +
                            '<td>' + value.jam_selesai + '</td>' +
                            '<td>' + value.tipe_jam + '</td>' +
                            @can('admin')
                                '<td>' + editButton + deleteButton + '</td>' +
                            @endcan
                            '</tr>'
                        );
                    });
                    $('#datatable').DataTable();

                }
            });
        }

        // reset filter jam
        function resetFilter() {
            $('#tipe_jam').val('');
            filterJam();
        };



        // make delete function
        function deleteData(id) {
            if (confirm('Apakah anda yakin ingin menghapus data ini?')) {

                $.ajax({
                    url: '/data-jam/hapus/' + id,
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

                        filterJam();
                    }
                });
            }
        }

        // menampilkan modal edit data
        function editData(id) {
            $.ajax({
                url: '/data-jam/edit/' + id,
                type: 'GET',
                success: function(response) {
                    $('#content').html(response);
                    // modal title
                    if (response.includes('Jam Pelajaran')) {
                        $('#exampleModalScrollableTitle').html('Ubah Data Jam Pelajaran');
                    } else if (response.includes('Jam Istirahat')) {
                        $('#exampleModalScrollableTitle').html('Ubah Data Jam Istirahat');
                    }
                }
            });
        }
    </script>
@endsection
