<?php


namespace App\Http\ViewComposers;


use App\Models\Ads\Ad;
use App\Models\Ads\AdCategories;
use App\Models\Geo\Country;
use Illuminate\View\View;

class CatalogAsideNews
{
    public function compose(View $view){

        return $view->with([
            'jj' => '113213213'
//            'rubricas' => AdCategories::where('parent',0)->withCount('cnt')->get(),
//            'adsCnt' => Ad::count(),
        ]);
    }

}
