@extends('frontend.main')

@section('title')
    MI NU Nurul Ulum | Blog Detail | {{ $blog->blog_title }}
@endsection

@section('main')
    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog" style="margin-top: 80px">
        <div class="container">

            <div class="row">

                <div class="col-lg-8 entries">

                    <article class="entry entry-single" data-aos="fade-up">

                        <div class="entry-img">
                            @if ($blog->blog_image)
                                <img src="{{ asset($blog->blog_image) }}" alt="" class="img-fluid rounded">
                            @else
                                <img src="https://source.unsplash.com/random/?quote" class="img-fluid rounded"
                                    alt="">
                            @endif
                        </div>

                        <h2 class="entry-title">
                            <a href="javascript:void(0);">{{ $blog->blog_title }}</a>
                        </h2>

                        <div class="entry-meta">
                            <ul>
                                {{-- updated_at using only date --}}
                                <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i><time
                                        datetime="{{ $blog->updated_at->format('Y-m-d') }}">{{ $blog->updated_at->format('d M Y') }}</time>
                                </li>
                                {{-- blog category --}}
                                <li class="d-flex align-items-center"><i class="icofont-tags"></i> <a
                                        href="{{ route('blog-by-category', $blog->category->id) }}">{{ $blog->category->blog_category }}</a>
                                </li>
                                {{-- penulis, jangan gunakan link --}}
                                @if ($blog->id_user_for_blog)
                                <li class="d-flex align-items-center"><i class="icofont-user"></i>
                                    {{ $blog->user->name }}
                                </li>
                            @endif
                            </ul>
                        </div>

                        <div class="entry-content">
                            <span style="line-height: 30px">
                                {!! $blog->blog_description !!}
                            </span>
                        </div>
                    </article><!-- End blog entry -->


                </div><!-- End blog entries list -->

                <div class="col-lg-4">

                    <div class="sidebar" data-aos="fade-left">

                        <h3 class="sidebar-title">Search</h3>
                        <div class="sidebar-item search-form">
                            <form action="{{ route('blog-search') }}">
                                <input type="text" id="search" name="search">
                                <button type="submit"><i class="icofont-search"></i></button>
                            </form>

                        </div><!-- End sidebar search formn-->

                        <h3 class="sidebar-title">Categories</h3>
                        <div class="sidebar-item categories">
                            <ul>
                                @foreach ($semua_blog_kategori as $kategori)
                                    <li><a href="{{ route('blog-by-category', $kategori->id) }}">{{ $kategori->blog_category }}
                                            <span>({{ $kategori->blogs->count() }})</span></a></li>
                                @endforeach
                            </ul>

                        </div><!-- End sidebar categories-->

                        <h3 class="sidebar-title">Recent Posts</h3>
                        <div class="sidebar-item recent-posts">
                            @foreach ($semua_blog_terbaru as $no => $blog_terbaru)
                                <div class="post-item clearfix">
                                    @if ($blog_terbaru->blog_image)
                                        <img src="{{ asset($blog_terbaru->blog_image) }}" alt=""
                                            class="img-fluid rounded">
                                    @else
                                        <img src="https://source.unsplash.com/random/?quote={{ $no + 1 }}"
                                            alt="" class="img-fluid rounded">
                                    @endif
                                    <h4><a href="{{ route('blog-single', $blog_terbaru->id) }}">
                                            {{-- {{ $blog_terbaru->blog_title }} --}}
                                            {!! \Illuminate\Support\Str::limit($blog_terbaru->blog_title, 30, '...') !!}
                                        </a></h4>
                                    <time
                                        datetime="{{ $blog_terbaru->updated_at->format('Y-m-d') }}">{{ $blog_terbaru->updated_at->format('d M Y') }}</time>
                                </div>
                            @endforeach
                        </div><!-- End sidebar recent posts-->

                    </div><!-- End sidebar -->

                </div><!-- End blog sidebar -->

            </div>

        </div>
    </section><!-- End Blog Section -->
@endsection
