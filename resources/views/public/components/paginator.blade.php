@if($paginator->hasPages())
    <nav class="blog-pagination">
        <a class="btn btn-outline-secondary @if($paginator->onFirstPage()) disabled @endif " href=" {{$paginator->previousPageUrl()}}">Newer</a>
        <a class="btn btn-outline-primary @if(!$paginator->hasMorePages()) disabled @endif" href="{{$paginator->nextPageUrl()}}">Older</a>
    </nav>
@endif
