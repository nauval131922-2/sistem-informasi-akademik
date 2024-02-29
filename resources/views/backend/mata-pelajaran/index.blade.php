@extends('backend.main')

@section('title')
    Dashboard | Semua {{ $title }}
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">

                            {{-- session message --}}
                            <div class="session"></div>

                            {{-- <h4 class="card-title">Semua {{ $title }}</h4>
                            <p class="card-title-desc" style="border-bottom: 1px solid rgb(161,179,191)">Berikut adalah semua
                                {{ $title }}.
                            </p> --}}

                            {{-- @can('admin')
                                <a class="btn btn-primary mb-3" role="button" data-bs-toggle="modal"
                                    data-bs-target="#exampleModalScrollable" id="btnTambahData">
                                    <i class="ri-add-line align-middle me-1"></i>
                                    <span style="vertical-align: middle">Tambah</span>
                                </a>
                            @endcan --}}

                            <div class="row">
                                <div class="col-auto me-auto">
                                    <h4 class="card-title">Semua {{ $title }}</h4>
                                    <p class="card-title-desc mb-0">Berikut adalah semua
                                        {{ $title }}</p>
                                    </p>

                                </div>

                                @can('admin')
                                    <div class="col-auto mb-2">
                                        <button class="btn btn-primary" role="button" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalScrollable" id="btnTambahData" onclick="tambahData()">
                                            <i class="ri-add-line align-middle me-1"></i>
                                            <span style="vertical-align: middle">Tambah</span>
                                        </button>
                                    </div>
                                @endcan

                            </div>

                            <hr style="margin: 0 0 1rem 0">

                            <table id="datatable"
                                class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline collapsed"
                                style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid"
                                aria-describedby="datatable-buttons_info">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mata Pelajaran</th>
                                        @can('admin')
                                            <th>Action</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody></tbody>
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
        // menampilkan modal tambah data
        function tambahData() {
            $.ajax({
                // url: '/tambah-data',
                url: '{{ route('mata-pelajaran-tambah') }}',
                type: 'GET',
                success: function(response) {
                    $('#content').html(response);
                    // modal title
                    $('#exampleModalScrollableTitle').html('Tambah {{ $title }}');
                }
            });
        }

        // buatkan function fecthData
        function fetchData() {
            $.ajax({
                url: '{{ route('mata-pelajaran-fetch') }}',
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
                            '<td>' + value.mata_pelajaran + '</td>' +
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

        // make delete function
        function deleteData(id) {
            if (confirm('Apakah anda yakin ingin menghapus data ini?')) {

                $.ajax({
                    url: '/mata-pelajaran/hapus/' + id,
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

                        fetchData();
                    }
                });
            }
        }

        // menampilkan modal edit data
        function editData(id) {
            $.ajax({
                url: '/mata-pelajaran/edit/' + id,
                type: 'GET',
                success: function(response) {
                    $('#content').html(response);
                    // modal title
                    $('#exampleModalScrollableTitle').html('Ubah {{ $title }}');
                }
            });
        }

        $(document).ready(function() {

            fetchData();

        });
    </script>
@endsection
