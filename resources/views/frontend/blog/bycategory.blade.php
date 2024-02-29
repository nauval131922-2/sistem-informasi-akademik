@extends('frontend.main')

@section('title')
    MI NU Nurul Ulum | Blog {{ $title }}
@endsection

@section('main')

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>{{ $title }}</h2>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    {{--  jika blog count kurang dari 1 maka tampilkan kosong --}}
    @if ($semua_blog->count() < 1)
        <section id="blog" class="blog">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="alert alert-warning">
                            <h4>Maaf</h4>
                            <p>Data tidak ditemukan.</p>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="sidebar" data-aos="fade-left">
                            <h3 class="sidebar-title">Search</h3>
                            <div class="sidebar-item search-form">
                                <form action="{{ route('blog-search') }}">
                                    <input type="text" id="search" name="search">
                                    <button type="submit"><i class="icofont-search"></i></button>
                                </form>
                            </div>

                            <h3 class="sidebar-title">Categories</h3>
                            <div class="sidebar-item categories">
                                <ul>
                                    @foreach ($semua_blog_kategori as $kategori)
                                        <li><a href="{{ route('blog-by-category', $kategori->id) }}">{{ $kategori->blog_category }}
                                                <span>({{ $kategori->blogs->count() }})</span></a></li>
                                    @endforeach
                                </ul>
                            </div>

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
                                                {!! \Illuminate\Support\Str::limit($blog_terbaru->blog_title, 30, '...') !!}
                                            </a></h4>
                                        <time
                                            datetime="{{ $blog_terbaru->updated_at->format('Y-m-d') }}">{{ $blog_terbaru->updated_at->format('d M Y') }}</time>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section id="blog" class="blog">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 entries">
                        @foreach ($semua_blog as $no => $blog)
                            <article class="entry entry-single" data-aos="fade-up">
                                <div class="entry-img">
                                    @if ($blog->blog_image)
                                        <img src="{{ asset($blog->blog_image) }}" alt="" class="img-fluid rounded">
                                    @else
                                        <img src="https://source.unsplash.com/random/?quote={{ $no + 1 }}"
                                            class="img-fluid rounded" alt="">
                                    @endif
                                </div>

                                <h2 class="entry-title">
                                    <a href="{{ route('blog-single', $blog->id) }}">{{ $blog->blog_title }}</a>
                                </h2>

                                <div class="entry-meta">
                                    <ul>
                                        <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i><time
                                                datetime="{{ $blog->updated_at->format('Y-m-d') }}">{{ $blog->updated_at->format('d M Y') }}</time>
                                        </li>
                                        <li class="d-flex align-items-center"><i class="icofont-tags"></i> <a
                                                href="{{ route('blog-by-category', $blog->category->id) }}">{{ $blog->category->blog_category }}</a>
                                        </li>
                                        {{-- penulis, jangan gunakan link --}}
                                        @if ($blog->id_user_for_blog)
                                            <li class="d-flex align-items-center"><i class="icofont-user"></i>
                                                {{ $blog->user->name }}
                                            </li>
                                        @endif
                                        {{-- <li class="d-flex align-items-center"><i class="icofont-user"></i>
                                            {{ $blog->user->name }}
                                        </li> --}}

                                    </ul>
                                </div>

                                <div class="entry-content">
                                    <span style="line-height: 30px">
                                        {!! $blog->excerpt !!}
                                    </span>
                                    <div class="read-more">
                                        <a href="{{ route('blog-single', $blog->id) }}">Read Moree</a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                        <div class="guru-pagination" style="margin-top: 40px">
                            {{ $semua_blog->links('vendor.pagination.custom') }}
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="sidebar" data-aos="fade-left">
                            <h3 class="sidebar-title">Search</h3>
                            <div class="sidebar-item search-form">
                                <form action="{{ route('blog-search') }}">
                                    <input type="text" id="search" name="search">
                                    <button type="submit"><i class="icofont-search"></i></button>
                                </form>
                            </div>

                            <h3 class="sidebar-title">Categories</h3>
                            <div class="sidebar-item categories">
                                <ul>
                                    @foreach ($semua_blog_kategori as $kategori)
                                        <li><a href="{{ route('blog-by-category', $kategori->id) }}">{{ $kategori->blog_category }}
                                                <span>({{ $kategori->blogs->count() }})</span></a></li>
                                    @endforeach
                                </ul>
                            </div>

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
                                                {!! \Illuminate\Support\Str::limit($blog_terbaru->blog_title, 30, '...') !!}
                                            </a></h4>
                                        <time
                                            datetime="{{ $blog_terbaru->updated_at->format('Y-m-d') }}">{{ $blog_terbaru->updated_at->format('d M Y') }}</time>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

@endsection
