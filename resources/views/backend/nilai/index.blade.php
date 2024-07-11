@extends('backend.main')

@section('title')
    Dashboard | Semua {{ $title }}
@endsection

@section('content')
    <?php
    // get route name
    $route = Route::currentRouteName();
    $semua_tahun_ajaran = App\Models\TahunAjaran::all();
    ?>


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
                                        {{ $title }}.</p>
                                    </p>

                                </div>

                                {{-- jika auth user id role tidak sama dengan 5 (siswa) --}}
                                @if (Auth::user()->id_role != 5 && Auth::user()->id_role != 2)
                                    <div class="col-auto mb-2">
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" id="dropdownMenuLink"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-add-line align-middle me-1"></i>
                                                <span style="vertical-align: middle">Tambah</span>
                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <li><button class="dropdown-item" onclick="tambahDataNilaiUlanganHarian()"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#exampleModalScrollable">Nilai
                                                        Ulangan Harian</button></li>
                                                <li><button class="dropdown-item" onclick="tambahDataNilaiTugas()"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#exampleModalScrollable">Nilai
                                                        Tugas</button></li>
                                                <li><button class="dropdown-item" onclick="tambahDataNilaiUts()"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#exampleModalScrollable">Nilai
                                                        UTS</button></li>
                                                <li><button class="dropdown-item" onclick="tambahDataNilaiUas()"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#exampleModalScrollable">Nilai
                                                        UAS</button></li>
                                                <li><button class="dropdown-item" onclick="tambahDataNilaiUjian()"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#exampleModalScrollable">Nilai
                                                        Ujian</button></li>
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                            </div>

                            <hr style="margin: 0 0 1rem 0">


                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="filterData">Filter</label>
                                </div>
                            </div>
                            <div class="row justify-content-start">
                                <div class="col-lg-2">
                                    <select name="tipe_nilai" id="tipe_nilai" class="form-select mb-2"
                                        onchange="filterData()">
                                        <option value="">Tipe Nilai</option>
                                        <option value="Ulangan Harian">Ulangan Harian</option>
                                        <option value="Tugas">Tugas</option>
                                        <option value="UTS">UTS</option>
                                        <option value="UAS">UAS</option>
                                        <option value="Ujian">Ujian</option>
                                    </select>
                                </div>
                                {{-- jika auth user id role tidak sama dengan 5 (siswa) --}}
                                @if (Auth::user()->id_role != 5)
                                    <div class="col-lg-2">
                                        <select name="kelas" id="kelas" class="form-select mb-2"
                                            onchange="filterData()">
                                            <option value="">Kelas</option>
                                            <option value="1">Kelas 1</option>
                                            <option value="2">Kelas 2</option>
                                            <option value="3">Kelas 3</option>
                                            <option value="4">Kelas 4</option>
                                            <option value="5">Kelas 5</option>
                                            <option value="6">Kelas 6</option>
                                        </select>
                                    </div>
                                @endif
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
                                        <th>Kelas</th>
                                        <th>KD</th>
                                        <th>Judul</th>
                                        <th>Siswa</th>
                                        <th>Guru</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Nilai</th>
                                        <th>Tipe Nilai</th>
                                        <th>Tahun Ajaran</th>
                                        @canany(['admin', 'guru_wali', 'guru_mapel'])
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
        $(document).ready(function() {

            filterData();

        });

        // fetch data all jam
        function filterData() {

            $.ajax({
                url: '{{ route('nilai-filter') }}?tipe_nilai=' + $('#tipe_nilai').val() +
                    '&kelas=' + $('#kelas').val() + '&tahun_ajaran=' + $('#tahun_ajaran').val() + '&guru=' + $(
                        '#guru').val(),
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
                            value.kelas.nama,
                            value.kompetensi_dasar,
                            value.judul,
                            value.siswa ? value.siswa.name :
                            null, // Check if value.siswa exists
                            value.guru ? value.guru.name : null, // Check if value.guru exists
                            value.mapel.mata_pelajaran,
                            value.nilai,
                            value.tipe_nilai,
                            (value.id_tahun_ajaran_for_nilai ? value.tahun_ajaran.semester +
                                ' ' + value.tahun_ajaran.tahun : '-'),
                            @if (Auth::user()->id_role == 1)
                                '<td>' + editButton + deleteButton + '</td>',
                            @elseif (Auth::user()->id_role == 2 || Auth::user()->id_role == 3 || Auth::user()->id_role == 4)
                                '<td>' + (value.id_guru_for_nilai == '{{ Auth::user()->id }}' ?
                                    editButton + deleteButton : '') + '</td>',
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
            $('#guru').val('{{ Auth::user()->id }}');
            $('#tipe_nilai').val('');
            $('#kelas').val('');
            $('#tahun_ajaran').val('');
            filterData();
        };

        // fungsi menampilkan modal tambah data nilai ulangan harian
        function tambahDataNilaiUlanganHarian() {

            $.ajax({
                url: '{{ route('nilai-ulangan-harian-tambah') }}',
                type: 'GET',
                success: function(response) {
                    $('#content').html(response);
                    // modal title
                    $('#exampleModalScrollableTitle').html('Tambah Data Nilai Ulangan Harian');
                }
            });
        }

        // fungsi menampilkan modal tambah data nilai tugas
        function tambahDataNilaiTugas() {

            $.ajax({
                url: '{{ route('nilai-tugas-tambah') }}',
                type: 'GET',
                success: function(response) {
                    $('#content').html(response);
                    // modal title
                    $('#exampleModalScrollableTitle').html('Tambah Data Nilai Tugas');
                }
            });
        }

        // function menampilkan modal tambah data nilai uts
        function tambahDataNilaiUts() {

            $.ajax({
                url: '{{ route('nilai-uts-tambah') }}',
                type: 'GET',
                success: function(response) {
                    $('#content').html(response);
                    // modal title
                    $('#exampleModalScrollableTitle').html('Tambah Data Nilai UTS');
                }
            });
        }

        // function menampilkan modal tambah data nilai uas
        function tambahDataNilaiUas() {

            $.ajax({
                url: '{{ route('nilai-uas-tambah') }}',
                type: 'GET',
                success: function(response) {
                    $('#content').html(response);
                    // modal title
                    $('#exampleModalScrollableTitle').html('Tambah Data Nilai UAS');
                }
            });
        }

        function tambahDataNilaiUjian() {

            $.ajax({
                url: '{{ route('nilai-ujian-tambah') }}',
                type: 'GET',
                success: function(response) {
                    $('#content').html(response);
                    // modal title
                    $('#exampleModalScrollableTitle').html('Tambah Data Nilai Ujian');
                }
            });
        }

        // make delete function
        function deleteData(id) {
            if (confirm('Apakah anda yakin ingin menghapus data ini?')) {

                $.ajax({
                    url: '/data-nilai/hapus/' + id,
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
                url: '/data-nilai/edit/' + id,
                type: 'GET',
                success: function(response) {
                    $('#content').html(response);
                    // modal title
                    if (response.includes('Data Nilai Ulangan Harian')) {
                        $('#exampleModalScrollableTitle').html('Ubah Data Nilai Ulangan Harian');
                    } else if (response.includes('Data Nilai Tugas')) {
                        $('#exampleModalScrollableTitle').html('Ubah Data Nilai Tugas');
                    } else if (response.includes('Data Nilai UTS')) {
                        $('#exampleModalScrollableTitle').html('Ubah Data Nilai UTS');
                    } else if (response.includes('Data Nilai UAS')) {
                        $('#exampleModalScrollableTitle').html('Ubah Data Nilai UAS');
                    } else if (response.includes('Data Nilai Ujian')) {
                        $('#exampleModalScrollableTitle').html('Ubah Data Nilai Ujian');
                    }
                }
            });
        }
    </script>
@endsection
