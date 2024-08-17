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
                            </div>

                            <hr style="margin: 0 0 1rem 0">


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
                                        <th>Nama</th>
                                        <th>NIS</th>
                                        <th>NISN</th>
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

            fetchData();

        });

        function fetchData() {
            $.ajax({
                url: '{{ route('rapor-fetch') }}',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var table = $('#datatable').DataTable();

                    if ($.fn.DataTable.isDataTable('#datatable')) {
                        table.clear();
                    }
                    var data = response.data;
                    $.each(data, function(key, value) {
                        var id_siswa = value.id_user_for_siswa; // Ensure this is the correct field for student ID
                        var printButton =
                            '<button class="btn btn-info btn-sm" id="btnCetak" style="margin-right: 5px;" onclick="cetakRapor(' +
                            id_siswa +
                            ')"><i class="ri-printer-line align-middle me-1"></i><span style="vertical-align: middle">Cetak Rapor</span></button>';

                        table.row.add([
                            (key + 1),
                            value.user.name,
                            value.nis_lokal,
                            value.nisn,
                            printButton
                        ]).draw(false);
                    });
                    table.columns.adjust().draw();
                }
            });
        }

        function cetakRapor(id_siswa) {
            var url = '/data-rapor/print?';

            if (id_siswa) {
                url += 'id_siswa=' + id_siswa;
            }

            window.open(url, '_blank');
        }
    </script>
@endsection
