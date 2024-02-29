@extends('frontend.main')

@section('title')
    MI NU Nurul Ulum | Sarana Prasarana
@endsection

@section('main')

    <section id="portfolio" class="portfolio" style="margin-top: 60px">
      <div class="container">

        <div class="section-title">
          <h2>Ekstrakurikuler</h2>
        </div>

        <div class="row portfolio-container" data-aos="fade-up">

          @foreach ($semua_ekstra as $no=>$ekstra)
            <div class="col-lg-4 col-md-6 portfolio-item">
              @if ($ekstra->gambar)
                <img src="{{ asset($ekstra->gambar) }}" class="img-fluid" alt="">
              @else
                <img src="https://source.unsplash.com/random/?quote={{ $no+1 }}" class="img-fluid rounded" alt="">
              @endif
              <div class="portfolio-info">
                <h4>{{ $ekstra->nama }}</h4>
                @if ($ekstra->gambar)
                  <a href="{{ asset($ekstra->gambar) }}" data-gall="portfolioGallery" class="venobox preview-link" title="{{ $ekstra->nama }}"><i class="bx bx-plus"></i></a>
                @else
                  <a href="https://source.unsplash.com/random/?quote={{ $no+1 }}" data-gall="portfolioGallery" class="venobox preview-link" title="{{ $ekstra->nama }}"><i class="bx bx-plus"></i></a>
                @endif
              </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>

@endsection