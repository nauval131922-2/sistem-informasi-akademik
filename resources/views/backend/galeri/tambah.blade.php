@extends('backend.main')

@section('title')
    Dashboard | {{ $title }}
@endsection

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <div class="page-content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-lg-10">
              <div class="card">
                  <div class="card-body">

                      <h4 class="card-title">Galeri</h4>
                      <p class="card-title-desc">Lengkapi form berikut untuk menambah data galeri.</p>
                      <form action="{{ route('galeri-simpan') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}">
                                <div class="mt-2">
                                    @error('judul')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="image" class="col-sm-2 col-form-label">Gambar</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input class="form-control" type="file" id="image" name="gambar[]" accept="image/*" multiple="" onchange="preview_image();">
                                    <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04" onclick="clearFile()">Clear Image</button>
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
                              <div id="showImage"></div>
                              {{-- <img src="" class="img-thumbnail" width="200" id="showImage">  --}}
                              <input type="hidden" value="" id="gambarPreview" name="gambarPreview">
                            </div>
                        </div>
                        <input type="submit" value="Simpan" class="btn btn-info waves-effect waves-light">
                      </form>
                      
                  </div>
              </div>
          </div> <!-- end col -->
      </div>
    </div>
  </div>

    {{-- preview all image --}}
    <script>
      function preview_image() {
        var total_file=document.getElementById("image").files.length;
        for(var i=0;i<total_file;i++){
          $('#showImage').append("<img src='"+URL.createObjectURL(event.target.files[i])+"' class='img-thumbnail' width='200' id='showImage'>");
        }
      }
    </script>

    <script>
        function clearFile() {
            $('#image').val('');
            $('#showImage').html('');
        }
    </script>
        
@endsection