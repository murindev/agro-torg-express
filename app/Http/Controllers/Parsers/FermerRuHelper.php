<?php


namespace App\Http\Controllers\Parsers;

use App\Http\Controllers\Controller;
use App\Models\Ads\Ad;
use App\Models\Geo\GeoIP;

class FermerRuHelper extends Controller
{
    public function getNewItems(){
        return Ad::where('donor','fermer.ru')->where('parsed',0)->get();
    }

    public function getNewItem(){
        $parsed = Ad::where('donor','fermer.ru')->where('parsed',1)->count();
        $all = Ad::where('donor','fermer.ru')->count();
        $next = $try = Ad::where('donor','fermer.ru')
            ->where('parsed',0)
//            ->where('try', '<=', 1)
            ->first();
        if($next){
            $try->update(['try' => $try->try + 1]);
        } else {
            $next = 'end';
        }

        return json_encode([
            'next' => $next,
            'parsed' => $parsed,
            'all' => $all,
        ]);
    }

    public function testItems(){
        return Ad::where('link',request('link'))->first();
    }

    public static function getCity(){
        $ip = '31.43.0.0';
//522911744
//522919935


        dump($_SERVER["REMOTE_ADDR"]);

        dump(FermerRuHelper::ip_info($ip));
        dump('ip2long', ip2long($ip));
        $yy = ip2long($ip);
        dump('$yy)', $yy);
        try {

            $rt = GeoIP::where('UF_BLOCK_BEGIN','<=',522911744)->where('UF_BLOCK_END','>=',522911744)->get();
//            $rt = GeoIP::where('UF_CITY_ID',32)->first();
            dump($rt);
        } catch (\Exception $e){
            dump($e);
        }



        /*        $data = $DB->Query("SELECT * FROM reaspekt_geobase_codeip
                            INNER JOIN reaspekt_geobase_cities ON reaspekt_geobase_codeip.UF_CITY_ID = reaspekt_geobase_cities.UF_XML_ID
                            WHERE reaspekt_geobase_codeip.UF_BLOCK_BEGIN <= " . $DB->ForSql($codeIP) . " AND " . $DB->ForSql($codeIP) . " <= reaspekt_geobase_codeip.UF_BLOCK_END"
                );*/

    }


    public static function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
        $output = NULL;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
        $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
        $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
        $continents = array(
            "AF" => "Africa",
            "AN" => "Antarctica",
            "AS" => "Asia",
            "EU" => "Europe",
            "OC" => "Australia (Oceania)",
            "NA" => "North America",
            "SA" => "South America"
        );
        if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
            $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
            if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                switch ($purpose) {
                    case "location":
                        $output = array(
                            "city"           => @$ipdat->geoplugin_city,
                            "state"          => @$ipdat->geoplugin_regionName,
                            "country"        => @$ipdat->geoplugin_countryName,
                            "country_code"   => @$ipdat->geoplugin_countryCode,
                            "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                            "continent_code" => @$ipdat->geoplugin_continentCode
                        );
                        break;
                    case "address":
                        $address = array($ipdat->geoplugin_countryName);
                        if (@strlen($ipdat->geoplugin_regionName) >= 1)
                            $address[] = $ipdat->geoplugin_regionName;
                        if (@strlen($ipdat->geoplugin_city) >= 1)
                            $address[] = $ipdat->geoplugin_city;
                        $output = implode(", ", array_reverse($address));
                        break;
                    case "city":
                        $output = @$ipdat->geoplugin_city;
                        break;
                    case "state":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "region":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "country":
                        $output = @$ipdat->geoplugin_countryName;
                        break;
                    case "countrycode":
                        $output = @$ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }
        return $output;
    }

    public static function mb_strcasecmp($str1, $str2, $encoding = null) {
        if (null === $encoding) {
            $encoding = mb_internal_encoding();
        }
        return strcmp(mb_strtolower($str1, $encoding), mb_strtolower($str2, $encoding));
    }

    public static function utf8_strrev($str){
        preg_match_all('/./us', $str, $matches);
        return join('', array_reverse($matches[0]));
    }

}
