<?php


namespace App\Http\Controllers\Parsers;


use App\Http\Controllers\Controller;
use App\Models\Geo\GeoCity;
use App\Models\Geo\Country;
use App\User;
use Symfony\Component\DomCrawler\Crawler;

class FermerRuUser extends Controller
{

    public $data = [
        'link' => null,             //  link
        'nic' => null,              //  nic
        'name' => null,             //  name
        'surname' => null,          //  surname
        'birthday' => null,         //  birthday
        'gender' => null,           //  gender
        'company' => null,          //  company
        'position' => null,         //  position
        'country_id' => null,       //  country_id
        'city_id' => null,          //  city_id
        'city_name' => null,        //  city_name
        'contacts' => null,         //  contacts
        'signature' => null,        //  signature
        'email' => null,        //  signature
        'password' => null,        //  signature
    ];
    public $errors = [];


    public function index($link)
    {
        $html = Curl::curl_get_contents('https://fermer.ru'.$link, 'https://fermer.ru', 0, 0);
        $this->data['link'] = $link;
        $node = new Crawler($html);
        $this->nic($node);
        $this->name($node);
        $this->surname($node);
        $this->birthday($node);
        $this->gender($node);
        $this->work($node);
        $this->position($node);
        $this->country($node);
        $this->city($node);
        $this->contacts($node);
        $this->signature($node);
        $this->makeUserData();
        return $this;
    }




    public function makeUserData(){
        try {
            $fromLinkArray = explode('/', $this->data['link']);
            $idNum = array_pop( $fromLinkArray);
            $this->data['email'] = 'fermer.ru.'.$idNum.'@sample.ru';
            $this->data['password'] = \Hash::make('fermer'.$idNum.'2100') ;
        } catch (\Exception $e){
            $this->errorHandler($e,'makeUserData');
        }
    }

    public function nic(Crawler $node)
    {
        try {
            $title = $node->filter('h1')->eq(0)->text();
            $this->data['nic'] = $title;
        } catch (\Exception $e) {
            $this->errorHandler($e,'nic');
        }
    }

    public function name(Crawler $node)
    {
        try {
            $title = $node->filter('.field-name-field-name .field-item')->eq(0)->text();
            $this->data['name'] = $title;
        } catch (\Exception $e) {
            $this->errorHandler($e,'name');
        }
    }

    public function surname(Crawler $node)
    {
        try {
            $title = $node->filter('.field-name-field-surname .field-item')->eq(0)->text();
            $this->data['surname'] = $title;
        } catch (\Exception $e) {
            $this->errorHandler($e,'surname');
        }
    }

    public function birthday(Crawler $node)
    {
        try {
            $title = $node->filter('.field-name-birthdays .field-item')->eq(0)->text();
            $this->data['birthday'] = $title;
        } catch (\Exception $e) {
            $this->errorHandler($e,'birthday');
        }
    }

    public function gender(Crawler $node)
    {
        try {
            $title = $node->filter('.field-name-field-gender .field-item')->eq(0)->text();

            if($title == 'Мужской') {
                $this->data['gender'] = 1;
            } elseif ($title == 'Женский') {
                $this->data['gender'] = 2;
            } else {
                $this->data['gender'] = 3;
            }

        } catch (\Exception $e) {
            $this->errorHandler($e,'gender');
        }
    }

    public function work(Crawler $node)
    {
        try {
            $title = $node->filter('.field-name-field-work .field-item')->eq(0)->text();
            $this->data['company'] = $title;
        } catch (\Exception $e) {
            $this->errorHandler($e,'work');
        }
    }

    public function position(Crawler $node)
    {
        try {
            $title = $node->filter('.field-name-field-position .field-item')->eq(0)->text();
            $this->data['position'] = $title;
        } catch (\Exception $e) {
            $this->errorHandler($e,'position');
        }
    }

    public function getCountryId(){
        try {
            $country = Country::where('title_ru',$this->data['country'])->first();
            if($country){
                $this->data['country_id'] = $country->code;
            }

        } catch (\Exception $e) {
            $this->errorHandler($e,'getCountryId');
        }
    }

    public function getCityId(){
        try {
            $country = GeoCity::where('UF_NAME',$this->data['city_name'])->first();
            if($country){
               $this->data['city_id'] = $country->UF_XML_ID;
            }

        } catch (\Exception $e) {
            $this->errorHandler($e,'getCityId');
        }
    }
// 118923
    public function country(Crawler $node)
    {
        try {
            $title = $node->filter('.field-name-field-country .field-item')->eq(0)->text();
            $this->data['country'] = $title;
            $this->getCountryId();
        } catch (\Exception $e) {
            $this->errorHandler($e,'country');
        }
    }

    public function city(Crawler $node)
    {
        try {
            $title = $node->filter('.field-name-field-city .field-item')->eq(0)->text();
            $this->data['city_name'] = $title;
            $this->getCityId();
        } catch (\Exception $e) {
            $this->errorHandler($e,'city');
        }
    }

    public function contacts(Crawler $node)
    {
        try {
            $title = $node->filter('.field-name-field-contacts .field-item')->eq(0)->text();
            $this->data['contacts'] = $title;
        } catch (\Exception $e) {
            $this->errorHandler($e,'contacts');
        }
    }

    public function signature(Crawler $node)
    {
        try {
            $title = $node->filter('.field-name-user-signature .field-item')->eq(0)->text();
            $this->data['signature'] = $title;
        } catch (\Exception $e) {
            $this->errorHandler($e,'signature');
        }
    }

    public function errorHandler(\Exception $e, $entity = ''){
        $fileArr = explode('/',$e->getFile());
        $this->errors[] = [
            'code' => $e->getCode(),
            'message' => $e->getMessage(),
            'file' => array_pop($fileArr),
            'line' => $e->getLine(),
            'entity_user' => $entity
        ];
    }

}
