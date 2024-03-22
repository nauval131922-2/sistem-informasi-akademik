@extends('frontend.main')

@section('title')
    MI NU Nurul Ulum | Kontak
@endsection

@section('main')
    <!-- ======= Contact Section ======= -->
    <div class="map-section" style="margin-top: 70px">
        <div class="mapouter">
            <div class="gmap_canvas"><iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no" marginheight="0"
                    marginwidth="0"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1981.1432452958238!2d110.87010777016823!3d-6.73486139999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70db33b4b39e25%3A0x639b09e1f60c9a30!2sMI%20NU%20Nurul%20Ulum!5e0!3m2!1sen!2sus!4v1711102333660!5m2!1sen!2sus"></iframe><a
                    href="https://embedmapgenerator.com">embed code google maps</a></div>
            <style>
                .mapouter {
                    position: relative;
                    text-align: right;
                    width: 100%;
                    height: 400px;
                }

                .gmap_canvas {
                    overflow: hidden;
                    background: none !important;
                    width: 100%;
                    height: 400px;
                }

                .gmap_iframe {
                    height: 400px !important;
                }
            </style>
        </div>

        {{-- <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1981.1432452958238!2d110.87010777016823!3d-6.73486139999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70db33b4b39e25%3A0x639b09e1f60c9a30!2sMI%20NU%20Nurul%20Ulum!5e0!3m2!1sen!2sus!4v1711102333660!5m2!1sen!2sus"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
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
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                                <div class="validate"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject"
                                data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                            <div class="validate"></div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" rows="5" data-rule="required"
                                data-msg="Please write something for us" placeholder="Message"></textarea>
                            <div class="validate"></div>
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>
                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->
@endsection
