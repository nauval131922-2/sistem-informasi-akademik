{{-- @extends('backend.main')

@section('title')
    Dashboard | Tambah {{ $title }}
@endsection

@section('content') --}}
{{-- <div class="page-content"> --}}
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            {{-- <div class="card"> --}}
            {{-- <div class="card-body"> --}}

            {{-- tambah tombol back to list --}}
            {{-- <a href="{{ route('data-tahun-ajaran-index') }}" class="btn btn-light mb-3"
                                style="
											/* taruh di samping kanan */
											float: right;
											/* background-color lebih muda lagi */
											/* background-color: rgb(37,43,59); */
											border-color: rgb(37,43,59);
											">
                                <i class="ri-arrow-go-back-line align-middle me-1"></i>
                                <span style="vertical-align: middle">Back to List</span>
                            </a> --}}

            {{-- <h4 class="card-title">Tambah {{ $title }}</h4> --}}

            <p class="card-title-desc" style="border-bottom: 1px solid rgb(161,179,191)">Lengkapi form
                berikut untuk menambah {{ $title }}.</p>
            <form enctype="multipart/form-data" id="formTambahData" method="POST">
                @csrf
                <div class="row mb-3">
                    <label for="semester" class="col-sm-2 col-form-label">Semester</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="semester" name="semester" required>
                            <option value="">Pilih semester</option>
                            @foreach ($semua_semester as $semester)
                                @if (old('semester') == $semester)
                                    <option value="{{ $semester }}" selected>{{ $semester }}
                                    </option>
                                @else
                                    <option value="{{ $semester }}">{{ $semester }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="mt-2">
                            {{-- @error('semester')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror --}}
                            <span class="text-danger error-text semester_error"></span>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="tahun_ajaran" class="col-sm-2 col-form-label">Tahun Ajaran</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" placeholder="Masukkan Tahun Ajaran" id="tahun_ajaran"
                            name="tahun_ajaran" value="{{ old('tahun_ajaran') }}" required>
                        <div class="mt-2">
                            {{-- @error('tahun_ajaran')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror --}}
                            <span class="text-danger error-text tahun_ajaran_error"></span>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="statuss" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="statuss" name="statuss" required>
                            <option value="">Pilih status</option>
                            @foreach ($semua_status as $status)
                                @if (old('statuss') == $status)
                                    <option value="{{ $status }}" selected>{{ $status }}
                                    </option>
                                @else
                                    <option value="{{ $status }}">{{ $status }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="mt-2">
                            {{-- @error('statuss')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror --}}
                            <span class="text-danger error-text statuss_error"></span>
                        </div>
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

    // insert data
    $('#formTambahData').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData($('#formTambahData')[0]);

        $.ajax({
            url: '{{ route('data-tahun-ajaran-simpan') }}',
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
</script>
