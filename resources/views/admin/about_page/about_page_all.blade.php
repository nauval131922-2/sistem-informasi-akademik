@extends('admin.admin_master')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">About Page</h4>

                            <form method="post" action="{{ route('update.about') }}" enctype="multipart/form-data">
                                @csrf
                                
                                <input type="hidden" name="id" value="{{ $aboutpage->id }}">

                                <div class="row mb-3">
                                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="title" id="title" value="{{ $aboutpage->title }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="short_title" class="col-sm-2 col-form-label">Short Title</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="short_title" id="short_title" value="{{ $aboutpage->short_title }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="short_description" class="col-sm-2 col-form-label">Short Description</label>
                                    <div class="col-sm-10">
                                      <textarea required="" class="form-control" rows="5" name="short_description" id="short_description">
                                        {{ $aboutpage->short_description }}
                                      </textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="elm1" class="col-sm-2 col-form-label">Long Description</label>
                                    <div class="col-sm-10">
                                      <textarea id="elm1" name="long_description">
                                        {{ $aboutpage->long_description }}
                                      </textarea>
                                    </div>
                                </div>

                                
                                <div class="row mb-3">
                                    <label for="image" class="col-sm-2 col-form-label">About Image</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="about_image" id="image">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="showImage" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img class="rounded avatar-lg" src="{{ (!empty($aboutpage->about_image)) ? url($aboutpage->about_image) : url('upload/no_image.jpg') }}" alt="Card image cap" id="showImage">
                                    </div>
                                </div>

                                <input type="submit" value="Update About Page" class="btn btn-info waves-effect waves-light">

                            </form>
                            <!-- end row -->
                            
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>

    <script type="text/javascript">

        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });

    </script>

@endsection