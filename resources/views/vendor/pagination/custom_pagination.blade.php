@if ($paginator->hasPages())
  <ul class="pagination flex">
    {{-- 1,2,3,4,5,6,7,8,9,10,11,12,13 total(13) --}}

    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
      <li class="disabled"><span class="link">«</span></li>
    @else
      <li class=""><a class="link" href="{{ $paginator->previousPageUrl() }}" rel="prev">«</a></li>
    @endif

    @if (count($elements[0]) <= 6 && $paginator->currentPage() <= 6)
      @foreach (range(1, count($elements[0])) as $i)
        @if ($i == $paginator->currentPage())
          <li><span class="active link">{{ $i }}</span></li>
        @else
          <li class=""><a class="link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
        @endif
      @endforeach
    @elseif(count($elements[0]) <= 7 && $paginator->currentPage() <= 7)
      {{-- only 7 --}}
      @if ($paginator->currentPage() >= 5)
        <li class="hidden-xs "><a class="link" href="{{ $paginator->url(1) }}">1</a></li>
        <li class="hidden-xs "><a class="link" href="{{ $paginator->url(2) }}">2</a></li>
        <li class=""><span class="link">...</span></li>
      @endif
      {{-- 1, ... (currentPage == over 4) --}}
      @if ($paginator->currentPage() == 4)
        <li class="hidden-xs "><a class="link" href="{{ $paginator->url(1) }}">1</a></li>
        <li class=""><span class="link">...</span></li>
      @endif

      @foreach (range(1, count($elements[0])) as $i)
        @if ($paginator->currentPage() <= 3 && $i <= 4)
          @if ($i == $paginator->currentPage())
            <li><span class="active link">{{ $i }}</span></li>
          @else
            <li class=""><a class="link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
          @endif
        @else
          {{-- between (3, 4, 5) --}}
          @if ($i >= $paginator->currentPage() - 1 && $i <= $paginator->currentPage() + 1)
            @if ($i == $paginator->currentPage())
              <li><span class="active link">{{ $i }}</span></li>
            @else
              <li class=""><a class="link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
            @endif
          @else
            @if ($paginator->currentPage() >= 5 && $i >= 4)
              @if ($i == $paginator->currentPage())
                <li><span class="active link">{{ $i }}</span></li>
              @else
                <li class=""><a class="link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
              @endif
            @endif
          @endif
        @endif
      @endforeach
      {{-- ..., 6,7 (currentPage == over 4) --}}
      @if ($paginator->currentPage() <= 3)
        <li class=""><span class="link">...</span></li>
        <li class="hidden-xs "><a class="link" href="{{ $paginator->url($paginator->lastPage() - 1) }}">{{ $paginator->lastPage() - 1 }}</a></li>
        <li class="hidden-xs "><a class="link" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
      @endif

      @if ($paginator->currentPage() == 4)
        <li class=""><span class="link">...</span></li>
        <li class="hidden-xs "><a class="link" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
      @endif

    @else
      {{-- 1, 2, ... (currentPage == over 4) --}}
      @if ($paginator->currentPage() >= 5)
        <li class="hidden-xs "><a class="link" href="{{ $paginator->url(1) }}">1</a></li>
        <li class="hidden-xs "><a class="link" href="{{ $paginator->url(2) }}">2</a></li>
        <li class=""><span class="link">...</span></li>
      @endif

      {{-- clone original array and generate new array --}}
      @foreach (range(1, $paginator->lastPage()) as $i)
        @if ($paginator->currentPage() < 5)
          {{-- output first 5 numbers if current is 1 and under 3    1 2 3 4 (currentPage == 1, 2, 3) --}}
          @if ($i <= 5)
            @if ($i == $paginator->currentPage())
              <li><span class="active link">{{ $i }}</span></li>
            @else
              <li class=""><a class="link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
            @endif
          @endif
        @else
          {{-- 3, 4, 5 (currentPage == 4 and under 11) --}}
          @if ($i >= $paginator->currentPage() - 1 && $i <= $paginator->currentPage() + 1 && $paginator->currentPage() <= $paginator->lastPage() - 4)
            {{-- {{ 'between' . $i }} --}}
            @if ($i == $paginator->currentPage())
              <li><span class="active link">{{ $i }}</span></li>
            @else
              <li class=""><a class="link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
            @endif
          @else
            {{-- output last 4 numbers if current is 11 and over    10, 11, 12, 13 (currentPage == 11, 12, 13) --}}
            @if ($i >= $paginator->lastPage() - 4 && $paginator->currentPage() > $paginator->lastPage() - 4)
              {{-- {{ 'end' . $i }} --}}
              @if ($i == $paginator->currentPage())
                <li><span class="active link">{{ $i }}</span></li>
              @else
                <li class=""><a class="link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
              @endif
            @endif
          @endif
        @endif
      @endforeach

      {{-- ..., 12, 13 (currentPage == under 11) --}}
      @if ($paginator->currentPage() < $paginator->lastPage() - 3)
        <li class=""><span class="link">...</span></li>
        <li class="hidden-xs "><a class="link" href="{{ $paginator->url($paginator->lastPage() - 1) }}">{{ $paginator->lastPage() - 1 }}</a></li>
        <li class="hidden-xs "><a class="link" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
      @endif
    @endif

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
      <li class=""><a class="link" href="{{ $paginator->nextPageUrl() }}" rel="next">»</a></li>
    @else
      <li class="disabled"><span class="link">»</span></li>
    @endif
  </ul>
@endif
