@extends('tpl.main')

@section('index')

    <mainslider lang="ru" :slides="{{$categories}}"></mainslider>

    @include('partials.mainSearchBar')
    @include('partials.rubricatorCounter')
    @include('partials.topFilter')


    <section class="adsCatalog">
        <div>
            <div class="adsCatalog-filter">
                <div class="adsCatalog-filter-sort">
                    <b>Сортировать по: </b>
                    <input type="checkbox" name="sort-catalog" id="catalog-date"/>
                    <label class="checkbox-arrow" for="catalog-date" @click="testClick()">Дате: <i
                                class="top"></i></label>
                    <input type="checkbox" name="sort-catalog" id="catalog-price"/>
                    <label class="checkbox-arrow" for="catalog-price">Цене:<i class="down"></i></label>
                </div>
                <div class="adsCatalog-filter-view">
                    <b>Вид: </b>
                    <button type="button" class="icon active" id="cells"></button>
                    <button type="button" class="icon" id="cols"></button>
                </div>
            </div>

            <div class="adsCatalog-sections">

                <div class="adsCatalog-aside">
                    @include('partials.catalogAsideVip')
                    @include('partials.catalogAsideNews')
                    @include('partials.catalogAsideAds')
                    <div class="adsCatalog-aside-buy">
                        <a href="javascript:">Купить платные обьявления</a>
                    </div>
                </div>

                <div class="adsCatalog-catalog">

                    @foreach($ads as $key => $ad)
                        @if($key < 6)
                            @include('includes.adsItem', ['ad' => $ad])
                        @endif
                    @endforeach

                    <catalog-board-slider></catalog-board-slider>

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
                </div>

            </div>
        </div>
    </section>

@stop
