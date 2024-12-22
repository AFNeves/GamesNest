@if ($paginator->hasPages())
    <div class="paginator">
        @if ($paginator->onFirstPage())
            <span class="paginator-button invisible">Previous</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="paginator-button">Previous</a>
        @endif

        <span class="text-base">
            Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results
        </span>

        @if (!$paginator->hasMorePages())
            <span class="paginator-button invisible">Next</span>
        @else
            <a href="{{ $paginator->nextPageUrl() }}" class="paginator-button">Next</a>
        @endif
    </div>
@endif
