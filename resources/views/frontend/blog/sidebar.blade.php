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
                {{-- Uncategorized and hitung blog yang blog_category_id = null --}}
                <li><a href="{{ route('blog-uncategorized') }}">Uncategorized
                        <span>({{ $semua_blog_tanpa_kategori->count() }})</span></a></li>
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