@extends('backend.main')

<?php
$route = Route::current()->getName();
?>

@section('title')
    Dashboard | Semua {{ $title }}
@endsection

@section('content')
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
                                        <div class="col-auto mb-2">
                                            <button class="btn btn-primary" role="button" data-bs-toggle="modal"
                                                data-bs-target="#exampleModalScrollable" id="btnTambahData"
                                                onclick="tambahData()">
                                                <i class="ri-add-line align-middle me-1"></i>
                                                <span style="vertical-align: middle">Tambah</span>
                                            </button>
                                        </div>


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
                                @canany(['kepala_madrasah', 'admin'])
                                    <div class="col-md-4">
                                        <select name="kepemilikan_blog" id="kepemilikan_blog" class="form-select mb-2"
                                            onchange="filterData()">
                                            <option value="{{ auth()->user()->id }}">Blog Saya</option>
                                            <option value="anonymous">Anonymous</option>
                                            <option value="">Semua Blog</option>
                                            {{-- tambah option anonymous --}}
                                        </select>
                                    </div>
                                @endcanany

                                <div class="col-md-4">
                                    <select name="kategori_blog" id="kategori_blog" class="form-select mb-2"
                                        onchange="filterData()">
                                        <option value="">Kategori Blog</option>
                                        @if (auth()->user()->id_role === 1 || auth()->user()->id_role === 2)
                                            <option value="uncategorized">Uncategorized</option>
                                        @endif
                                        @foreach ($semua_kategori_blog as $kategori_blog)
                                            <option value="{{ $kategori_blog->id }}">{{ $kategori_blog->blog_category }}
                                            </option>
                                        @endforeach
                                        {{-- tambah option uncategorized --}}

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
                                        <th>Judul</th>
                                        <th>Penulis</th>
                                        @if ($route == 'blog-all-index')
                                            <th>Kategori</th>
                                        @endif
                                        <th>Action</th>
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
        $(document).ready(function() {

            filterData();

        });


        // fetch data all jam
        function filterData() {

            $.ajax({
                url: '{{ route('blog-filter') }}?kategori_blog=' + $('#kategori_blog').val() +
                    '&kepemilikan_blog=' + $('#kepemilikan_blog').val(),

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

                        editButton =
                            '<button class="btn btn-info btn-sm" id="btnEditData" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable" style="margin-right: 5px;" onclick="editData(' +
                            value.id +
                            ')"><i class="ri-edit-2-line align-middle me-1"></i><span style="vertical-align: middle">Edit</span></button>';

                        deleteButton =
                            '<button class="btn btn-danger btn-sm" id="delete" onclick="deleteData(' +
                            value.id +
                            ')"><i class="ri-delete-bin-2-line align-middle me-1"></i><span style="vertical-align: middle">Hapus</span></button>';

                        table.row.add([
                            (key + 1),
                            value.blog_title,
                            (value.id_user_for_blog == null ? '' : value.user.name),
                            (value.category == null ? '' : value.category.blog_category),
                            @if (Auth::user()->id_role == 1)
                                (value.id != '1' ? editButton + deleteButton : editButton),
                            @elseif (Auth::user()->id_role == 2)
                                (value.id_user_for_blog == '{{ Auth::user()->id }}' ?
                                    editButton + deleteButton : ''),
                            @elseif (Auth::user()->id_role == 3 || Auth::user()->id_role == 4)
                                (editButton + deleteButton),
                            @else
                                '',
                            @endif
                        ]).draw(false);
                    });
                    table.columns.adjust().draw();
                }
            });
        }

        // reset filter jam
        function resetFilter() {
            $('#kepemilikan_blog').val('{{ auth()->user()->id }}');
            $('#kategori_blog').val('');
            filterData();
        };

        // fungsi menampilkan modal tambah data jadwal pelajaran
        function tambahData() {

            // console.log(id);

            $.ajax({
                url: '/blog/tambah',
                type: 'GET',
                success: function(response) {
                    $('#content').html(response);
                    // modal title tulisan dari dropdown button yang dipilih
                    $('#exampleModalScrollableTitle').html('Tambah Data Blog');
                }
            });
        }

        // make delete function
        function deleteData(id) {
            if (confirm('Apakah anda yakin ingin menghapus data ini?')) {

                $.ajax({
                    url: '/blog/hapus/' + id,
                    type: 'get',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
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
                url: '/blog/edit/' + id,
                type: 'GET',
                success: function(response) {
                    $('#content').html(response);
                    // modal title
                    if (response.includes('Umum')) {
                        $('#exampleModalScrollableTitle').html('Ubah Data Blog Umum');
                    } else if (response.includes('Kegiatan Sekolah')) {
                        $('#exampleModalScrollableTitle').html('Ubah Data Blog Kegiatan Sekolah');
                    } else if (response.includes('Prestasi')) {
                        $('#exampleModalScrollableTitle').html('Ubah Data Blog Prestasi');
                    } else if (response.includes('Olahraga')) {
                        $('#exampleModalScrollableTitle').html('Ubah Data Blog Olahraga');
                    }
                }
            });
        }
    </script>
@endsection
