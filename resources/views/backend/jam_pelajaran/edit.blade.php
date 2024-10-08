
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <p class="card-title-desc" style="border-bottom: 1px solid rgb(161,179,191)">Lengkapi form
                berikut untuk mengubah {{ $title }}. <small class="text-danger">* Harus diisi</small></p>
            <form enctype="multipart/form-data" id="formUbahData" method="POST">
                @csrf
                <div class="row mb-3">
                    <label for="jam_ke" class="col-sm-2 col-form-label">Jam ke <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" placeholder="Masukkan Jam ke" id="jam_ke"
                            name="jam_ke" value="{{ $jam_pelajaran->jam_ke ?? old('jam_ke') }}" required>
                        <div class="mt-2">
                            <span class="text-danger error-text jam_ke_error"></span>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="jam_mulai" class="col-sm-2 col-form-label">Jam Mulai <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input class="form-control" type="time" placeholder="Masukkan Jam Mulai" id="jam_mulai"
                            name="jam_mulai" value="{{ $jam_pelajaran->jam_mulai ?? old('jam_mulai') }}" required>
                        <div class="mt-2">
                            <span class="text-danger error-text jam_mulai_error"></span>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="jam_selesai" class="col-sm-2 col-form-label">Jam Selesai <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input class="form-control" type="time" placeholder="Masukkan Jam Selesai" id="jam_selesai"
                            name="jam_selesai" value="{{ $jam_pelajaran->jam_selesai ?? old('jam_selesai') }}" required>
                        <div class="mt-2">
                            <span class="text-danger error-text jam_selesai_error"></span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-info waves-effect waves-light">
                    <i class="ri-save-3-line align-middle me-1"></i>
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

    // update data
    $('#formUbahData').on('submit', function(e) {
        e.preventDefault();

        var id = {{ $jam_pelajaran->id }};
        let formData = new FormData($('#formUbahData')[0]);

        $.ajax({
            url: '/data-jam/update/' + id,
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
                }else if(response.status == 'error2' || response.status == 'error3' || response.status == 'error4'){
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
                    filterJam();
                }
            }
        })

    })
</script>
