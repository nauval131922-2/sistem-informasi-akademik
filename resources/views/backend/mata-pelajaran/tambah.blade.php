<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">


            <p class="card-title-desc" style="border-bottom: 1px solid rgb(161,179,191)">Lengkapi form
                berikut untuk menambah {{ $title }}.</p>
            <form method="POST" id="formTambahData">
                @csrf
                <div class="row mb-3">
                    <label for="mata_pelajaran" class="col-sm-2 col-form-label">Mata Pelajaran</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" placeholder="Masukkan nama mata pelajaran"
                            id="mata_pelajaran" name="mata_pelajaran" value="{{ old('mata_pelajaran') }}" required>
                        <div class="mt-2">
                            <span class="text-danger error-text mata_pelajaran_error"></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nilai_batas_kelulusan" class="col-sm-2 col-form-label">Nilai batas kelulusan</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" placeholder="Masukkan nilai batas kelulusan"
                            id="nilai_batas_kelulusan" name="nilai_batas_kelulusan" value="{{ old('nilai_batas_kelulusan') }}" required>
                        <div class="mt-2">
                            <span class="text-danger error-text nilai_batas_kelulusan_error"></span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-info waves-effect waves-light">
                    <i class="ri-save-3-line align-middle me-1"></i>
                    <span style="vertical-align: middle">Simpan</span>
                </button>
            </form>

        </div>
    </div>
</div> <!-- end col -->

<script>
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

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // insert data
    $('#formTambahData').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData($('#formTambahData')[0]);

        $.ajax({
            url: '{{ route('mata-pelajaran-simpan') }}',
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

                    // reset form
                    $('#formTambahData')[0].reset();

                    // clear image
                    clearFile();

                    // fetch data
                    fetchData();
                }

            }
        })

    })



    $(document).ready(function() {


    });
</script>
