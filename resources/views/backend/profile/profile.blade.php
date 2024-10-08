@extends('backend.main')

@section('title')
    Dashboard | {{ $title }}
@endsection

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">{{ $title }}</h4>
                            <p class="card-title-desc" style="border-bottom: 1px solid rgb(161,179,191)">Berikut adalah
                                {{ $title }}.</p>

                            <form enctype="multipart/form-data" id="formUbahData" method="POST">
                                @csrf


                                <div class="row mb-4">
                                    <label for="showImage" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-12 text-center">
                                        <img src="" alt="" class="img-thumbnail" width="100"
                                            id="showImage">
                                        <input type="hidden" value="{{ $user->profile_image }}" id="gambarPreview"
                                            name="gambarPreview">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="mt-2">
                                        <small class="text-danger"
                                            style="background:
                                    #f8f9fa; padding: 5px; border-radius: 5px;
                                    ">* Harus diisi</small>

                                    </div>
                                </div>
                                <hr>

                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Nama <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="name" id="name"
                                            value="" placeholder="Masukkan nama lengkap anda" required>
                                        <div class="mt-2">
                                            <span class="text-danger error-text name_error"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="email" name="email" id="email"
                                            value="" placeholder="Masukkan email anda">
                                        <div class="mt-2">
                                            <span class="text-danger error-text email_error"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="username" class="col-sm-2 col-form-label">Username <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="username" id="username"
                                            value="" placeholder="Masukkan username anda" required>
                                        <div class="mt-2">
                                            <span class="text-danger error-text username_error"></span>
                                        </div>
                                    </div>
                                </div>

                                {{-- old password --}}
                                <div class="row mb-3">
                                    <label for="oldpassword" class="col-sm-2 col-form-label">Old Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" name="oldpassword" id="oldpassword"
                                            placeholder="Masukkan password lama anda">
                                        <div class="mt-2">
                                            <span class="text-danger error-text oldpassword_error"></span>
                                        </div>
                                    </div>
                                </div>

                                {{-- new password --}}
                                <div class="row mb-3">
                                    <label for="newpassword" class="col-sm-2 col-form-label">New Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" name="newpassword" id="newpassword"
                                            placeholder="Masukkan password baru anda">
                                        {{-- tambahi kalimat kosongi jika tidak ingin mengubah password --}}
                                        <div class="mt-2">
                                            <small class="text-danger"
                                                style="background:
                                        #f8f9fa; padding: 5px; border-radius: 5px;
                                        ">Kosongi
                                                jika tidak ingin mengubah password</small>

                                        </div>

                                        <div class="mt-2">
                                            <span class="text-danger error-text newpassword_error"></span>
                                        </div>
                                    </div>
                                </div>

                                {{-- confirm password --}}
                                <div class="row mb-3">
                                    <label for="confirmpassword" class="col-sm-2 col-form-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" name="confirmpassword"
                                            id="confirmpassword" placeholder="Masukkan konfirmasi password baru anda">
                                        <span class="text-danger error-text confirmpassword_error"></span>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="gambar" class="col-sm-2 col-form-label">Profile Image</label>
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


                                <button type="submit" class="btn btn-info waves-effect waves-light">
                                    <i class="ri-refresh-line align-middle me-1"></i>
                                    <span style="vertical-align: middle">Update</span>
                                </button>

                            </form>
                            <!-- end row -->

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

        function fetchData() {

            $.ajax({
                url: '{{ route('profile-fetch') }}',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    let profile = response.data;
                    $('#name').val(profile.name);
                    $('#email').val(profile.email);
                    $('#username').val(profile.username);
                    var profileImage = profile.profile_image ? '{{ asset('') }}' + profile.profile_image :
                        'https://ui-avatars.com/api/?background=random&name=' + encodeURIComponent(profile
                            .name);
                    profile.profile_image ? $('#gambarPreview').val(profileImage) : '';
                    profile.profile_image ? $('#showImage').attr('src', profileImage) : '';

                    $('#namaUserLoginDiHeader').text(profile.name);
                    $('#fotoUserLoginDiHeader').show();
                    $('#fotoUserLoginDiHeader').attr('src', profileImage);
                }

            });
        }

        $('#formUbahData').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData($('#formUbahData')[0]);

            $.ajax({
                url: '/update/profile',
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
