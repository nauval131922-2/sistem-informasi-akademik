@extends('frontend.main')

@section('title')
    MI NU Nurul Ulum | Sambutan Kepala Madrasah
@endsection

@section('main')
    <?php 
      $sambutan = App\Models\SambutanKepalaMadrasah::find(1);
    ?>


    <section id="about-us" class="about-us" style="margin-top: 60px">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>{{ $sambutan->judul }}</h2>
        </div>

        <div class="row content">
          <div class="col-lg-6" data-aos="fade-right">
            <div class="member-img">
              @if ($sambutan->gambar)
                <img src="{{ asset($sambutan->gambar) }}" alt="" class="img-fluid rounded">
              @else
                <img src="https://source.unsplash.com/500x500/?quote" class="img-fluid rounded" alt="">
              @endif
            </div>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-left">
            <p style="text-align: right; font-size: 16px;">
              السّلام عليكم و رحمة الله وبركاته
            </p>
            <p style="text-align: right; font-size: 16px;">
              اَلْحَمْدُ لِّلهِ رَبِّ العَالمينَ وَ الصَّلاَةُ وَالسَّلاَمُ عَلى اَشْرَفِ الاَنبِيَاءِ و المُرْسَلِيْنَ وَعَلَى آَلِهِ وَأَصْحَابِهِ أَجْمَعِيْنَ
            </p>
            <p style="text-align: right; font-size: 16px;">
              أَشْهَدُ اَنْ لاإِلَهَ إِلاَّ اللهُ وَأَشْهَدُ اَنَّ مُحَمَّدًا رَسُوْلُ الله. أَمَّا بَعْدُ.
            </p>
            <br>
            <span style="line-height: 30px"> 
              {{-- {!! \Illuminate\Support\Str::limit($sambutan->isi, 550, '...') !!} --}}
              {!! $sambutan->isi !!}
            </span>
            <br>
            <p style="text-align: right; font-size: 16px;">
              والسّلام عليكم و رحمة الله وبركاته
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->
@endsection