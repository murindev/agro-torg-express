<?php


namespace App\Http\Controllers\Parsers;


use App\Http\Controllers\Controller;
use App\Models\Ads\Ad;
use App\Models\Geo\GeoCity;
use App\Models\Geo\City;
use App\Models\Geo\Country;
use App\Models\Geo\Federal;
use App\Models\Geo\GeoList;
use App\Models\Geo\Region;
use mysql_xdevapi\Exception;
use Symfony\Component\DomCrawler\Crawler;

class FermerRuCatalog extends Controller
{

// regions
    private $prevValue = 0;
    private $country = null;
    private $fd = null;
    private $region = null;
    private $city = null;
    private $geo_city = null;
    private $cnt = 1;

// settings
    private $domain = 'https://fermer.ru';
    private $node;
    private $exGeo = [];


// crawling
    private $category_main_tag;
    public $parsed = 0;
    public $type;

// data

    public $arrData = [];
    public $data = [
        'link' => null,
        'geo_list_value' => null,
        'datetime' => null,
        'type' => null,
        'donor' => 'fermer.ru'
    ];
    public $errors = [];


    public function index()
    {
        $this->type();
        $this->exGeo = explode(',',request('exclude'));

        $html = Curl::curl_get_contents($this->domain.request('url'), 'https://fermer.ru', 0, 0);

        $this->node = new Crawler($html);

        $this->catalog($this->node);

        return  json_encode($this);

    }


    public function errorHandler(\Exception $e){
        $fileArr = explode('/',$e->getFile());
        $this->errors[] = [
            'code' => $e->getCode(),
            'message' => $e->getMessage(),
            'file' => array_pop($fileArr),
            'line' => $e->getLine(),
        ];
    }


    public function type(){
        if(strpos(request('url'), 'gazeta')) {
            $this->category_main_tag = '.view-board-sale';
            $this->type = 'sale';
        } else {
            $this->category_main_tag = '.view-board-buy';
            $this->type = 'buy';
        }
    }

    public function catalog(Crawler $node)
    {

        try {
            $node->filter($this->category_main_tag.' .view-content > div')->each(function (Crawler $n) {
                $this->catalogItem($n);
            });
        } catch (\Exception $e) {
            $this->errorHandler($e);
        }

    }

    public function catalogItem(Crawler $node){
        try {
            $link = $node->filter('h4 a')->attr('href');
            $date = $node->filter('.fa-calendar .field-content')->text();
            $this->data['link'] = $link;
            $this->data['datetime'] = $this->date($date);
            $this->data['type'] = $this->type;
            $GeoText = $node->filter('.fa-pencil-square .field-content')->text();


            if(!in_array($GeoText,$this->exGeo)){
                array_push($this->arrData,$this->data);
                $this->fillTable($this->data);
            }

        } catch (\Exception $e) {
            $this->errorHandler($e);
        }

    }

    public function getAddId($link){
        try {
            $a = explode('/',$link);
            $b = explode('-',end($a));
            return (int)end($b);
        } catch (\Exception $e) {
            $this->errorHandler($e);
        }

    }
    public function date($str){
        try {
            $str = str_replace(".", "-", $str);
            $str = str_replace(" - ", " ", $str);
            return $str.':00';
        } catch (\Exception $e) {
            $this->errorHandler($e);
        }

    }

    public function fillTable($data){
        try {
            $ad = Ad::where('link',$this->data['link'])->first();
            if($ad == null){
                Ad::create($data);
                $this->parsed++;
            }
        } catch (\Exception $e) {
            $this->errorHandler($e);
        }
    }


    public function test(){
        return 'test';
    }


    public function geoRegions(Crawler $node)
    {


        try {

            $node->filter('#edit-field-sale-region-tid option')->each(function (Crawler $n) {

                $name = $n->text();
                $value = $n->attr('value');
                $is = '';


                $symbols = substr($name, 0, 3);

                $symbolsCnt = substr_count($symbols, '-');

                if ($symbolsCnt == 0) {
                    $is = 'country';

                    $this->country = $value;
                    $this->fd = null;
                    $this->region = null;
                    $this->city = null;
                    $this->geo_city = null;

                } elseif ($symbolsCnt == 1) {
                    $is = 'federal';

//                    $this->country = null;
                    $this->fd = $value;
                    $this->region = null;
                    $this->city = null;
                    $this->geo_city = null;
//                    $this->prevValue = $value;
                    $name = substr($name, 1);

                } elseif ($symbolsCnt == 2) {
                    $is = 'region';

//                    $this->country = null;
//                    $this->fd = null;
                    $this->region = $value;
                    $this->city = null;
                    $this->geo_city = null;
//                    $this->prevValue = $value;
                    $name = substr($name, 2);

                } elseif ($symbolsCnt == 3) {
                    $is = 'city';

//                    $this->country = null;
//                    $this->fd = null;
//                    $this->region = null;
                    $this->city = $value;
//                    $this->prevValue = $value;
                    $name = substr($name, 3);
                    $this->geo_city = GeoCity::where('UF_NAME', 'like', $name)->first();
                }

                /*
                 * slug
                 *code
                 * sort
                 * title_ru
                 *
                 * geo_countries
                 * \Geo\Country
                 * \Geo\CountryController
                 * */



                $item = [
                    'geo_id' => $this->geo_city != null ? $this->geo_city->ID : null,
                    'geo_xml_id' => $this->geo_city != null ? $this->geo_city->UF_XML_ID : null,
                    'is' => $is,
                    'cnt' => $this->cnt * 5,
                    'geo_city' => $this->geo_city,

                    'country' => $this->country,
                    'federal' => $this->fd,
                    'region' => $this->region,
                    'city' => $this->city,

                    'value' => $value,
                    'text' => $name,
                    'slug' => str_slug($name)
                ];


//                $this->h1[] = $item;



                switch ($is) {
                    case 'country':
                        try {
                            Country::create(['slug' => str_slug($name), 'code' => $value, 'sort' => $this->cnt, 'title_ru' => $name]);
                        } catch (\Exception $e){
                            if($e->getCode() != 23000){
                                dump($name, $e);
                            }

                        }

                        break;
                    case 'federal':
                        try {
                            Federal::create(['slug' => str_slug($name), 'code' => $value, 'country_id' => $this->country, 'sort' => $this->cnt, 'title_ru' => $name]);
                        } catch (\Exception $e){
                            if($e->getCode() != 23000){
                                dump($name, $e);
                            }
                        }

                        break;
                    case 'region':
                        try {
                            Region::create(['slug' => str_slug($name), 'code' => $value, 'country_id' => $this->country, 'federal_id' => $this->fd, 'sort' => $this->cnt, 'title_ru' => $name]);
                        } catch (\Exception $e){
                            if($e->getCode() != 23000){
                                dump($name, $e);
                            }
                        }

                        break;
                    case 'city':
                        try {
                            City::create([
                                'slug' => str_slug($name),
                                'code' => $value,
                                'sort' => $this->cnt,
                                'country_id' => $this->country,
                                'federal_id' => $this->fd,
                                'geobase_id' => $this->geo_city != null ? $this->geo_city->ID : null,
                                'geobase_xml_id' => $this->geo_city != null ? $this->geo_city->UF_XML_ID : null,
                                'region_id' => $this->region,
                                'title_ru' => $name
                            ]);
                        } catch (\Exception $e){
                            if($e->getCode() != 23000){
                                dump($name, $e);
                            }
                        }

                        break;
                }

                try {
                    unset($item['geo_city']);
                    GeoList::create($item);
                } catch (\Exception $e){
                    if($e->getCode() != 23000){
                        dump($name, $e);
                    }
                }


                $this->prevValue = $value;
                $this->cnt++;


            });
//            $this->h1 = $options;


//            $this->h1 =  $node->filter('#edit-field-sale-region-tid')->eq(0)->text();
        } catch (\Exception $e) {
            $this->errorHandler($e);
        }

    }

}
