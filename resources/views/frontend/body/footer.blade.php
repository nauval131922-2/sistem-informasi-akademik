<footer id="footer">

    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 footer-newsletter" style="margin-bottom: 30px">
                    @if ($profil_sekolah->logo)
                        <img src="{{ asset($profil_sekolah->logo) }}" alt="{{ $profil_sekolah->nama }}"
                            class="img-fluid rounded">
                    @else
                        <img src="https://source.unsplash.com/random/?quote" class="img-fluid rounded" alt="">
                    @endif
                </div>

                <div class="col-lg-7 col-md-6 footer-contact">
                    <h3>{{ $profil_sekolah->nama }}</h3>
                    <p>
                        {{ $profil_sekolah->alamat }} <br> <br>
                        {{-- jika ada $profil_sekolah->hp --}}
                        @if ($profil_sekolah->hp)
                            <strong>Phone:</strong> {{ $profil_sekolah->hp }}<br>
                        @endif
                        {{-- jika ada $profil_sekolah->email --}}
                        @if ($profil_sekolah->email)
                            <strong>Email:</strong> {{ $profil_sekolah->email }}<br>
                        @endif
                    </p>
                </div>

                <div class="col-lg-2 col-md-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('home') }}">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('guru-index-fe') }}">Guru</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a
                                href="{{ route('sarana-prasarana-index-fe') }}">Sarana Prasarana</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a
                                href="{{ route('ekstra-index-fe') }}">Ekstrakurikuler</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('blog-all') }}">Blog</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <div class="container d-md-flex py-4">

        <div class="mr-md-auto text-center text-md-left">
            <div class="copyright">
                &copy; Copyright <strong><span>MI NU Nurul Ulum</span></strong>. All Rights Reserved
            </div>
            {{-- <div class="credits">
					Designed by <a href="https://bootstrapmade.com/" target="_blank">BootstrapMade</a>
				</div> --}}
        </div>
        <div class="social-links text-center text-md-right pt-3 pt-md-0">
            @if ($profil_sekolah->twitter)
                <a href="{{ $profil_sekolah->twitter }}" class="twitter" target="_blank"><i
                        class="bx bxl-twitter"></i></a>
            @else
                <a href="javascript:void(0);" class="twitter"><i class="bx bxl-twitter"></i></a>
            @endif

            @if ($profil_sekolah->facebook)
                <a href="{{ $profil_sekolah->facebook }}" class="facebook" target="_blank"><i
                        class="bx bxl-facebook"></i></a>
            @else
                <a href="javascript:void(0);" class="facebook"><i class="bx bxl-facebook"></i></a>
            @endif

            @if ($profil_sekolah->youtube)
                <a href="{{ $profil_sekolah->youtube }}" class="youtube" target="_blank"><i
                        class="bx bxl-youtube"></i></a>
            @else
                <a href="javascript:void(0);" class="youtube"><i class="bx bxl-youtube"></i></a>
            @endif

            @if ($profil_sekolah->instagram)
                <a href="{{ $profil_sekolah->instagram }}" class="instagram" target="_blank"><i
                        class="bx bxl-instagram"></i></a>
            @else
                <a href="javascript:void(0);" class="instagram"><i class="bx bxl-instagram"></i></a>
            @endif
        </div>
    </div>
</footer>
