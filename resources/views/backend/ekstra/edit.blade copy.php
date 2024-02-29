@extends('backend.main')

@section('title')
    Dashboard | Ubah {{ $title }}
@endsection

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">

                            {{-- tambah tombol back to list --}}
                            <a href="{{ route('ekstra-index') }}" class="btn btn-light mb-3"
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

                            <h4 class="card-title">Ubah {{ $title }}</h4>
                            <p class="card-title-desc" style="border-bottom: 1px solid rgb(161,179,191)">Lengkapi form
                                berikut untuk mengubah {{ $title }}.</p>
                            <form action="{{ route('ekstra-update', $ekstra->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            value="{{ $ekstra->nama ?? old('nama') }}"
                                            placeholder="Masukkan nama ekstrakurikuler" required>
                                        <div class="mt-2">
                                            @error('nama')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
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
                                                @error('gambar')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="showImage" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img src="
                                @if ($ekstra->gambar) {{ asset($ekstra->gambar) }} @endif"
                                            alt="" class="img-thumbnail" width="200" id="showImage">
                                        <input type="hidden" value="{{ $ekstra->gambar }}" id="gambarPreview"
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
@endsection
