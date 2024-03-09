<section id="hero">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">

        <div class="carousel-inner" role="listbox">

            <!-- Slide 1 -->
            @if($blog_1 != null)
                @if ($blog_1->blog_image)
                    <div class="carousel-item active" style="background-image: url({{ asset($blog_1->blog_image) }});">
                    @else
                        <div class="carousel-item active"
                            style="background-image: url(https://source.unsplash.com/random/?quote);">
                @endif
                <div class="carousel-container">
                    <div class="carousel-content animate__animated animate__fadeInUp">
                        <h2>{{ $blog_1->blog_title }}</h2>
                        <p>
                            {{ $blog_1->excerpt }}
                        </p>
                        <div class="text-center"><a href="{{ route('blog-single', $blog_1->id) }}"
                                class="btn-get-started">Read More</a></div>
                    </div>
                </div>
            @endif
            {{-- @if ($blog_1->blog_image)
                <div class="carousel-item active" style="background-image: url({{ asset($blog_1->blog_image) }});">
                @else
                    <div class="carousel-item active"
                        style="background-image: url(https://source.unsplash.com/random/?quote);">
            @endif
            <div class="carousel-container">
                <div class="carousel-content animate__animated animate__fadeInUp">
                    <h2>{{ $blog_1->blog_title }}</h2>
                    <p>
                        {{ $blog_1->excerpt }}
                    </p>
                    <div class="text-center"><a href="{{ route('blog-single', $blog_1->id) }}"
                            class="btn-get-started">Read More</a></div>
                </div>
            </div> --}}
        </div>

        <!-- Slide 2 -->
        @foreach ($semua_blog as $no => $blog)
            @if ($blog->blog_image)
                <div class="carousel-item" style="background-image: url({{ asset($blog->blog_image) }});">
                @else
                    <div class="carousel-item"
                        style="background-image: url(https://source.unsplash.com/random/?quote={{ $no + 1 }});">
            @endif
            <div class="carousel-container">
                <div class="carousel-content animate__animated animate__fadeInUp">
                    <h2>{{ $blog->blog_title }}</h2>
                    <p>
                        {{ $blog->excerpt }}
                    </p>
                    <div class="text-center"><a href="{{ route('blog-single', $blog->id) }}"
                            class="btn-get-started">Read More</a></div>
                </div>
            </div>
    </div>
    @endforeach

    </div>

    <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon icofont-simple-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>

    <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon icofont-simple-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>

    <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

    </div>
</section>
