{{-- @extends('backend.main')

@section('title')
    Dashboard | Tambah {{ $title }}
@endsection --}}

{{-- @section('content') --}}
{{-- <div class="page-content"> --}}
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            {{-- <div class="card">
                        <div class="card-body"> --}}

            {{-- tambah tombol back to list --}}
            {{-- <a href="{{ route('blog-category-index') }}" class="btn btn-light mb-3"
                                style="
										/* taruh di samping kanan */
										float: right;
										/* background-color lebih muda lagi */
										/* background-color: rgb(37,43,59); */
										border-color: rgb(37,43,59);
										">
                                <i class="ri-arrow-go-back-line align-middle me-1"></i>
                                <span style="vertical-align: middle">Back to List</span>
                                    </a>

                            <h4 class="card-title">Tambah {{ $title }}</h4> --}}
            <p class="card-title-desc" style="border-bottom: 1px solid rgb(161,179,191)">Lengkapi form
                berikut untuk menambah {{ $title }}. <small class="text-danger">* Harus diisi</small></p>
            {{-- <form action="{{ route('blog-category-simpan') }}" method="POST"> --}}
            <form method="POST" id="formTambahData">
                @csrf
                <div class="row mb-3">
                    <label for="blog_category" class="col-sm-2 col-form-label">Nama <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" placeholder="Masukkan kategori blog"
                            id="blog_category" name="blog_category" value="{{ old('blog_category') }}" required>
                        <div class="mt-2">
                            {{-- @error('blog_category')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror --}}
                            <span class="text-danger error-text blog_category_error"></span>
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
{{-- </div>
</div>
</div>
@endsection --}}

<script>

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
            url: '{{ route('blog-category-simpan') }}',
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
                    fetchData();
                }
            }
        })

    })



    $(document).ready(function() {


    });
</script>
