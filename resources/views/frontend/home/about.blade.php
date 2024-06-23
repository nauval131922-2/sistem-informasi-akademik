<?php
  $sambutan = App\Models\SambutanKepalaMadrasah::find(1);
?>

<section id="about-us" class="about-us">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2>
        {{ $sambutan->judul }}
      </h2>
    </div>

    <div class="row content">
      <div class="col-lg-6" data-aos="fade-right">
        {{-- <h2>Eum ipsam laborum deleniti velitena</h2>
        <h3>Voluptatem dignissimos provident quasi corporis voluptates sit assum perenda sruen jonee trave</h3> --}}
        <div class="member-img">
          @if ($sambutan->gambar)
            <img src="{{ asset($sambutan->gambar) }}" class="img-fluid rounded" alt="">
          @else
            <img src="https://ui-avatars.com/api/?background=random&name={{ $sambutan->judul }}&size=500&length=2" class="img-fluid rounded" alt="">
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
          {!! \Illuminate\Support\Str::limit($sambutan->isi, 550, '...') !!}
        </span>

        <div class="text-center"><a href="{{ route('sambutan-kepala-madrasah-index-fe') }}" class="btn-get-started">Read More</a></div>
      </div>
    </div>

  </div>
</section>
