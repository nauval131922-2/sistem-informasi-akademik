@extends('backend.main')

@section('title')
    Dashboard | {{ $title }}
@endsection

@section('content')

  <div class="page-content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-lg-10">
              <div class="card">
                  <div class="card-body">
                      <div style="margin-bottom: 40px">
                        <h4 class="card-title">Visi, Misi, dan Tujuan berdirinya MI NU Nurul Ulum</h4>
                        <p class="card-title-desc">Lengkapi form berikut untuk mengubah data visi, misi, dan tujuan berdirinya MI NU Nurul Ulum.</p>
                      </div>
                      <form action="{{ route('visi-misi-update', $visi_misi->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="visi" class="col-sm-2 col-form-label">Visi</label>
                            <div class="col-sm-10">
                                <input id="visi" type="hidden" name="visi" value="{{ old('visi', $visi_misi->visi) }}">
                                <trix-editor input="visi"></trix-editor>
                                <div class="mt-2">
                                    @error('visi')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="misi" class="col-sm-2 col-form-label">Misi</label>
                            <div class="col-sm-10">
                                <input id="misi" type="hidden" name="misi" value="{{ old('misi', $visi_misi->misi) }}">
                                <trix-editor input="misi"></trix-editor>
                                <div class="mt-2">
                                    @error('misi')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tujuan" class="col-sm-2 col-form-label">Tujuan</label>
                            <div class="col-sm-10">
                                <input id="tujuan" type="hidden" name="tujuan" value="{{ old('tujuan', $visi_misi->tujuan) }}">
                                <trix-editor input="tujuan"></trix-editor>
                                <div class="mt-2">
                                    @error('tujuan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <input type="submit" value="Update" class="btn btn-info waves-effect waves-light">
                      </form>
                      
                  </div>
              </div>
          </div> <!-- end col -->
      </div>
    </div>
  </div>

@endsection