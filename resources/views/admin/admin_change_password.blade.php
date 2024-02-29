@extends('admin.admin_master')

@section('admin')

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Change Password Page</h4>
                            <br>

                            @if (count($errors))
                              @foreach ($errors->all() as $error)
                                  <p class="alert alert-danger alert-dismissible fade show">
                                    {{ $error }}
                                  </p>
                              @endforeach
                            @endif

                            <form method="post" action="{{ route('update.password') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3">
                                    <label for="oldpassword" class="col-sm-2 col-form-label">Old Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" name="Old Password" id="oldpassword">
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="newpassord" class="col-sm-2 col-form-label">New Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" name="New Password" id="newpassword">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="confirmpassword" class="col-sm-2 col-form-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" name="Confirm Password" id="confirmpassword">
                                    </div>
                                </div>

                                <input type="submit" value="Change Password" class="btn btn-info waves-effect waves-light">

                            </form>
                            <!-- end row -->
                            
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>

@endsection