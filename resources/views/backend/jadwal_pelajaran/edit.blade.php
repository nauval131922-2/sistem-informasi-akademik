@php

@endphp

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">

            <p class="card-title-desc" style="border-bottom: 1px solid rgb(161,179,191)">Lengkapi form
                berikut untuk mengubah {{ $title }}. <small class="text-danger">* Harus diisi</small></p>

            <form enctype="multipart/form-data" id="formUbahData" method="POST">
                @csrf
                <input type="hidden" name="id" id="id" value="{{ $jadwal->id }}"">
                <div class="row mb-3">
                    <label for="kelas" class="col-sm-2 col-form-label">Kelas <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select class="form-select" id="kelas" name="kelas" required>
                            <option value="">Pilih Kelas</option>
                            @foreach ($semua_kelas as $kelas)
                                @if ($jadwal->id_kelas_for_jadwal == $kelas->id ?? old('kelas') == $kelas->id)
                                    <option value="{{ $kelas->id }}" selected>{{ $kelas->nama }}</option>
                                @else
                                    <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="mt-2">
                            <span class="text-danger error-text kelas_error"></span>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="hari" class="col-sm-2 col-form-label">Hari <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select class="form-select" class="form-control" id="hari" name="hari" required>
                            <option value="">Pilih Hari</option>
                            @foreach ($semua_hari as $hari)
                                @if ($jadwal->hari == $hari ?? old('hari') == $hari)
                                    <option value="{{ $hari }}" selected>{{ $hari }}
                                    </option>
                                @else
                                    <option value="{{ $hari }}">{{ $hari }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="mt-2">
                            <span class="text-danger error-text hari_error"></span>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="guru" class="col-sm-2 col-form-label">Guru <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select class="form-select" id="guru" name="guru" required>
                            <option value="">Pilih Guru</option>
                            @foreach ($semua_guru as $guru)
                                @if ($jadwal->id_guru_for_jadwal == $guru->id ?? old('guru') == $guru->id)
                                    <option value="{{ $guru->id }}" selected>{{ $guru->name }}
                                    </option>
                                @else
                                    <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="mt-2">
                            <span class="text-danger error-text guru_error"></span>
                        </div>
                    </div>
                </div>

                @if ($jadwal->tipe_jadwal == 'Pelajaran')
                    <div id="mapel-container"></div>
                @endif
                @if ($jadwal->tipe_jadwal == 'Ekstrakurikuler')
                    <div class="row mb-3">
                        <label for="ekstra" class="col-sm-2 col-form-label">Ekstrakurikuler <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select class="form-select" id="ekstra" name="ekstra" required>
                                <option value="">Pilih Eksrakuriler</option>
                                @foreach ($semua_ekstra as $ekstra)
                                    @if ($jadwal->id_ekstra_for_jadwal == $ekstra->id ?? old('ekstra') == $ekstra->id)
                                        <option value="{{ $ekstra->id }}" selected>{{ $ekstra->nama }}
                                        </option>
                                    @else
                                        <option value="{{ $ekstra->id }}">{{ $ekstra->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <div class="mt-2">
                                <span class="text-danger error-text ekstra_error"></span>
                            </div>
                        </div>
                    </div>
                @endif


                <div class="row mb-3">
                    <label for="jam_ke" class="col-sm-2 col-form-label">Jam ke <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select class="form-select" id="jam_ke" name="jam_ke" required>
                            <option value="">Pilih Jam ke</option>
                            @foreach ($semua_jam_pelajaran as $jam_pelajaran)
                                @if ($jadwal->id_jam_for_jadwal == $jam_pelajaran->id ?? old('jam_ke') == $jam_pelajaran->id)
                                    <option value="{{ $jam_pelajaran->id }}" selected>
                                        {{ $jam_pelajaran->jam_ke }}</option>
                                @else
                                    <option value="{{ $jam_pelajaran->id }}">{{ $jam_pelajaran->jam_ke }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        <div class="mt-2">
                            <span class="text-danger error-text jam_ke_error"></span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-info waves-effect waves-light">
                    <i class="ri-refresh-line align-middle me-1"></i>
                    <span style="vertical-align: middle">Update</span>
                </button>
            </form>

        </div>
    </div>
</div> <!-- end col -->

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var id = $('#id').val();

        if (id) {
            $.ajax({
                url: '/getGuruInfo/' +
                    id, // Ganti dengan URL yang sesuai untuk mendapatkan data guru
                type: 'GET',
                success: function(response) {
                    $('#mapel-container').html('');

                    if (response.id_role == 4) {
                        $('#mapel-container').html(`
                                <input type="hidden" name="mapel" value="${response.id_mapel}">
                                <div class="row mb-3">
                                    <label for="mapell" class="col-md-2 col-form-label">Mata Pelajaran <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="mapell" id="mapell"
                                            placeholder="Masukkan mata pelajaran" value="${response.mapel}"
                                            required disabled>
                                        <div class="mt-2">
                                            <span class="text-danger error-text mapell_error"></span>
                                        </div>
                                    </div>
                                </div>
                            `);
                    } else {
                        var mapelOptions =
                                '<option value="">Pilih Mata Pelajaran</option>';
                            response.semua_mapel.forEach(function(mapel) {
                                var selected = '';
                                if (response.selected_mapel_id && response.selected_mapel_id == mapel.id) {
                                    selected = 'selected';
                                }
                                mapelOptions += `
                                    <option value="${mapel.id}" ${selected}>${mapel.mata_pelajaran}</option>
                                `;
                            });

                        $('#mapel-container').html(`
                                <input type="hidden" name="tipe_jadwal" value="Pelajaran">
                                <div class="row mb-3">
                                    <label for="mapel" class="col-sm-2 col-form-label">Mata Pelajaran <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="mapel" name="mapel" required>
                                            ${mapelOptions}
                                        </select>
                                        <div class="mt-2">
                                            <span class="text-danger error-text mapel_error"></span>
                                        </div>
                                    </div>
                                </div>
                            `);
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        } else {
            $('#mapel-container').html('');
        }

    });

    $('#guru').change(function() {
        var id = $('#id').val();

        if (id) {
            $.ajax({
                url: '/getGuruInfo/' +
                    id, // Ganti dengan URL yang sesuai untuk mendapatkan data guru
                type: 'GET',
                success: function(response) {
                    $('#mapel-container').html('');

                    if (response.id_role == 4) {
                        $('#mapel-container').html(`
                                <input type="hidden" name="mapel" value="${response.id_mapel}">
                                <div class="row mb-3">
                                    <label for="mapell" class="col-md-2 col-form-label">Mata Pelajaran <span class="text-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" name="mapell" id="mapell"
                                            placeholder="Masukkan mata pelajaran" value="${response.mapel}"
                                            required disabled>
                                        <div class="mt-2">
                                            <span class="text-danger error-text mapell_error"></span>
                                        </div>
                                    </div>
                                </div>
                            `);
                    } else {
                        var mapelOptions =
                                '<option value="">Pilih Mata Pelajaran</option>';
                            response.semua_mapel.forEach(function(mapel) {
                                var selected = '';
                                if (response.selected_mapel_id && response.selected_mapel_id == mapel.id) {
                                    selected = 'selected';
                                }
                                mapelOptions += `
                                    <option value="${mapel.id}" ${selected}>${mapel.mata_pelajaran}</option>
                                `;
                            });

                        $('#mapel-container').html(`
                                <input type="hidden" name="tipe_jadwal" value="Pelajaran">
                                <div class="row mb-3">
                                    <label for="mapel" class="col-sm-2 col-form-label">Mata Pelajaran <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="mapel" name="mapel" required>
                                            ${mapelOptions}
                                        </select>
                                        <div class="mt-2">
                                            <span class="text-danger error-text mapel_error"></span>
                                        </div>
                                    </div>
                                </div>
                            `);
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        } else {
            $('#mapel-container').html('');
        }
    });

    // update data
    $('#formUbahData').on('submit', function(e) {
        e.preventDefault();

        var id = {{ $jadwal->id }};
        let formData = new FormData($('#formUbahData')[0]);

        $.ajax({
            url: '/jadwal/update/' + id,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $(document).find('span.error-text').text('');
            },
            success: function(response) {

                if (response.status == 'error') {
                    $.each(response.message, function(prefix, val) {
                        $('span.' + prefix + '_error').text(val[0]);
                    });
                } else if (response.status == 'error2' || response.status == 'error3') {
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

                    // hide modal
                    $('#exampleModalScrollable').modal('hide');

                    // fetch data
                    filterData();
                }
            }
        })

    })
</script>
