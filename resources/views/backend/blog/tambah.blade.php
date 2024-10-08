{{-- @extends('backend.main')

@section('title')
    Dashboard | Tambah {{ $title }}
@endsection --}}

{{-- @section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="page-content"> --}}
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            {{-- <div class="card">
                        <div class="card-body"> --}}

            {{-- tambah tombol back to list --}}
            {{-- <a href="{{ route('blog-index', $blog_category_id) }}" class="btn btn-light mb-3"
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
            {{-- <form action="{{ route('blog-simpan', $blog_category) }}" method="POST" enctype="multipart/form-data"> --}}
            <form enctype="multipart/form-data" id="formTambahData" method="POST">
                @csrf
                {{-- dropdown kategori blog  --}}
                <div class="row mb-3">
                    <label for="kategori" class="col-sm-2 col-form-label">Kategori <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select class="form-select" id="kategori" name="kategori" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($blog_categories as $blog_category)
                                <option value="{{ $blog_category->id }}">{{ $blog_category->blog_category }}</option>
                            @endforeach
                        </select>
                        <div class="mt-2">
                            {{-- @error('kategori')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror --}}
                            <span class="text-danger error-text kategori_error"></span>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="judul" class="col-sm-2 col-form-label">Judul <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="judul" name="judul"
                            value="{{ old('judul') }}" placeholder="Masukkan judul blog" required>
                        <div class="mt-2">
                            <span class="text-danger error-text judul_error"></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="isi" class="col-sm-2 col-form-label">Isi <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input id="isi" type="hidden" name="isi" value="{{ old('isi') }}">
                        <trix-editor input="isi"></trix-editor>
                        <div class="mt-2">
                            {{-- @error('isi')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror --}}
                            <span class="text-danger error-text isi_error"></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
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

                <div class="row mb-3">
                    <label for="showImage" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <img src="" class="img-thumbnail" width="200" id="showImage">
                        <input type="hidden" value="" id="gambarPreview" name="gambarPreview">
                    </div>
                </div>

                {{-- input hidden blog_category_id --}}
                {{-- <input type="hidden" name="blog_category_id" value="{{ $blog_category_id }}" id="blog_category_id"> --}}

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
            url: '/blog/simpan/' + $('#blog_category_id').val(),
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
