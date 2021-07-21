<?php


namespace App\Http\Controllers\Site;


use App\Http\Controllers\Controller;
use App\Models\Ads\Ad;
use App\Models\Ads\AdCategories;
use App\Models\Geo\GeoList;

class Index extends Controller
{
    public function index(){

        $data = [
            'categories' => $this->categories(),
            'ads' => $this->ads(),
        ];

        if(request()->has('more')){
            return view('ajax.adCatalogMore',$data);
        } else {
            return view('index',$data);
        }

    }

    public function more(){
        return view('ajax.adCatalogMore',[
            'categories' => $this->categories(),
            'ads' => $this->ads(),
        ]);
    }

    public function categories(){
        return AdCategories::all();
    }

    public function ads(){
        $point = GeoList::where('slug',request()->session()->get('country'))->first();

        return Ad::with(['picture','geo'])->where('active', 1)
            ->where($point->is.'_id',$point->value)
            ->paginate(15,['*'],'', request('page'));

    }


}
