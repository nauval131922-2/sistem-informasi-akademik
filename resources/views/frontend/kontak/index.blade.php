@extends('frontend.main')

@section('title')
    MI NU Nurul Ulum | Kontak
@endsection

@section('main')

    <!-- ======= Contact Section ======= -->
    <div class="map-section" style="margin-top: 70px">
      <div class="mapouter"><div class="gmap_canvas"><iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=650&amp;height=400&amp;hl=en&amp;q=mi nu nurul ulum kedopok&amp;t=&amp;z=17&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://embedmapgenerator.com">embed code google maps</a></div><style>.mapouter{position:relative;text-align:right;width:100%;height:400px;}.gmap_canvas {overflow:hidden;background:none!important;width:100%;height:400px;}.gmap_iframe {height:400px!important;}</style></div>
    </div>

    <section id="contact" class="contact">
      <div class="container">

        <div class="row justify-content-center" data-aos="fade-up">

          <div class="col-lg-12">

            <div class="info-wrap">
              <div class="row">
                <div class="col-lg-6 info">
                  <i class="icofont-google-map"></i>
                  <h4>Location:</h4>
                  <p>{{ $profil_sekolah->alamat }}</p>
                </div>

                <div class="col-lg-3 info mt-4 mt-lg-0">
                  <i class="icofont-envelope"></i>
                  <h4>Email:</h4>
                  <p>{{ $profil_sekolah->email }}</p>
                </div>

                <div class="col-lg-3 info mt-4 mt-lg-0">
                  <i class="icofont-phone"></i>
                  <h4>Call:</h4>
                  <p>{{ $profil_sekolah->hp }}</p>
                </div>
              </div>
            </div>

          </div>

        </div>

        <div class="row mt-5 justify-content-center" data-aos="fade-up">
          <div class="col-lg-12">
            <form method="post" action="{{ route('kontak-simpan') }}" class="kontak">
              @csrf
              <div class="form-row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validate"></div>
                </div>
                <div class="col-md-6 form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                <div class="validate"></div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

@endsection