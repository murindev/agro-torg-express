<section class="mainSearchBar">
    <div>
        <div class="mainSearchBar-items">
            <div class="mainSearchBar-category">

                <select name="ads_catalog" class="mainSearchBar-category-select">
                    @foreach($adCategories as $category)
                        @if($category->parent == 0)
                            <option style="font-weight:bold; padding: 10px 0;">{{$category->title_ru}}</option>
                                @foreach($category->children as $children)
                                    <option value="{{$children->code}}">&nbsp; &nbsp; {{$children->title_ru}}</option>
                                @endforeach
                        @endif
                    @endforeach
                </select>


            </div>

            <div class="mainSearchBar-search">
                <input name="ads_search" type="search"/>
            </div>

            <div class="mainSearchBar-geo">
                <select name="ads_geo" class="mainSearchBar-category-select">
                    @foreach($geo as $country)
                        <option style="font-weight:bold; padding: 10px 0;" value="{{$country->id}}">{{$country->title_ru}}</option>
                        @foreach($country->federals as $federals)
                            <option style="color:#fea20f;font-weight:bold;" value="{{$federals->id}}">&nbsp;&nbsp;{{$federals->title_ru}}</option>
                            @foreach($federals->regions as $regions)
                                <option value="{{$regions->id}}">&nbsp;&nbsp;&nbsp;&nbsp;{{$regions->title_ru}}</option>
                                @foreach($regions->cities as $cities)
                                    <option value="{{$cities->id}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$cities->title_ru}}</option>
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                </select>
            </div>

            <div class="mainSearchBar-btn">
                <a class="btn" href="javascript:"></a>
            </div>

        </div>
    </div>
</section>
