<section id="portfolio" class="portfolio">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Galeri</h2>
        </div>

        <div class="row" data-aos="fade-up">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              @foreach ($semua_galeri as $galeri)
                  <li data-filter="{{ $galeri->judul }} class="filter-active"">{{ $galeri->judul }}</li>
              @endforeach
            </ul>
          </div>
        </div>
        
        {{-- load galeri gambar array --}}
        <div class="row portfolio-container" data-aos="fade-up">
          @foreach ($semua_galeri as $galeri)
            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <div class="portfolio-wrap">
                <img src="{{ asset('storage/galeri/' . $galeri->gambar) }}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>{{ $galeri->judul }}</h4>
                  <p>{{ $galeri->deskripsi }}</p>
                  <div class="portfolio-links">
                    <a href="{{ asset('storage/galeri/' . $galeri->gambar) }}" data-gall="portfolioGallery" class="venobox" title="{{ $galeri->judul }}"><i class="bx bx-plus"></i></a>
                    <a href="{{ route('frontend.galeri.show', $galeri->id) }}" title="More Details"><i class="bx bx-link"></i></a>
                  </div>
                </div>
              </div>
            </div>
          @endforeach

        <div class="row portfolio-container" data-aos="fade-up" style="margin-top: 10px">
          @foreach ($semua_galeri as $galeri)
            <div class="col-lg-4 col-md-6 portfolio-item {{ $galeri->judul }}">
              <img src="{{ asset($galeri->gambar) }}" class="img-fluid" alt="">
              <div class="portfolio-wrap">
                <img src="{{ asset($galeri->gambar) }}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>{{ $galeri->judul }}</h4>
                  <p>{{ $galeri->keterangan }}</p>
                  <div class="portfolio-links">
                    <a href="{{ asset($galeri->gambar) }}" data-gall="portfolioGallery" class="venobox" title="{{ $galeri->judul }}"><i class="bx bx-plus"></i></a>
                    <a href="#" title="More Details"><i class="bx bx-link"></i></a>
                  </div>
                </div>
              </div>
            </div>
          @endforeach

          {{-- <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <img src="{{ asset('frontend/assets/img/portfolio/portfolio-1.jpg') }}" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>App 1</h4>
              <p>App</p>
              <a href="{{ asset('frontend/assets/img/portfolio/portfolio-1.jpg') }}" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <img src="{{ asset('frontend/assets/img/portfolio/portfolio-2.jpg') }}" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Web 3</h4>
              <p>Web</p>
              <a href="{{ asset('frontend/assets/img/portfolio/portfolio-2.jpg') }}" data-gall="portfolioGallery" class="venobox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <img src="{{ asset('frontend/assets/img/portfolio/portfolio-3.jpg') }}" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>App 2</h4>
              <p>App</p>
              <a href="{{ asset('frontend/assets/img/portfolio/portfolio-3.jpg') }}" data-gall="portfolioGallery" class="venobox preview-link" title="App 2"><i class="bx bx-plus"></i></a>
              <a href=portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <img src="{{ asset('frontend/assets/img/portfolio/portfolio-4.jpg') }}" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Card 2</h4>
              <p>Card</p>
              <a href="{{ asset('frontend/assets/img/portfolio/portfolio-4.jpg') }}" data-gall="portfolioGallery" class="venobox preview-link" title="Card 2"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <img src="{{ asset('frontend/assets/img/portfolio/portfolio-5.jpg') }}" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Web 2</h4>
              <p>Web</p>
              <a href="{{ asset('frontend/assets/img/portfolio/portfolio-5.jpg') }}" data-gall="portfolioGallery" class="venobox preview-link" title="Web 2"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <img src="{{ asset('frontend/assets/img/portfolio/portfolio-6.jpg') }}" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>App 3</h4>
              <p>App</p>
              <a href="{{ asset('frontend/assets/img/portfolio/portfolio-6.jpg') }}" data-gall="portfolioGallery" class="venobox preview-link" title="App 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <img src="{{ asset('frontend/assets/img/portfolio/portfolio-7.jpg') }}" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Card 1</h4>
              <p>Card</p>
              <a href="{{ asset('frontend/assets/img/portfolio/portfolio-7.jpg') }}" data-gall="portfolioGallery" class="venobox preview-link" title="Card 1"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <img src="{{ asset('frontend/assets/img/portfolio/portfolio-8.jpg') }}" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Card 3</h4>
              <p>Card</p>
              <a href="{{ asset('frontend/assets/img/portfolio/portfolio-8.jpg') }}" data-gall="portfolioGallery" class="venobox preview-link" title="Card 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <img src="{{ asset('frontend/assets/img/portfolio/portfolio-9.jpg') }}" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Web 3</h4>
              <p>Web</p>
              <a href="{{ asset('frontend/assets/img/portfolio/portfolio-9.jpg') }}" data-gall="portfolioGallery" class="venobox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
              <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div> --}}

        </div>

      </div>
    </section>