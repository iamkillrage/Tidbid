@if($paginator->hasPages())
<div class="influ-pagi">
    <ul>
        @if ($paginator->onFirstPage())
       
        <li><a href="javascript:void(0);" class="disabled"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></li>
        @else
        <li><a href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></a></li>
        @endif
        @foreach ($elements as $element)
        @if(is_string($element))
        <li class="disabled"><a href="#">1</a></li>
        @endif
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="active"><a>{{ $page }}</a></li>
        @else
        <li><a href="{{ $url }}">{{ $page }}</a></li>
        @endif
        @endforeach
        @endif
        @endforeach
        @if ($paginator->hasMorePages())
        <li><a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
        @else
        <li><a href="javascript:void(0);"> <i class="fa fa-arrow-right" aria-hidden="true"></i></li>
        @endif
    </ul>
    <form action="">
        <div class="influ-pagi-in show-cases-pages">
            <p>Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} records</p>
        </div>
    </form>
</div>
@endif