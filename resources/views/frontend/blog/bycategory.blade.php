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

                    {{--  sidebar  --}}
                    @include('frontend.blog.sidebar')
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
                                        <li class="d-flex align-items-center"><i class="icofont-tags"></i>
                                            {{-- <a
                                                href="{{ route('blog-by-category', $blog->category->id) }}">{{ $blog->category->blog_category }}</a> --}}
                                            @if ($blog->category && $blog->category->id)
                                                <a
                                                    href="{{ route('blog-by-category', $blog->category->id) }}">{{ $blog->category->blog_category }}</a>
                                            @else
                                                <a href="{{ route('blog-uncategorized') }}">Uncategorized</a>
                                            @endif

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
                                        <a href="{{ route('blog-single', $blog->id) }}">Read More</a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                        <div class="guru-pagination" style="margin-top: 40px">
                            {{ $semua_blog->links('vendor.pagination.custom') }}
                        </div>
                    </div>

                    {{--  sidebar  --}}
                    @include('frontend.blog.sidebar')
                </div>
            </div>
        </section>
    @endif

@endsection
