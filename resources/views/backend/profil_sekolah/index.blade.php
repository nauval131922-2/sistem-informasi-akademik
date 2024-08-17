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
                                untuk mengubah {{ $title }}. <small class="text-danger">* Harus diisi</small></p>
                            <form enctype="multipart/form-data" id="formUbahData" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Masukkan nama sekolah"
                                            id="nama" name="nama" value="" required>
                                        <div class="mt-2">
                                            <span class="text-danger error-text nama_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="npsn" class="col-sm-2 col-form-label">NPSN</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Masukkan NPSN"
                                            id="npsn" name="npsn" value="">
                                        <div class="mt-2">
                                            <span class="text-danger error-text npsn_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Masukkan alamat sekolah"
                                            id="alamat" name="alamat" value="" required>
                                        <div class="mt-2">
                                            <span class="text-danger error-text alamat_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="desa_kelurahan" class="col-sm-2 col-form-label">Desa/Kelurahan</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Masukkan desa/kelurahan sekolah"
                                            id="desa_kelurahan" name="desa_kelurahan" value="">
                                        <div class="mt-2">
                                            <span class="text-danger error-text desa_kelurahan_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Masukkan kecamatan sekolah"
                                            id="kecamatan" name="kecamatan" value="">
                                        <div class="mt-2">
                                            <span class="text-danger error-text kecamatan_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="kota_kabupaten" class="col-sm-2 col-form-label">Kota/Kabutapen</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Masukkan kota/kabupaten sekolah"
                                            id="kota_kabupaten" name="kota_kabupaten" value="">
                                        <div class="mt-2">
                                            <span class="text-danger error-text kota_kabupaten_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="provinsi" class="col-sm-2 col-form-label">Provinsi</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Masukkan provinsi sekolah"
                                            id="provinsi" name="provinsi" value="">
                                        <div class="mt-2">
                                            <span class="text-danger error-text provinsi_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="website" class="col-sm-2 col-form-label">Website</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Masukkan website sekolah"
                                            id="website" name="website" value="">
                                        <div class="mt-2">
                                            <span class="text-danger error-text website_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="nomor_hp" class="col-sm-2 col-form-label">Nomor HP</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Masukkan nomor HP sekolah"
                                            id="nomor_hp" name="nomor_hp" value="">
                                        <div class="mt-2">
                                            <span class="text-danger error-text nomor_hp_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Masukkan email sekolah"
                                            id="email" name="email" value="">
                                        <div class="mt-2">
                                            <span class="text-danger error-text email_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="twitter" class="col-sm-2 col-form-label">Twitter</label>
                                    <div class="col-sm-10">
                                        <input type="text" placeholder="Masukkan link akun Twitter" class="form-control"
                                            id="twitter" name="twitter" value="">
                                        <div class="mt-2">
                                            <span class="text-danger error-text twitter_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="facebook" class="col-sm-2 col-form-label">Facebook</label>
                                    <div class="col-sm-10">
                                        <input type="text" placeholder="Masukkan link akun Facebook" class="form-control"
                                            id="facebook" name="facebook" value="">
                                        <div class="mt-2">
                                            <span class="text-danger error-text facebook_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="youtube" class="col-sm-2 col-form-label">YouTube</label>
                                    <div class="col-sm-10">
                                        <input type="text" placeholder="Masukkan link akun YouTube" class="form-control"
                                            id="youtube" name="youtube" value="">
                                        <div class="mt-2">
                                            <span class="text-danger error-text youtube_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="instagram" class="col-sm-2 col-form-label">Instagram</label>
                                    <div class="col-sm-10">
                                        <input type="text" placeholder="Masukkan link akun Instagram"
                                            class="form-control" id="instagram" name="instagram" value="">
                                        <div class="mt-2">
                                            <span class="text-danger error-text instagram_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="visi" class="col-sm-2 col-form-label">Visi</label>
                                    <div class="col-sm-10">
                                        <input id="visi" type="hidden" name="visi" value="">
                                        <trix-editor input="visi"></trix-editor>
                                        <div class="mt-2">
                                            <span class="text-danger error-text visi_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="misi" class="col-sm-2 col-form-label">Misi</label>
                                    <div class="col-sm-10">
                                        <input id="misi" type="hidden" name="misi" value="">
                                        <trix-editor input="misi"></trix-editor>
                                        <div class="mt-2">
                                            <span class="text-danger error-text misi_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="tujuan" class="col-sm-2 col-form-label">Tujuan</label>
                                    <div class="col-sm-10">
                                        <input id="tujuan" type="hidden" name="tujuan" value="">
                                        <trix-editor input="tujuan"></trix-editor>
                                        <div class="mt-2">
                                            <span class="text-danger error-text tujuan_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="gambar" class="col-sm-2 col-form-label">Logo</label>
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
                                        <img src="
                                @if ($profil_sekolah->logo) {{ asset($profil_sekolah->logo) }} @endif"
                                            alt="" class="img-thumbnail" width="200" id="showImage">
                                        <input type="hidden" value="{{ $profil_sekolah->logo }}" id="gambarPreview"
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

        // Route::get('/profil-sekolah/fetch', 'fetch')->name('profil-sekolah-fetch');
        function fetchData() {

            $.ajax({
                url: '{{ route('profil-sekolah-fetch') }}',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    let data = response.data;
                    $('#nama').val(data.nama);
                    $('#alamat').val(data.alamat);
                    $('#nomor_hp').val(data.hp);
                    $('#email').val(data.email);
                    $('#twitter').val(data.twitter);
                    $('#facebook').val(data.facebook);
                    $('#instagram').val(data.instagram);
                    $('#youtube').val(data.youtube);
                    // $('#visi').val(data.visi);

                    $('#visi').nextAll('trix-editor').remove(); // hapus Trix Editor yang sudah ada
                    $('.trix-button-row, .trix-toolbar').remove(); // hapus toolbar Trix Editor yang tersisa
                    let editor = '<trix-editor input="visi"></trix-editor>';
                    $('#visi').after(editor); // tambahkan Trix Editor baru
                    $('#visi')[0].value = data.visi; // isi nilai dari input biasa

                    // $('#misi').val(data.misi);

                    $('#misi').nextAll('trix-editor').remove(); // hapus Trix Editor yang sudah ada
                    // $('.trix-button-row, .trix-toolbar').remove(); // hapus toolbar Trix Editor yang tersisa
                    let editor2 = '<trix-editor input="misi"></trix-editor>';
                    $('#misi').after(editor2); // tambahkan Trix Editor baru
                    $('#misi')[0].value = data.misi; // isi nilai dari input biasa

                    // $('#tujuan').val(data.tujuan);

                    $('#tujuan').nextAll('trix-editor').remove(); // hapus Trix Editor yang sudah ada
                    // $('.trix-button-row, .trix-toolbar').remove(); // hapus toolbar Trix Editor yang tersisa
                    let editor3 = '<trix-editor input="tujuan"></trix-editor>';
                    $('#tujuan').after(editor3); // tambahkan Trix Editor baru
                    $('#tujuan')[0].value = data.tujuan; // isi nilai dari input biasa


                    $('#gambarPreview').val(data.logo);
                    $('#showImage').attr('src', '{{ asset('') }}' + data.logo);

                }

            });
        }

        // Route::post('/profil-sekolah/update/{id}', 'update')->name('profil-sekolah-update');
        $('#formUbahData').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData($('#formUbahData')[0]);
            var id = {{ $profil_sekolah->id }};

            $.ajax({
                url: '/profil-sekolah/update/' + id,
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
