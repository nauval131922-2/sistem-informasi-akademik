@extends('backend.main')

@section('title')
    Dashboard | Ubah {{ $title }}
@endsection

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Ubah {{ $title }}</h4>
                            <p class="card-title-desc" style="border-bottom: 1px solid rgb(161,179,191)">Lengkapi form berikut
                                untuk mengubah data {{ $title }}. <small class="text-danger">* Harus diisi</small></p>
                            <form enctype="multipart/form-data" id="formUbahData" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <label for="judul" class="col-sm-2 col-form-label">Judul <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="judul" name="judul"
                                            value="" placeholder="Masukkan judul" required>
                                        <div class="mt-2">
                                            <span class="text-danger error-text judul_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="isi" class="col-sm-2 col-form-label">Isi <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input id="isi" type="hidden" name="isi" value="">
                                        <trix-editor input="isi"></trix-editor>
                                        <div class="mt-2">
                                            <span class="text-danger error-text isi_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <input class="form-control" type="file" id="gambar" name="gambar"
                                                accept="image/*">
                                            <button class="btn btn-outline-secondary" type="button"
                                                id="inputGroupFileAddon04" onclick="clearFile()">
                                                <i class="ri-delete-bin-7-line align-middle me-1"></i>
                                                <span style="vertical-align: middle">Clear Image</span>
                                            </button>
                                            <div class="mt-2">
                                                <span class="text-danger error-text gambar_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="showImage" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img src="" alt="{{ $sambutan->nama }}" class="img-thumbnail" width="200"
                                            id="showImage">
                                        <input type="hidden" value="{{ $sambutan->gambar }}" id="gambarPreview"
                                            name="gambarPreview">
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
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            fetchData();

        });

        // Route::get('/data-sambutan-kepala-madrasah/fetch', 'fetch')->name('sambutan-kepala-madrasah-fetch');
        function fetchData() {

            $.ajax({
                url: '{{ route('sambutan-kepala-madrasah-fetch') }}',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    let sambutan = response.data;
                    $('#judul').val(sambutan.judul);
                    $('#gambarPreview').val(sambutan.gambar);
                    $('#showImage').attr('src', sambutan.gambar);
                    $('#isi').nextAll('trix-editor').remove(); // hapus Trix Editor yang sudah ada
                    $('.trix-button-row, .trix-toolbar').remove(); // hapus toolbar Trix Editor yang tersisa
                    let editor = '<trix-editor input="isi"></trix-editor>';
                    $('#isi').after(editor); // tambahkan Trix Editor baru
                    $('#isi')[0].value = sambutan.isi; // isi nilai dari input biasa
                }

            });
        }

        // Route::post('/data-sambutan-kepala-madrasah/update/{id}', 'update')->name('sambutan-kepala-madrasah-update');
        $('#formUbahData').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData($('#formUbahData')[0]);
            var id = {{ $sambutan->id }};

            $.ajax({
                url: '/data-sambutan-kepala-madrasah/update/' + id,
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
                    } else if (response.status == 'error2') {
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
                        fetchData();
                    }
                }
            })

        })
    </script>
@endsection
