@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="btn  rounded-pill disabled" href="#">{!! __('pagination.previous') !!}</a>
        @else
        <a class="btn btn-outline-primary rounded-pill" rel="prev" href="{{ $paginator->previousPageUrl() }}">{!! __('pagination.previous') !!}</a>
        @endif

        @if ($paginator->hasMorePages())
        <a class="btn btn-outline-primary rounded-pill" rel="next" href="{{ $paginator->nextPageUrl() }}">{!! __('pagination.next') !!}</a>
        @else
            <a class="btn rounded-pill disabled" href="{{ $paginator->nextPageUrl() }}">{!! __('pagination.next') !!}</a>
        @endif
    </nav>
@endif
