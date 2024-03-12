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
                            </ul>
                        </div>

                        <div class="entry-content">
                            <span style="line-height: 30px">
                                {!! $blog->blog_description !!}
                            </span>
                        </div>
                    </article><!-- End blog entry -->


                </div><!-- End blog entries list -->

                {{--  sidebar  --}}
                @include('frontend.blog.sidebar')

            </div>

        </div>
    </section><!-- End Blog Section -->
@endsection
