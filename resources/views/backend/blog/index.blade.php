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

                            {{-- <h4 class="card-title">Semua {{ $title }}</h4>
                            <p class="card-title-desc" style="border-bottom: 1px solid rgb(161,179,191)">Berikut adalah semua
                                {{ $title }}.
                            </p>

                            @can('admin')
                                @if ($route != 'blog-all-index')
                                    <a class="btn btn-primary mb-3" href="{{ route('blog-tambah', $blog_category) }}"
                                        role="button">
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
                                        {{-- <button class="btn btn-primary dropdown-toggle" id="dropdownMenuLink"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-add-line align-middle me-1"></i>
                                            <span style="vertical-align: middle">Tambah</span>
                                        </button> --}}
                                        <div class="col-auto mb-2">
                                            <button class="btn btn-primary" role="button" data-bs-toggle="modal"
                                                data-bs-target="#exampleModalScrollable" id="btnTambahData" onclick="tambahData()">
                                                <i class="ri-add-line align-middle me-1"></i>
                                                <span style="vertical-align: middle">Tambah</span>
                                            </button>
                                        </div>


                                        {{-- <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                                            @foreach ($semua_kategori_blog as $kategori_blog)
                                                <li><button class="dropdown-item"
                                                        onclick="tambahData({{ $kategori_blog->id }})"
                                                        data-bs-toggle="modal" data-bs-target="#exampleModalScrollable"
                                                        id="buttonTambah">{{ $kategori_blog->blog_category }}</button>
                                            @endforeach


                                        </ul> --}}
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
                                        <option value="uncategorized">Uncategorized</option>
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
                                        {{-- @can('admin') --}}
                                        <th>Action</th>
                                        {{-- @endcan --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($semua_blog as $no => $blog)
                                        <tr>
                                            <td>{{ $no + 1 }}</td>
                                            <td>{{ $blog->blog_title }}</td>
                                            @if ($route == 'blog-all-index')
                                                <td>{{ $blog->category->blog_category }}</td>
                                            @endif
                                            @can('admin')
                                                <td>
                                                    <a href="{{ route('blog-edit', $blog->id) }}" class="btn btn-info btn-sm">
                                                        <i class="ri-edit-2-line align-middle me-1"></i>
                                                        <span style="vertical-align: middle">Edit</span>
                                                    </a>
                                                    @if ($blog->id != 1)
                                                        <a href="{{ route('blog-hapus', $blog->id) }}"
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
                url: '{{ route('blog-filter') }}?kategori_blog=' + $('#kategori_blog').val() +
                    '&kepemilikan_blog=' + $('#kepemilikan_blog').val(),

                // jika #kategori_blog == uncategorized, maka tampilkan semua blog yang tidak memiliki kategori
                // url: '{{ route('blog-filter') }}?kategori_blog=' + ($('#kategori_blog').val() == 'uncategorized' ? '' :
                //     $('#kategori_blog').val()) +
                //     '&kepemilikan_blog=' + $('#kepemilikan_blog').val(),

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
                            '<td>' + value.blog_title + '</td>' +
                            // jika value.user.name == null, maka tampilkan kosong
                            '<td>' + (value.id_user_for_blog == null ? '' : value.user.name) +
                            '</td>' +
                            '<td>' + (value.category == null ? '' : value.category.blog_category) +
                            '</td>' +
                            // jangan tampikan tombol delete jika id = 1
                            @if (Auth::user()->id_role == 1)
                                '<td>' + (value.id != '1'  ?
                                    editButton +
                                    deleteButton : editButton) + '</td>' +
                            @elseif (Auth::user()->id_role == 2)
                                '<td>' + (value.id_user_for_blog == '{{ Auth::user()->id }}' ?
                                    editButton + deleteButton : '') + '</td>' +
                            @endif
                            '</tr>');
                    });
                    $('#datatable').DataTable();
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
