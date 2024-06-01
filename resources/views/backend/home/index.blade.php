@extends('backend.main')

@section('title')
    Dashboard | {{ $title }}
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            {{-- welcome message after login --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Selamat Datang {{ Auth::user()->name }} 👋</h4>
                            @if (Auth::user()->id_role === 1 || Auth::user()->id_role === 2)
                                <p class="mb-0">{{ Auth::user()->role->nama }}</p>
                            @elseif(Auth::user()->id_role === 3 || Auth::user()->id_role === 5)
                                <p class="mb-0">{{ Auth::user()->role->nama }} {{ Auth::user()->kelas->nama }}</p>
                            @elseif(Auth::user()->id_role === 4)
                                <p class="mb-0">{{ Auth::user()->role->nama }} {{ Auth::user()->mapel->mata_pelajaran }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{-- end welcome message after login --}}

            @canany(['admin', 'kepala_madrasah'])
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Total Pengguna</p>
                                        <h4 class="mb-2">{{ $semua_user->count() }}</h4>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="fas fa-users"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Total Guru</p>
                                        <h4 class="mb-2">{{ $semua_guru }}</h4>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-success rounded-3">
                                            <i class="fas fa-chalkboard-teacher"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Total Siswa</p>
                                        <h4 class="mb-2">{{ $semua_user->where('id_role', '5')->count() }}</h4>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="fas fa-user-graduate"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Total Mata Pelajaran</p>
                                        <h4 class="mb-2">{{ $semua_mata_pelajaran->count() }}</h4>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-primary rounded-3">
                                            <i class="fas fa-book"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div><!-- end row -->
                <div class="row">

                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 mb-2">Total Ekstrakurikuler</p>
                                        <h4 class="mb-2">{{ $semua_ekstrakurikuler->count() }}</h4>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-success rounded-3">
                                            <i class="fas fa-book-reader"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div><!-- end row -->
            @endcan

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            {{-- <h4 class="mb-3" style="padding-bottom: 5px; border-bottom: 1px solid rgb(161,179,191)">{{ $pengumuman->judul }}</h4> --}}

                            <div class="row">
                                <div class="col-auto me-auto" id="judulPengumuman">
                                    {{-- <h4>{{ $pengumuman->judul }}</h4> --}}
                                </div>

                                {{-- can untuk admin dan kepala madrasah --}}
                                @canany(['admin', 'kepala_madrasah'])
                                    <div class="col-auto mb-2">
                                        <div class="dropdown">
                                            <button class="btn btn-info btn-sm" onclick="editData()" data-bs-toggle="modal"
                                                data-bs-target="#exampleModalScrollable">
                                                <i class="ri-edit-2-line align-middle me-1"></i>
                                                <span style="vertical-align: middle">Edit</span>
                                            </button>
                                        </div>
                                    </div>
                                @endcan

                            </div>

                            <hr style="margin: 0 0 1rem 0">

                            <div id="pengumuman">
                                {{-- <h6 class="card-subtitle mb-3 text-muted mt-3">
                                    <i class="mdi mdi-calendar-clock mr-1"></i>
                                    {{ $pengumuman->updated_at->diffForHumans() }} |
                                    {{ $pengumuman->updated_at->format('d-m-Y') }}
                                </h6>

                                @if ($pengumuman->gambar)
                                    <div>
                                        <img src="{{ asset($pengumuman->gambar) }}" class="img-fluid rounded">
                                    </div>
                                @else
                                    <div>
                                        <img src="https://source.unsplash.com/1280x720?quote" class="img-fluid rounded">
                                    </div>
                                @endif

                                <p>
                                    {!! $pengumuman->isi !!}
                                </p> --}}
                            </div>

                        </div><!-- end card -->
                    </div><!-- end card -->
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

            fetchData();

        });

        // fetch data all jam
        function fetchData() {

            $.ajax({
                url: '{{ route('pengumuman-fetch') }}',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    let pengumuman = response.data;
                    let judulPengumuman = '<h4>' + pengumuman.judul + '</h4>';
                    let html = `
        <h6 class="card-subtitle mb-3 text-muted mt-3">
            <i class="mdi mdi-calendar-clock mr-1"></i>
            ${pengumuman.updated_at_diff_for_humans} |
            ${pengumuman.updated_at_date_format}
        </h6>
        ${pengumuman.gambar ?
            `<div><img src="${pengumuman.gambar}" class="img-fluid rounded"></div>` :
            `<div><img src="https://source.unsplash.com/1920x1080?quote" class="img-fluid rounded"></div>`
        }
        <p>${pengumuman.isi}</p>
        `;
                    $('#pengumuman').html(html);
                    $('#judulPengumuman').html(judulPengumuman);
                }

            });
        }

        // menampilkan modal edit data
        function editData() {
            $.ajax({
                url: '{{ route('pengumuman-index') }}',
                type: 'GET',
                success: function(response) {
                    $('#content').html(response);
                    // modal title
                    $('#exampleModalScrollableTitle').html('Ubah Data Pengumuman');
                }
            });
        }
    </script>
@endsection
