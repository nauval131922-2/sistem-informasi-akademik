@extends('admin.admin_master')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Add Multi Image</h4>
                            <br>

                            <form method="post" action="{{ route('store.multi.image') }}" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="row mb-3">
                                    <label for="image" class="col-sm-2 col-form-label">About Multi Image</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="multi_image[]" id="image" multiple="">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="showImage" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img class="rounded avatar-lg" src="{{ url('upload/no_image.jpg') }}" alt="Card image cap" id="showImage">
                                    </div>
                                </div>

                                <input type="submit" value="Add Multi Image" class="btn btn-info waves-effect waves-light">

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