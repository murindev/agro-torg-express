<section class="adCategories">
    <div>
        <div class="adCategories-row">
            <div class="adCategories-count">

                Все обьявления в Москве {{number_format($adsCnt,0,' ',' ')}}
            </div>
            <div class="adCategories-items">
                @foreach($rubricas as $rubrica)
                    <div class="adCategories-item">
                        <a href="javascript:">
                            {{$rubrica->title_ru}}
                        </a>
                        <span>{{number_format($rubrica->cnt_count,0,' ',' ')}}</span>
                    </div>
                @endforeach

{{--                <div class="adCategories-item">
                    <a href="javascript:">
                        Еще...
                    </a>
                </div>--}}

            </div>
        </div>
    </div>
</section>
