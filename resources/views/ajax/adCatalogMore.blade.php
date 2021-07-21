@foreach($ads as $key => $ad)
    @if($key >= 6)
        @include('includes.adsItem', ['ad' => $ad])
    @endif
@endforeach

<div class="pagination">
    @if($ads->lastPage() > $ads->currentPage())
        <a class="pagination-more" href="javascript:" id="boardItemMore" rel="{{$ads->currentPage()}}">
            <span>Показать еще . . .</span>
        </a>
    @endif

    @if($ads->lastPage() > 1)
        <div class="pagination-pages">

            @if($ads->lastPage() > $ads->currentPage())
                <a class="pagination-pages-next" href="?page={{ $ads->currentPage() + 1}}">Следущая страница</a>
            @endif

            <ul>
                @for($i = 1; $i <= $ads->lastPage(); $i++)

                    <li>
                        <a @if($i == $ads->currentPage()) class="active" @endif
                        @if($i != $ads->currentPage()) href="?page={{$i}}" @endif >
                            <span>{{$i}}</span>
                        </a>
                    </li>
                @endfor
            </ul>
        </div>

    @endif

</div>
