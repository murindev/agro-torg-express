<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Helper;
use App\Models\Geo\Country;
use App\Models\Geo\GeoList;
use Closure;


class GeoIP
{


    protected function makeMyCookie($AccountPlan)
    {
//        return Cookie::queue(Cookie::make('a_p', $AccountPlan, 129600));
        return \Cookie::make('a_p', $AccountPlan, 129600);
    }

    protected function hasCookie($cookie_name)
    {
        $cookie_exist =\Cookie::get($cookie_name);
        return ($cookie_exist) ? true : false;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $point = \Cookie::get('slug');

        if($point){
            if($request->route('country') === null){
                return $next($request);
            } elseif($request->route('country') == $point){
                $request->session()->put('country', $request->route('country'));
                return $next($request);
            } elseif(Helper::isGeoIsset($request->route('country'))) {
                $request->session()->put('country', $request->route('country'));
                return $next($request);
            }
        }
        else {
            $slug = $this->getGeoPoint();
            \Cookie::queue('slug',$slug,36000);
            $request->session()->put('country', $slug);
            $request->session()->save();
            return $next($request);
        }
    }


    public function getGeoPoint(){

        $val = null;

        $ip = ip2long('62.183.0.14'); //'37.110.214.8'\request()->ip()
        $data = \App\Models\Geo\GeoIP::with('city')
            ->where('UF_BLOCK_BEGIN','<=',$ip)
            ->where('UF_BLOCK_END','>=',$ip)
            ->first();

        if($data->UF_COUNTRY_CODE && $data->UF_COUNTRY_CODE == 'RU'){
            $city = GeoList::where('text',$data->city->UF_NAME)->first();
            if($city){
                return $city->slug;
            }
            $region = GeoList::where('text',$data->city->UF_REGION_SHORT)->first();
            if($region){
                return $region->slug;
            }
            $federal = GeoList::where('text',$data->city->UF_COUNTY_NAME)->first();
            if($federal){
                return $federal->slug;
            }

        } else {
            $country = Country::where('country_code',$data->UF_COUNTRY_CODE)->first();
            $geoList = GeoList::where('text',$country->title_ru)->first();
            return $geoList->slug;
        }
    }







}
