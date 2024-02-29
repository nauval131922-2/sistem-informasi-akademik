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

                            <form method="post" action="{{ route('update.footer') }}">
                                @csrf
                                
                                <input type="hidden" name="id" value="{{ $footer->id }}">

                                <div class="row mb-3">
                                    <label for="number" class="col-sm-2 col-form-label">Number</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="number" id="number" value="{{ $footer->number }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="short_description" class="col-sm-2 col-form-label">Short Description</label>
                                    <div class="col-sm-10">
                                      <textarea required="" class="form-control" rows="5" name="short_description" id="short_description">
                                        {{ $footer->short_description }}
                                      </textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="address" id="address" value="{{ $footer->address }}">
                                    </div>
                                </div>

                                 <div class="row mb-3">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="email" name="email" id="email" value="{{ $footer->email }}">
                                    </div>
                                </div>

                                 <div class="row mb-3">
                                    <label for="facebook" class="col-sm-2 col-form-label">Facebook</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="facebook" id="facebook" value="{{ $footer->facebook }}">
                                    </div>
                                </div>

                                 <div class="row mb-3">
                                    <label for="twitter" class="col-sm-2 col-form-label">Twitter</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="twitter" id="twitter" value="{{ $footer->twitter }}">
                                    </div>
                                </div>

                                 <div class="row mb-3">
                                    <label for="copyright" class="col-sm-2 col-form-label">Copyright</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="copyright" id="copyright" value="{{ $footer->copyright }}">
                                    </div>
                                </div>

                                <input type="submit" value="Update Footer" class="btn btn-info waves-effect waves-light">

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