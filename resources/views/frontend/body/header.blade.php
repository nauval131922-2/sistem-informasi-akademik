@php
    $route = Route::current()->getName();
@endphp

<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
        <h1 class="logo mr-auto"><a href="{{ route('home') }}"><span>MI </span>NU Nurul Ulum</a></h1>

        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="{{ $route == 'home' ? 'active' : '' }}"><a href="{{ route('home') }}">Home</a></li>
                <li class="drop-down"><a href="#">Profil</a>
                    <ul>
                        <li class="{{ $route == 'sambutan-kepala-madrasah-index-fe' ? 'active' : '' }}"><a
                                href="{{ route('sambutan-kepala-madrasah-index-fe') }}">Sambutan</a></li>
                        <li class="{{ $route == 'guru-index-fe' ? 'active' : '' }}"><a
                                href="{{ route('guru-index-fe') }}">Guru</a></li>
                        <li class="{{ $route == 'ekstra-index-fe' ? 'active' : '' }}"><a
                                href="{{ route('ekstra-index-fe') }}">Ekstrakurikuler</a></li>
                        <li class="{{ $route == 'sarana-prasarana-index-fe' ? 'active' : '' }}"><a
                                href="{{ route('sarana-prasarana-index-fe') }}">Sarana Prasarana</a></li>
                    </ul>
                </li>

                <li
                    class="{{ $route == 'blog-all' || $route == 'blog-by-category' || $route == 'blog-search' ? 'active' : '' }}">
                    <a href="{{ route('blog-all') }}">Blog</a>
                </li>
                <li class="{{ $route == 'kontak-index' ? 'active' : '' }}"><a
                        href="{{ route('kontak-index') }}">Kontak</a></li>



            </ul>

        </nav><!-- .nav-menu -->

        <div class="header-social-links">
            {{-- <a href="#" class="twitter"><i class="icofont-twitter"></i></a>
            <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
            <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
            <a href="#" class="linkedin"><i class="icofont-linkedin"></i></i></a> --}}
            @if (Auth::check())
                <a href="{{ route('dashboard') }}" class="login" target="_blank" data-toggle="tooltip"
                    title="Dashboard">
                    {{-- <i class="ri-dashboard-line align-middle"></i> --}}
                    {{-- gunakan icon dari icofont --}}
                    <i class="icofont-dashboard-web"></i>
                </a>
                <a href="{{ route('logout') }}" class="login" data-toggle="tooltip" title="Logout">
                    {{-- <i class="ri-logout-box-r-line align-middle text-danger"></i> --}}
                    {{-- gunakan icon dari icofont --}}
                    <i class="icofont-logout"></i>
                </a>
            @else
                <a href="{{ route('login') }}" class="login" target="_blank" data-toggle="tooltip" title="Login">
                    {{-- <i class="ri-login-box-line align-middle"></i> --}}
                    {{-- gunakan icon dari icofont --}}
                    <i class="icofont-login"></i>
                </a>
            @endif
        </div>

    </div>
</header>
