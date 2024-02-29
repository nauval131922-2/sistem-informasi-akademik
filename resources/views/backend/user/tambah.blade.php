{{-- @extends('backend.main')

@section('title')
    Dashboard | Tambah {{ $title }}
@endsection --}}

{{-- @section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}

{{-- <div class="page-content"> --}}
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            {{-- <div class="card">
                        <div class="card-body"> --}}

            {{-- tambah tombol back to list --}}
            {{-- <a href="{{ route('user-index', $id_role) }}" class="btn btn-light mb-3"
                                style="float: right;border-color: rgb(37,43,59);">
                                <i class="ri-arrow-go-back-line align-middle me-1"></i>
                                <span style="vertical-align: middle">Back to List</span>
                            </a>

                            <h4 class="card-title">Tambah {{ $title }}</h4> --}}
            <p class="card-title-desc" style="border-bottom: 1px solid rgb(161,179,191)">Lengkapi form
                berikut untuk menambah {{ $title }}.</p>
            {{-- <form action="{{ route('user-simpan', $id_role) }}" method="POST" enctype="multipart/form-data"> --}}
            <form enctype="multipart/form-data" id="formTambahData" method="POST">
                @csrf
                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" placeholder="Masukkan nama" id="nama"
                            name="nama" value="{{ old('nama') }}" required>
                        <div class="mt-2">
                            {{-- @error('nama')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror --}}
                            <span class="text-danger error-text nama_error"></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" placeholder="Masukkkan username" id="username"
                            name="username" value="{{ old('username') }}" required>
                        <div class="mt-2">
                            {{-- @error('username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror --}}
                            <span class="text-danger error-text username_error"></span>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" placeholder="Masukkkan email" id="email"
                            name="email">
                        <div class="mt-2" value="{{ old('email') }}">
                            {{-- @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror --}}
                            <span class="text-danger error-text email_error"></span>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="password" placeholder="Masukkan password" id="password"
                            name="password" required>
                        <div class="mt-2">
                            {{-- @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror --}}
                            <span class="text-danger error-text password_error"></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="confirm_password" class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="password" placeholder="Masukkan ulang password"
                            id="confirm_password" name="confirm_password" required>
                        <div class="mt-2">
                            {{-- @error('confirm_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror --}}
                            <span class="text-danger error-text confirm_password_error"></span>
                        </div>
                    </div>
                </div>
                @if ($id_role == '3' || $id_role == '5')
                    <div class="row mb-3" id="kelass">
                        <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="kelas" name="kelas" required>
                                <option value="">Pilih Kelas</option>
                                @foreach ($semua_kelas as $kelas)
                                    @if (old('kelas') == $kelas->id)
                                        <option value="{{ $kelas->id }}" selected>{{ $kelas->nama }}
                                        </option>
                                    @else
                                        <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <div class="mt-2">
                                {{-- @error('kelas')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                                <span class="text-danger error-text kelas_error"></span>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($id_role == '4')
                    <div class="row mb-3" id="mapell">
                        <label for="mapel" class="col-sm-2 col-form-label">Mata Pelajaran</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="mapel" name="mapel" required>
                                <option value="">Pilih Mata Pelajaran</option>
                                @foreach ($semua_mapel as $mapel)
                                    @if (old('mapel') == $mapel->id)
                                        <option value="{{ $mapel->id }}" selected>
                                            {{ $mapel->mata_pelajaran }}</option>
                                    @else
                                        <option value="{{ $mapel->id }}">{{ $mapel->mata_pelajaran }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <div class="mt-2">
                                {{-- @error('mapel')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                                <span class="text-danger error-text mapel_error"></span>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row mb-3">
                    <label for="gambar" class="col-sm-2 col-form-label">Foto Profil</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input class="form-control" type="file" id="gambar" name="gambar" accept="image/*">
                            <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04"
                                onclick="clearFile()">
                                <i class="ri-delete-bin-7-line align-middle me-1"></i>
                                <span style="vertical-align: middle">Clear Image</span>
                            </button>
                            <div class="mt-2">
                                {{-- @error('gambar')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                                <span class="text-danger error-text gambar_error"></span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- tambah id role --}}
                <input type="hidden" name="id_role" value="{{ $id_role }}" id="id_role">

                <div class="row mb-3">
                    <label for="showImage" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <img src="" alt="" class="img-thumbnail" width="200" id="showImage">
                        <input type="hidden" value="" id="gambarPreview" name="gambarPreview">
                    </div>
                </div>

                {{-- <input type="submit" value="Simpan" class="btn btn-info waves-effect waves-light"> --}}

                <button type="submit" class="btn btn-info waves-effect waves-light">
                    <i class="ri-save-3-line align-middle me-1"></i>
                    <span style="vertical-align: middle">Simpan</span>
                </button>
            </form>

        </div>
    </div>
</div> <!-- end col -->
{{-- </div>
</div>
</div>

@endsection --}}

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

    // insert data
    $('#formTambahData').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData($('#formTambahData')[0]);

        $.ajax({
            url: '/data-user/simpan/' + $('#id_role').val(),
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $(document).find('span.error-text').text('');
            },
            success: function(response) {

                if(response.status == 'error'){
                    $.each(response.message, function(prefix, val){
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }else if(response.status == 'error2'){
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
                }else{
                
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

                    // reset form
                    $('#formTambahData')[0].reset();

                    // clear image
                    clearFile();

                    // fetch data
                    filterData();
                }
            }
        })

    })
</script>
