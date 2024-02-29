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

                      <h4 class="card-title">Media Sosial</h4>
                      <p class="card-title-desc">Lengkapi form berikut untuk mengubah data Media Sosial.</p>
                      <form action="{{ route('media-sosial-update', $media_sosial->id) }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="twitter" class="col-sm-2 col-form-label">Twitter</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="twitter" name="twitter" value="{{ $media_sosial->twitter }}">
                                <div class="mt-2">
                                    @error('twitter')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="facebook" class="col-sm-2 col-form-label">Facebook</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="facebook" name="facebook" value="{{ $media_sosial->facebook }}">
                                <div class="mt-2">
                                    @error('facebook')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="youtube" class="col-sm-2 col-form-label">YouTube</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="youtube" name="youtube" value="{{ $media_sosial->youtube }}">
                                <div class="mt-2">
                                    @error('youtube')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="instagram" class="col-sm-2 col-form-label">Instagram</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="instagram" name="instagram" value="{{ $media_sosial->instagram }}">
                                <div class="mt-2">
                                    @error('instagram')
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