@extends('frontend.main')

@section('title')
    MI NU Nurul Ulum | Sarana Prasarana
@endsection

@section('main')

    <section id="portfolio" class="portfolio" style="margin-top: 60px">
      <div class="container">

        <div class="section-title">
          <h2>Sarana Prasarana</h2>
        </div>

        <div class="row portfolio-container" data-aos="fade-up">

          @foreach ($semua_sarana_prasarana as $no=>$sarana_prasarana)
            <div class="col-lg-4 col-md-6 portfolio-item">
              @if ($sarana_prasarana->gambar)
                <img src="{{ asset($sarana_prasarana->gambar) }}" class="img-fluid" alt="">
              @else
                <img src="https://source.unsplash.com/random/?quote={{ $no+1 }}" class="img-fluid rounded" alt="">
              @endif
              <div class="portfolio-info">
                <h4>{{ $sarana_prasarana->nama }}</h4>
                @if ($sarana_prasarana->gambar)
                  <a href="{{ asset($sarana_prasarana->gambar) }}" data-gall="portfolioGallery" class="venobox preview-link" title="{{ $sarana_prasarana->nama }}"><i class="bx bx-plus"></i></a>
                @else
                  <a href="https://source.unsplash.com/random/?quote={{ $no+1 }}" data-gall="portfolioGallery" class="venobox preview-link" title="{{ $sarana_prasarana->nama }}"><i class="bx bx-plus"></i></a>
                @endif
              </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>

@endsection