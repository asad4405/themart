@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-rounded">
            @if ($paginator->onFirstPage())
                <li class="page-item"><a class="page-link" href="#"><i data-feather="chevron-left"></i></a></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}"><i
                            data-feather="chevron-left"></i></a></li>
            @endif

            @foreach ($users as $user)
                @if (is_string($user))
                    <li class="page-item disabled">{{ $user }}</li>
                @endif
                @if (is_array($user))
                    @foreach ($user as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <a class="page-link">{{ $page }}</a>
                            </li>
                        @else
                            <li class="page-item active">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}"><i
                            data-feather="chevron-right"></i></a></li>
            @else
                <li class="page-item"><a class="page-link" href="#"><i data-feather="chevron-right"></i></a>
                </li>
            @endif
        </ul>
    </nav>
@endif
