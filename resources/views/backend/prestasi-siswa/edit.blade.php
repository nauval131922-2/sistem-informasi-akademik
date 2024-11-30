<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">


            <p class="card-title-desc" style="border-bottom: 1px solid rgb(161,179,191)">Lengkapi form
                berikut untuk mengubah {{ $title }}. <small class="text-danger">* Harus diisi</small></p>
            <form method="POST" id="formUbahData">
                @csrf
                <div class="row mb-3">
                    <label for="siswa" class="col-md-2 col-form-label">Siswa <span class="text-danger">*</span></label>
                    <div class="col-md-10">
                        <select class="form-select" id="siswa" name="siswa" required>
                            <option value="">Pilih siswa</option>
                            @foreach ($semua_siswa as $siswa)
                                @if ($prestasi_siswa->id_user_for_prestasi_siswa == $siswa->id ?? old('siswa') == $siswa->id)
                                    <option value="{{ $siswa->id }}" selected>{{ $siswa->name }}
                                    </option>
                                @else
                                    <option value="{{ $siswa->id }}">{{ $siswa->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="mt-2">
                            <span class="text-danger error-text siswa_error"></span>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="prestasi_siswa" class="col-sm-2 col-form-label">Prestasi Siswa <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" placeholder="Masukkan prestasi siswa"
                            id="prestasi_siswa" name="prestasi_siswa" value="{{ $prestasi_siswa->prestasi_siswa ?? old('prestasi_siswa') }}" required>
                        <div class="mt-2">
                            <span class="text-danger error-text prestasi_siswa_error"></span>
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



    // update data
    $('#formUbahData').on('submit', function(e) {
        e.preventDefault();

        var id = {{ $prestasi_siswa->id }};
        let formData = new FormData($('#formUbahData')[0]);

        $.ajax({
            url: '/prestasi-siswa/update/' + id,
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
