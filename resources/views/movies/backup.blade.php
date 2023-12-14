<!-- Display your movies here -->

<nav aria-label="Page navigation example">
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($movies->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $movies->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($movies as $item)
            <li class="page-item {{ $item->url($movies->currentPage()) == $movies->url($movies->currentPage()) ? 'active' : '' }}">
                <span class="page-link">{{ $item->url($movies->currentPage()) }}</span>
            </li>
        @endforeach

        {{-- Next Page Link --}}
        @if ($movies->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $movies->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">&rsaquo;</span>
            </li>
        @endif
    </ul>
</nav>










<h5 class="card-text">
    {{ empty($movie['title']) ? \Illuminate\Support\Str::limit($movie['name'], 25, $end='...') : \Illuminate\Support\Str::limit($movie['title'], 25, $end='...') }}


</h5>
<h5 class="card-title">
    {{ empty($movie['release_date']) ? \Illuminate\Support\Str::limit($movie['first_air_date'], 25, $end='...') : \Illuminate\Support\Str::limit($movie['release_date'], 25, $end='...') }}
</h5>
