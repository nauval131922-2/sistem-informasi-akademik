
    <!-- ======= Our Team Section ======= -->
    <section id="blog" class="blog section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Blog Terbaru</h2>
        </div>

        <div class="row">
          @foreach ($semua_blog as $blog)
            <div class="col-lg-4">
            <article class="entry" data-aos="fade-up">

              <div class="entry-img">
                @if ($blog->blog_image)
                  <img src="{{ asset($blog->blog_image) }}" alt="" class="img-fluid">
                @else
                  <img src="https://source.unsplash.com/350x350/?quote=1" alt="" class="img-fluid">
                @endif
              </div>

              <h2 class="entry-title-home">
                <a href="blog-single.html">
                  {{ $blog->blog_title }}
                </a>
              </h2>

              <div class="entry-meta-home">
                <ul>
                  <li class="d-flex align-items-center">
                    <i class="icofont-wall-clock"></i>
                        {{ $blog->created_at->diffForHumans() }}
                    </li>
                </ul>
              </div>

              <div class="entry-content-home">
                <p>
                  {{ $blog->excerpt }}
                </p>
                <div class="read-more">
                  <a href="blog-single.html">Read More</a>
                </div>
              </div>

            </article><!-- End blog entry -->
          </div>
          @endforeach
          
          {{-- <div class="col-lg-4">
            <article class="entry" data-aos="fade-up">

              <div class="entry-img">
                <img src="https://source.unsplash.com/350x350/?quote=2" alt="" class="img-fluid">
              </div>

              <h2 class="entry-title-home">
                <a href="blog-single.html">Dolorum optio tempore voluptas dignissimos cumque fuga qui quibusdam quia reiciendis</a>
              </h2>

              <div class="entry-meta-home">
                <ul>
                  <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="blog-single.html"><time datetime="2020-01-01">Jan 1, 2020</time></a></li>
                </ul>
              </div>

              <div class="entry-content-home">
                <p>
                  Similique neque nam consequuntur ad non maxime aliquam quas. Quibusdam animi praesentium. Aliquam et laboriosam eius aut nostrum quidem aliquid dicta.
                </p>
                <div class="read-more">
                  <a href="blog-single.html">Read More</a>
                </div>
              </div>

            </article><!-- End blog entry -->
          </div>
          <div class="col-lg-4">
            <article class="entry" data-aos="fade-up">

              <div class="entry-img">
                <img src="https://source.unsplash.com/350x350/?quote=3" alt="" class="img-fluid">
              </div>

              <h2 class="entry-title-home">
                <a href="blog-single.html">Dolorum optio tempore voluptas dignissimos cumque fuga qui quibusdam quia reiciendis</a>
              </h2>

              <div class="entry-meta-home">
                <ul>
                  <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="blog-single.html"><time datetime="2020-01-01">Jan 1, 2020</time></a></li>
                </ul>
              </div>

              <div class="entry-content-home">
                <p>
                  Similique neque nam consequuntur ad non maxime aliquam quas. Quibusdam animi praesentium. Aliquam et laboriosam eius aut nostrum quidem aliquid dicta.
                </p>
                <div class="read-more">
                  <a href="blog-single.html">Read More</a>
                </div>
              </div>

            </article><!-- End blog entry -->
          </div> --}}
          
        </div>
        <div>
          <div class="text-center"><a href="" class="btn-get-started">Lihat Lainnya</a></div>
        </div>
      </div>
    </section><!-- End Our Team Section -->