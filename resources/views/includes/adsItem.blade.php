{{--@dump($ad->picture->path)--}}
<div class="board">

    <div class="board-item">
        <div class="board-item-img"
             style="background: url({{url($ad->picture ? '/storage'.$ad->picture->path : '/img/_special/notphoto.gif')}}) no-repeat; background-size: cover">

            <a class="item-favor" href="javascript:">
                <span><em>Добавить в избранное</em></span>
            </a>

            <div class="board-item-fast">
                <a href="javascript:">
                    <span>Быстрый просмотр</span>
                </a>
            </div>

        </div>


        <a class="board-item-name" href="/ad-item-page">
            {{Str::limit(strip_tags($ad->title), 50, '...')}}
            {{--Str::ucfirst(Str::of($ad->title)->lower()--}}
        </a>
        <span class="board-item-price">{{\App\Http\Controllers\Helper::formatPrice($ad->price)}}</span>

        <div class="board-item-content">

            <div class="board-item-geo">
                <a class="board-item-geo-pointer" href="javascript:">
                    @isset($ad->geo->text) {{$ad->geo->text}}  @endisset
                </a>
                {{--Краснодарский край--}}
                <em class="board-item-geo-date">Сегодня 08:30</em>
            </div>

            <div class="board-item-rates">
                <span class="board-item-views">9689 (+41)</span>
                <span class="board-item-rate"></span>
            </div>

            <div class="board-item-proof">
                <span>Подтверждён</span>
            </div>

        </div>
    </div>

</div>
