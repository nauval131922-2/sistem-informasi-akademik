@if ($paginator->hasPages())

      <ul class="justify-content-center">
        @if ($paginator->onFirstPage())
            <li class="disabled">
                <i class="icofont-rounded-left"></i>
            </li>
        @else
            <li class=""> 
                <a class="" href="{{ $paginator->previousPageUrl() }}"><i class="icofont-rounded-left"></i></i></a>
            </li>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled" ><span>{{ $element }}</span></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active" ><a class="" href="{{ $url }}">{{ $page }}</a></li>
                    @else
                        <li><a class="" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

         @if ($paginator->hasMorePages())
              <li class="">
                  <a class="" href="{{ $paginator->nextPageUrl() }}"><i class="icofont-rounded-right"></i></a>
              </li>
          @else
              <li class="disabled">
                  <i class="icofont-rounded-right"></i>
              </li>
          @endif
      </ul>

  {{-- <nav aria-label="Page navigation example">
      <ul class="pagination">
        @if ($paginator->onFirstPage())
            <li class="disabled page-item" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <a class="page-link" href="#"><i class="far fa-long-arrow-left"></i></a>
            </li>
        @else
            <li class="page-item"> 
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><i class="far fa-long-arrow-left"></i></a>
            </li>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @else
                        <li><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

         @if ($paginator->hasMorePages())
              <li class="page-item">
                  <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><i class="far fa-long-arrow-right"></i></a>
              </li>
          @else
              <li class="disabled page-item" aria-disabled="true" aria-label="@lang('pagination.next')">
                  <a class="page-link" href="#"><i class="far fa-long-arrow-right"></i></a>
              </li>
          @endif
      </ul>
  </nav> --}}

@endif


