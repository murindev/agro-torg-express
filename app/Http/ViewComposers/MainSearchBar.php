<?php


namespace App\Http\ViewComposers;


use App\Models\Ads\AdCategories;
use App\Models\Geo\Country;
use App\Models\Geo\GeoList;
use Illuminate\View\View;

class MainSearchBar
{
    public function compose(View $view){
        return $view->with([
            'adCategories' => AdCategories::with(['children'])->get(),
            'geo' => Country::with(['federals.regions.cities'])->get()
        ]);
    }




}
