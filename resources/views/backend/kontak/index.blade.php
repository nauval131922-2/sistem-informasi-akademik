@extends('backend.main')

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

                            <h4 class="card-title">Semua {{ $title }}</h4>
                            <p class="card-title-desc">Berikut adalah semua
                                {{ $title }}.
                            </p>

                            <hr style="margin: 0 0 1rem 0">

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="filterJam">Filter</label>
                                </div>
                            </div>
                            <div class="row justify-content-start">
                                <div class="col-md-4">
                                    <select name="statuss" id="statuss" class="form-select mb-2" onchange="filter()">
                                        <option value="">Status</option>
                                        <option value="Belum dibalas">Belum dibalas</option>
                                        <option value="Sudah dibalas">Sudah dibalas</option>
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
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Pesan</th>
                                        <th>Status</th>
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

    <script>
        $(document).ready(function() {

            filter();

        });

        // buatkan function fecthData
        function filter() {
            $.ajax({
                url: '{{ route('kontak-filter') }}?statuss=' + $('#statuss').val(),
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var table = $('#datatable').DataTable();

                    if ($.fn.DataTable.isDataTable('#datatable')) {
                        table.clear();
                    }
                    var data = response.data;
                    $.each(data, function(key, value) {
                        var balasViaEmail = '';
                        var gantiStatus = '';
                        var hapus = '';

                        balasViaEmail = (value.status == 'Belum dibalas') ?
                            '<a href="/kontak/balas/' + value.id +
                            '" class="btn btn-info btn-sm" target="_blank" style="margin-right: 5px;"><i class="ri-mail-send-line align-middle me-1"></i><span style="vertical-align: middle">Balas via Email</span></a>' :
                            '';

                        if (value.status == 'Belum dibalas') {
                            gantiStatus =
                                '<button class="btn btn-success btn-sm" id="btnGantiStatus" style="margin-right: 5px;" onclick="gantiStatus(' +
                                value.id +
                                ')"><i class="ri-check-line align-middle me-1"></i><span style="vertical-align: middle">Ganti Status</span></button>';
                        } else {
                            gantiStatus =
                                '<button class="btn btn-danger btn-sm" id="btnGantiStatus" style="margin-right: 5px;" onclick="gantiStatus(' +
                                value.id +
                                ')"><i class="ri-close-line align-middle me-1"></i><span style="vertical-align: middle">Ganti Status</span></button>';
                        }


                        deleteButton =
                            '<button class="btn btn-danger btn-sm" id="delete" onclick="deleteData(' +
                            value.id +
                            ')"><i class="ri-delete-bin-2-line align-middle me-1"></i><span style="vertical-align: middle">Hapus</span></button>';


                        table.row.add([
                            (key + 1),
                            value.name,
                            value.email,
                            decodeURIComponent(value.subject).substring(0, 25) + '...',
                            decodeURIComponent(value.message).substring(0, 25) + '...',
                            (value.status == 'Belum dibalas' ?
                                '<span class="btn btn-danger btn-sm"><i class="ri-close-line align-middle me-1"></i><span style="vertical-align: middle">' +
                                value.status + '</span></span>' :
                                '<span class="btn btn-success btn-sm"><i class="ri-check-line align-middle me-1"></i><span style="vertical-align: middle">' +
                                value.status + '</span></span>'),
                            @if (auth()->user()->can('admin'))
                                balasViaEmail + gantiStatus + deleteButton
                            @else
                                ''
                            @endif

                        ]).draw(false);
                    });
                    table.columns.adjust().draw();
                }
            });
        }

        function resetFilter() {
            $('#statuss').val('');
            filter();
        };

        function gantiStatus(id) {
            $.ajax({
                url: '/kontak/ganti/status/' + id,
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

                    filter();
                }
            });
        }

        function deleteData(id) {
            if (confirm('Apakah anda yakin ingin menghapus data ini?')) {

                $.ajax({
                    url: '/kontak/hapus/' + id,
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

                        filter();
                    }
                });
            }
        }
    </script>
@endsection
