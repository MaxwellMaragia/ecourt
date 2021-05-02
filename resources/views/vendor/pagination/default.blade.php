@if ($paginator->hasPages())
    <div class="pagination__wrapper add_bottom_15">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"  class="prev" title="previous page">&lsaquo;</a>
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
                            <li class="active" aria-current="page"><span><a href="#" class="active">{{ $page }}</a></span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')" class="next">&rsaquo;</a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </div>>
@endif


{{--<div class="pagination__wrapper add_bottom_15">--}}
{{--    <ul class="pagination">--}}
{{--        <li><a href="#0" class="prev" title="previous page">❮</a></li>--}}
{{--        <li><a href="#0" class="active">1</a></li>--}}
{{--        <li><a href="#0">2</a></li>--}}
{{--        <li><a href="#0">3</a></li>--}}
{{--        <li><a href="#0">4</a></li>--}}
{{--        <li><a href="#0" class="next" title="next page">❯</a></li>--}}
{{--    </ul>--}}
{{--</div>--}}
