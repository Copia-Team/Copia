<div class="pagination d-flex justify-content-between p-4">
    <ul class="pagination">
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link" aria-label="Previous">Previous</span>
            </li>
        @else
            <li class="page-item">
                <a href="{{ $paginator->previousPageUrl() }}" class="page-link text-dark" aria-label="Previous">
                    <span>Previous</span>
                </a>
            </li>
        @endif
    </ul>

    <div class="page-label text-center">
        Page {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }}
    </div>

    <ul class="pagination">
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a href="{{ $paginator->nextPageUrl() }}" class="page-link text-dark" aria-label="Next">
                    <span>Next</span>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link" aria-label="Next">Next</span>
            </li>
        @endif
    </ul>
</div>
