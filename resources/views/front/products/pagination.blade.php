@if ($paginator->hasPages())
    <div class="pagination-number">
        <ul>
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true">
                    <span aria-hidden="true"><i class="fa fa-angle-left"></i></span>
                </li>
            @else
               <li>
                    <a href="{{ $paginator->previousPageUrl() }}" title="Previous">
                        <i class="fa fa-angle-left"></i>
                    </a>
               </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" title="Next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            @else
                <li class="disabled" aria-disabled="true">
                    <i class="fa fa-angle-right"></i>
                </li>
            @endif
        </ul>
    </div>
@endif
