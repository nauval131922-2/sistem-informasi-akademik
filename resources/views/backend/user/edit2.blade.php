<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">

            <div class="row">
                <div class="col-auto me-auto">
                    <p class="card-title-desc mb-0">Lengkapi form
                        berikut untuk mengubah {{ $title }}.</p>
                    </p>

                </div>

                <div class="col-auto mb-2">
                    <div class="dropdown">
                        @if ($id_role == '5')
                            <button class="btn btn-success" onclick="cetakData()" id="btnCetak"
                                style="margin-top: -10px">
                                <i class="ri-printer-line align-middle me-1"></i>
                                <span style="vertical-align: middle">Cetak</span>
                            </button>
                        @endif
                    </div>
                </div>

            </div>

            <hr style="margin: 0 0 1rem 0">

            <form enctype="multipart/form-data" id="formUbahData" method="POST">
                @csrf
                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" placeholder="Masukkan nama" id="nama"
                            name="nama" value="{{ $user->name ?? old('nama') }}" required>
                        <div class="mt-2">
                            <span class="text-danger error-text nama_error"></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" placeholder="Masukkkan username" id="username"
                            name="username" value="{{ $user->username ?? old('username') }}" required>
                        <div class="mt-2">
                            <span class="text-danger error-text username_error"></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" placeholder="Masukkkan email" id="email"
                            name="email" value="{{ $user->email ?? old('email') }}">
                        <div class="mt-2">
                            <span class="text-danger error-text email_error"></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="password" placeholder="Masukkan password" id="password"
                            name="password">
                        <div class="mt-2">
                            <span class="text-danger error-text password_error"></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="confirm_password" class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="password" placeholder="Masukkan ulang password"
                            id="confirm_password" name="confirm_password">
                        <div class="mt-2">
                            <span class="text-danger error-text confirm_password_error"></span>
                        </div>
                    </div>
                </div>
                @if ($id_role == '3' || $id_role == '5')
                    <div class="row mb-3">
                        <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="kelas" name="kelas" required>
                                <option value="">Pilih Kelas</option>
                                @foreach ($semua_kelas as $kelas)
                                    @if ($user->id_kelas == $kelas->id)
                                        <option value="{{ $kelas->id }}" selected>{{ $kelas->nama }}
                                        </option>
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
                @endif

                @if ($id_role == '4')
                    <div class="row mb-3">
                        <label for="mapel" class="col-sm-2 col-form-label">Mata Pelajaran</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="mapel" name="mapel" required>
                                <option value="">Pilih Mata Pelajaran</option>
                                @foreach ($semua_mapel as $mapel)
                                    @if ($user->id_mapel == $mapel->id)
                                        <option value="{{ $mapel->id }}" selected>
                                            {{ $mapel->mata_pelajaran }}</option>
                                    @else
                                        <option value="{{ $mapel->id }}">{{ $mapel->mata_pelajaran }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <div class="mt-2">
                                <span class="text-danger error-text mapel_error"></span>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- tambah id role --}}
                <input type="hidden" name="id_role" value="{{ $id_role }}">

                <div class="row mb-3">
                    <label for="gambar" class="col-sm-2 col-form-label">Foto Profil</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input class="form-control" type="file" id="gambar" name="gambar"
                                accept="image/*">
                            <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04"
                                onclick="clearFile()">
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
                                @if ($user->profile_image) {{ asset($user->profile_image) }}@endif"
                            alt="" class="img-thumbnail" width="200" id="showImage">
                        <input type="hidden" value="{{ $user->profile_image }}" id="gambarPreview"
                            name="gambarPreview">
                    </div>
                </div>

                <button type="submit" class="btn btn-info waves-effect waves-light" style="margin-right: 5px">
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

    });

    $('#gambar').change(function(e) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#showImage').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files[0]);
    });

    function clearFile() {
        $('#gambar').val('');
        $('#showImage').attr('src', '');
        $('#gambarPreview').val('');
    }

    function cetakData() {
        var id_siswa = {{ $user->id }};
        var url = '/data-user/print?';

        if (id_siswa) {
            url += 'id_siswa=' + id_siswa
        }

        window.open(url, '_blank');
    }

    // update data
    $('#formUbahData').on('submit', function(e) {
        e.preventDefault();

        var id = {{ $user->id }};
        let formData = new FormData($('#formUbahData')[0]);

        $.ajax({
            url: '/data-user/update/' + id,
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
