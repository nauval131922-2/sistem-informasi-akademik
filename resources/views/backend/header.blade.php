<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ route('dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="logo-sm" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt="logo-dark" height="20">
                    </span>
                </a>

                <a href="{{ route('dashboard') }}" class="logo logo-light" style="">
                    {{-- <span class="logo-sm">
                        <img src="{{ asset('backend/assets/images/logo-sm-new.png') }}" alt="logo-sm-light"
                            height="22">
                    </span> --}}
                    {{-- <span class="logo-lg">

                        <img src="{{ asset('backend/assets/images/logo-sm-new.png') }}" alt="logo-sm-light"
                            height="22" style="margin-top: -4px;">

                        <span
                            style="
                        font-size: 20px;
                        font-weight: 600;
                        color: #fff;
                        margin-left: 4px;
                        ">|
                            siakad</span>
                    </span> --}}

                    <span class="logo-sm"
                        style="
                        font-size: 20px;
                        /* font-weight: 600; */
                        color: #fff;
                        margin-left: 4px;
                        ">
                        <i class="ri-dashboard-line align-middle me-1"></i>
                    </span>

                    {{-- ri-dashboard-line --}}
                    <span class="logo-lg"
                        style="
                        font-size: 20px;
                        color: #fff;
                        margin-left: 4px;
                        ">
                        <i class="ri-dashboard-line align-middle me-1"></i>
                        {{-- <span style="
                            vertical-align: middle;
                        " >siakad</span>  --}}
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle"></i>
            </button>
        </div>

        <div class="d-flex">

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line"></i>
                </button>
            </div>

            @php
                $id = Auth::user()->id;
                $user_data = App\Models\User::find($id);
            @endphp

            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="" alt="" class="rounded header-profile-user" id="fotoUserLoginDiHeader">
                    <span class="d-none d-xl-inline-block ms-1" id="namaUserLoginDiHeader"></span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ route('profile') }}">
                        <i class="ri-user-line align-middle me-1"></i>
                        <span
                            style="
                            vertical-align: middle;
                        ">Profile</span>
                    </a>

                    <a class="dropdown-item" href="{{ route('home') }}">
                        <i class="ri-earth-line align-middle me-1"></i>
                        <span
                            style="
                            vertical-align: middle;
                        ">Website</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}">
                        <i class="ri-logout-box-r-line align-middle me-1 text-danger"></i>
                        <span
                            style="
                            vertical-align: middle;
                        ">Logout</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</header>

<script>
    $(document).ready(function() {

        fetchData();

    });

    // Route::get('/profile/fetch', 'fetch')->name('profile-fetch');
    function fetchData() {

        $.ajax({
            url: '{{ route('profile-fetch') }}',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                let profile = response.data;
                // isi input dengan id name dengan data yang diambil dari database
                $('#namaUserLoginDiHeader').text(profile.name);
            }

        });
    }
</script>
