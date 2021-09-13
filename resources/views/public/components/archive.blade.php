@inject("layout","App\Services\LayoutService")

<div class="p-3">
    <h4 class="font-italic">Archives</h4>
    <ol class="list-unstyled mb-0">

        @forelse($layout->archive() as $k=>$v)
            <li><a href="{{route('posts.archive',['year'=>$v['y'],'month'=>$v['m']])}}">{{$k}}</a></li>
        @empty
            <h4>No archives found!</h4>
        @endforelse
    </ol>
</div>
