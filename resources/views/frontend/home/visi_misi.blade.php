
    <!-- ======= Our Team Section ======= -->
    <section id="blog" class="blog-visi section-bg">
       <div class="container" data-aos="fade-up">
        <div class="row content">
          <div class="col-lg-12 pt-4 pt-lg-0 blog-visi-tujuan" data-aos="fade-up">
            <div style="margin-bottom: 15px">
              <h4 style="font-weight: bold">Visi</h4>
            </div>
            <span style="line-height: 30px; font-style: italic;font-weight: 600"> 
              {!! $profil_sekolah->visi !!}
            </span>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-right" style="margin-top: 50px">
            <div style="margin-bottom: 15px">
              <h4 style="font-weight: bold">Misi</h4>
            </div>
            <div style="margin-left: 20px">
              <span style="font-weight: 600"> 
                <ul id="visimisi">
                  {!! $profil_sekolah->misi !!}
                </ul>
              </span>
            </div>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-left" style="margin-top: 50px">
            <div style="margin-bottom: 15px">
              <h4 style="font-weight: bold">Tujuan</h4>
            </div>
            <div style="margin-left: 20px">
              <span style="font-weight: 600"> 
                <ul id="visimisi">
                  {!! $profil_sekolah->tujuan !!}
                </ul>
              </span>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Our Team Section -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
      $(document).ready(function(){
        $('ul#visimisi li').each(function(){
          $(this).html('<i class="ri-check-double-line"></i> ' + $(this).text());
          $(this).css('padding-left', '30px');
        });
      });
    </script>

