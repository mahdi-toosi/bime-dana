@if ($paginator->hasPages())
<div class="p-2">
    <ul class=" pagination pager" style="direction: ltr">

        @if ($paginator->onFirstPage())
            <li  class=" page-item disabled"><span class="page-link" href="">قبلی</span></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">قبلی</a></li>
        @endif



        @foreach ($elements as $element)

            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif



            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active my-active"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach



        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">بعدی</a></li>
        @else
            <li class="page-item disabled"><span class="page-link">بعدی</span></li>
        @endif
    </ul>
</div>
@endif 