@extends('backend.main')

@section('title')
    Dashboard | Semua {{ $title }}
@endsection

<?php
// get current route name
$route = Route::current()->getName();
$semua_tahun_ajaran = App\Models\TahunAjaran::all();
?>

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

                                        @can('admin')
                                            <button class="btn btn-primary dropdown-toggle" id="dropdownMenuLink"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-add-line align-middle me-1"></i>
                                                <span style="vertical-align: middle">Tambah</span>
                                            </button>
                                        @endcan

                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <li><button class="dropdown-item" onclick="tambahDataJadwalPelajaran()"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">Jadwal
                                                    Pelajaran</button></li>
                                            <li><button class="dropdown-item" onclick="tambahDataJadwalEkstra()"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">Jadwal
                                                    Ekstrakurikuler</button></li>
                                        </ul>
                                    </div>
                                </div>

                            </div>

                            <hr style="margin: 0 0 1rem 0">


                            <div class="row">
                                <div class="col-md-2">
                                    <label for="filterData">Filter</label>
                                </div>
                            </div>
                            <div class="row justify-content-start">

                                <div class="col-lg-2">
                                    <select name="tipe_jadwal" id="tipe_jadwal" class="form-select mb-2"
                                        onchange="filterData()">
                                        <option value="">Tipe Jadwal</option>
                                        <option value="Pelajaran">Jadwal Pelajaran</option>
                                        <option value="Ekstrakurikuler">Jadwal Ekstrakurikuler</option>
                                    </select>
                                </div>
                                @canany(['admin', 'kepala_madrasah', 'guru_wali', 'guru_mapel'])
                                    <div class="col-lg-2">
                                        <select name="kelas" id="kelas" class="form-select mb-2" onchange="filterData()">
                                            <option value="">Kelas</option>
                                            <option value="1">Kelas 1</option>
                                            <option value="2">Kelas 2</option>
                                            <option value="3">Kelas 3</option>
                                            <option value="4">Kelas 4</option>
                                            <option value="5">Kelas 5</option>
                                            <option value="6">Kelas 6</option>
                                        </select>
                                    </div>
                                @endcanany
                                {{-- filter tahun ajaran --}}
                                <div class="col-lg-2">
                                    <select name="tahun_ajaran" id="tahun_ajaran" class="form-select mb-2"
                                        onchange="filterData()">
                                        <option value="">Tahun Ajaran</option>
                                        @foreach ($semua_tahun_ajaran as $tahun_ajaran)
                                            <option value="{{ $tahun_ajaran->id }}">
                                                {{ $tahun_ajaran->semester }} {{ $tahun_ajaran->tahun }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <button class="btn btn-light" style="margin-right: 5px" onclick="resetFilter()">
                                        <i class="ri-refresh-line align-middle me-1"></i>
                                        <span style="vertical-align: middle">Reset</span>
                                    </button>
                                    {{-- button cetak filter --}}

                                    @if (auth()->user()->id_role != 2)
                                        <button class="btn btn-success" onclick="handleCetak()" id="btnCetak">
                                            <i class="ri-printer-line align-middle me-1"></i>
                                            <span style="vertical-align: middle">Cetak</span>
                                        </button>
                                    @endif

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

                            <table id="datatable"
                                class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline collapsed"
                                style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid"
                                aria-describedby="datatable-buttons_info">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Hari</th>
                                        <th>Kelas</th>
                                        @if ($route == 'jadwal-pelajaran-index' || $route == 'jadwal-pelajaran-all')
                                            <th>Mata Pelajaran</th>
                                        @endif
                                        @if ($route == 'jadwal-ekstra-index' || $route == 'jadwal-ekstra-all')
                                            <th>Ekstrakurikuler</th>
                                        @endif
                                        @if ($route == 'jadwal-all' || $route == 'jadwal-for-guru-wali-mapel-siswa-index')
                                            <th>Mata Pelajaran/Ekstrakurikuler</th>
                                        @endif
                                        @if ($route != 'jadwal-for-guru-wali-mapel-siswa-index')
                                            <th>Guru</th>
                                        @endif
                                        <th>Jam ke</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Selesai</th>
                                        <th>Tahun Ajaran</th>
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

            filterData();

        });


        // fungsi menampilkan modal tambah data jadwal pelajaran
        function tambahDataJadwalPelajaran() {

            $.ajax({
                url: '{{ route('jadwal-pelajaran-tambah') }}',
                type: 'GET',
                success: function(response) {
                    $('#content').html(response);
                    // modal title
                    $('#exampleModalScrollableTitle').html('Tambah Data Jadwal Pelajaran');
                }
            });
        }

        // fungsi menampilkan modal tambah data jadwal ekstrakurikuler
        function tambahDataJadwalEkstra() {

            $.ajax({
                url: '{{ route('jadwal-ekstra-tambah') }}',
                type: 'GET',
                success: function(response) {
                    $('#content').html(response);
                    // modal title
                    $('#exampleModalScrollableTitle').html('Tambah Data Jadwal Ekstrakurikuler');
                }
            });
        }

        // fetch data all jam
        function filterData() {

            $.ajax({
                url: '{{ route('jadwal-filter') }}?tipe_jadwal=' + $('#tipe_jadwal').val() +
                    '&kelas=' + $('#kelas').val() + '&tahun_ajaran=' + $('#tahun_ajaran').val() +
                    '&kepemilikan_jadwal=' + $(
                        '#kepemilikan_jadwal').val(),
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // $('#datatable').DataTable().destroy();
                    // $('#datatable tbody').empty();
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
                            value.hari,
                            value.kelas.nama,
                            (value.id_mapel_for_jadwal ? value.mapel.mata_pelajaran : value
                                .ekstra.nama),
                            value.user.name,
                            (value.id_jam_for_jadwal ? value.jam.jam_ke : '-'),
                            (value.id_jam_for_jadwal ? value.jam.jam_mulai : '-'),
                            (value.id_jam_for_jadwal ? value.jam.jam_selesai : '-'),
                            (value.id_tahun_ajaran_for_jadwal ? value.tahun_ajaran.semester +
                                ' ' + value.tahun_ajaran.tahun : '-'),
                            @if (auth()->user()->can('admin'))
                                editButton + deleteButton
                            @else
                                ''
                            @endif
                        ]).draw(false);
                    });
                    table.columns.adjust().draw();

                }
            });
        }

        // reset filter jam
        function resetFilter() {
            $('#kepemilikan_jadwal').val('{{ auth()->user()->id }}');
            $('#tipe_jadwal').val('');
            $('#kelas').val('');
            $('#tahun_ajaran').val('');
            filterData();
        };


        // make delete function
        function deleteData(id) {
            if (confirm('Apakah anda yakin ingin menghapus data ini?')) {

                $.ajax({
                    url: '/jadwal/hapus/' + id,
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
                url: '/jadwal/edit/' + id,
                type: 'GET',
                success: function(response) {
                    $('#content').html(response);
                    // modal title
                    if (response.includes('Jadwal Pelajaran')) {
                        $('#exampleModalScrollableTitle').html('Ubah Data Jadwal Pelajaran');
                    } else {
                        $('#exampleModalScrollableTitle').html('Ubah Data Jadwal Ekstrakurikuler');
                    }
                }
            });
        }

        // function cetak data
        function cetakData() {
            var tipe_jadwal = $('#tipe_jadwal').val();
            var kelas = $('#kelas').val();
            var tahun_ajaran = $('#tahun_ajaran').val();
            var kepemilikan_jadwal = $('#kepemilikan_jadwal').val();
            var url = '/jadwal/print?';
            if (tipe_jadwal) {
                url += 'tipe_jadwal=' + tipe_jadwal;
            }
            if (kelas) {
                url += '&kelas=' + kelas;
            }
            if (tahun_ajaran) {
                url += '&tahun_ajaran=' + tahun_ajaran;
            }
            if (kepemilikan_jadwal) {
                url += '&kepemilikan_jadwal=' + kepemilikan_jadwal;
            }
            window.open(url, '_blank');
        }

        function handleCetak() {
            var tipe_jadwal = $('#tipe_jadwal').val();
            var kelas = $('#kelas').val();
            var tahun_ajaran = $('#tahun_ajaran').val();
            var kepemilikan_jadwal = $('#kepemilikan_jadwal').val();
            var url2 = '/jadwal/cek-jumlah?';

            if (tipe_jadwal) {
                url2 += 'tipe_jadwal=' + tipe_jadwal;
            }
            if (kelas) {
                url2 += '&kelas=' + kelas;
            }
            if (tahun_ajaran) {
                url2 += '&tahun_ajaran=' + tahun_ajaran;
            }
            if (kepemilikan_jadwal) {
                url2 += '&kepemilikan_jadwal=' + kepemilikan_jadwal;
            }

            $.ajax({
                url: url2,
                type: 'GET',
                data: {
                    tipe_jadwal: tipe_jadwal,
                    kelas: kelas,
                    tahun_ajaran: tahun_ajaran,
                    kepemilikan_jadwal: kepemilikan_jadwal
                },
                contentType: 'application/json',
                success: function(response) {
                    if (response.status === 'error') {
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
                        cetakData();
                    }
                }
            });
        }
    </script>
@endsection
