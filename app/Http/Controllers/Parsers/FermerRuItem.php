<?php


namespace App\Http\Controllers\Parsers;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper;
use App\Models\Ads\Ad;
use App\Models\Ads\AdCategories;
use App\Models\Comments\Comment;
use App\Models\Geo\Country;
use App\Models\Geo\Federal;
use App\Models\Geo\GeoIP;
use App\Models\Geo\GeoList;
use App\Models\Geo\Region;
use App\User;
use mysql_xdevapi\Exception;
use Symfony\Component\DomCrawler\Crawler;

class FermerRuItem extends Controller
{

    public $updated = null;

    public $data = [
        'link' => null,
        'ad_id' => null,
        'user_id' => null,
        'title' => null,
        'user_link' => null,
        'user_data' => null,
        'text' => null,
        'category_text' => null,
        'category_id' => null,
        'price' => null,
        'country_text' => null,
        'country_id' => null,
        'region_text' => null,
        'region_id' => null,
        'federal_id' => null,
        'city_id' => null,
        'city' => null,
        'geo_list_value' => null,
        'ownership' => 1,
        'photo' => [],
        'has_photo' => null,
        'contacts' => null,
        'email' => null,
        'comments' => [],
        'viewed' => null
    ];

//    private $commentUser


    public $errors = [];
    public $userErrors = [];
    public $userCommentsErrors = [];


    public function index()
    {

        $this->data['link'] = request('link');

        $html = Curl::curl_get_contents(request('url'), 'https://fermer.ru', 0, 0);

        $node = new Crawler($html);

        $this->title($node);
        $this->user($node);
        $this->text($node);
        $this->category($node);
        $this->price($node);
        $this->region($node);
        $this->town($node);
        $this->photo($node);
        $this->contacts($node);
        $this->email($node);
        $this->comments($node);
        $this->userData();
        $this->viewed($node);

        if($this->data['link']){
            $this->fillTable();
//            $this->saveComments();
//            $this->saveImages();
        }

        return json_encode($this);

//        dump($this->data);


    }

    public function fillTable()
    {
        try {
            $adId = Ad::where('link', $this->data['link'])->first();
            $this->data['ad_id'] = $adId->id;
        } catch (\Exception $e){
            $this->errorHandler($e,'fillTable 1');
        }

        try {
            $arrUpdate = [
                'title' => $this->data['title'],
                'slug' => trans($this->data['title']),
                'category' => $this->data['category_id'],
                'country_id' => $this->data['country_id'],
                'federal_id' => $this->data['federal_id'],
                'region_id' => $this->data['category_id'],
                'city_id' => $this->data['city_id'],
                'city' => $this->data['city'],
                'geo_list_value' => $this->data['geo_list_value'],
                'user_id' => $this->data['user_id'],
                'description' => $this->data['text'],
                'price' => $this->data['price'],
                'email' => $this->data['email'],
                'viewed' => $this->data['viewed'],
                'ownership' => $this->data['ownership'],
                'parsed' => 1,
            ];

            $ad = Ad::where('id',$this->data['ad_id'])->update($arrUpdate);

            if($ad){
                $this->updated = true;
            }

        } catch (\Exception $e){
            $this->errorHandler($e,'fillTable 2');
        }

    }


    public function userData()
    {
        try {

            $user = User::where('link', $this->data['user_link'])->first();

            if ($user != null) {
                $this->data['user_id'] = $user->id;
                if($user->company){
                    $this->data['ownership'] = 2;
                }

            } else {
                if($this->data['user_link'] == '/user/guest'){
                    $newUser = User::create([
                        'link' => '/user/guest',
                        'name' => 'Гость',
                        'surname' => '',
                        'email' => 'fermer.ru.Guest.@sample.ru',
                        'password' => \Hash::make('fermer0356512215050550500505050542100'),
                    ]);
                    $this->data['user_id'] = $newUser->id;
                } else {
                    $userClass = new FermerRuUser();
                    $u = $userClass->index($this->data['user_link']);
                    ///////////////////////////
                    $this->data['user_data'] = $u->data;
                    $this->userErrors[$this->data['user_link']] = $u->errors;
                    //////////////////////////
                    $newUser = User::create($this->data['user_data']);
                    $this->data['user_id'] = $newUser->id;
                    if($newUser->company){
                        $this->data['ownership'] = 2;
                    }
                }

            }
        } catch (\Exception $e) {
            $this->errorHandler($e,'userData');
        }


    }

    public function getUserCode($link){
        $linkArr = explode('/',$link);
        return array_pop($linkArr);
    }

    public function getCommentUserId($link)
    {
        try {
            $user = User::where('link', $this->data['user_link'])
                ->orWhere('email','fermer.ru.'.$this->getUserCode($this->data['user_link']).'@sample.ru')
                ->first();

            if ($user) {
                return $user->id;
            } else {
                $userClass = new FermerRuUser();
                $uComments = $userClass->index($this->data['user_link']);
                $newUser = User::create($uComments->data);
                $this->userCommentsErrors[$this->data['user_link']] = $uComments->errors;
                return $newUser->id;
            }
        } catch (\Exception $e){
            $this->errorHandler($e,'getCommentUserId');
        }
    }

    public function saveImages()
    {
        foreach ($this->data['photo'] as $key => $photo){
            try {
                Helper::imageSave($photo,$this->data['ad_id'],'ad',$key);
                if($key == 0){
                    Ad::where('id',$this->data['ad_id'])->update(['has_photo' => 1]);
                }
            } catch (\Exception $e) {
                $this->errorHandler($e,'saveImages ' . $key);
            }
        }

    }

    public function formatDate($str)
    {
        try {
            $arStr = explode('#', $str);
            $str = preg_replace("/[^-:.0-9]/", '', $arStr[0]);
            return preg_replace("/-/", ' ', $str);
        } catch (\Exception $e) {
            $this->errorHandler($e,'formatDate');
        }

    }

    public function saveComments()
    {
        foreach ($this->data['comments'] as $comment) {
            $dateFormatted = null;
            if($comment['date']){
                try {
                    $date = new \DateTime($this->formatDate($comment['date']));
                    $dateFormatted = $date->format('Y-m-d H:i:s');
                } catch (\Exception $e) {
                    $this->errorHandler($e,'saveComments 1');
                }
            }

            $arr = [
                'user_id' => $this->getCommentUserId($comment['link']),
                'to_user_id' => $this->data['user_id'],
                'entity' => 'ad',
                'entity_id' => $this->data['ad_id'],
                'link' => $comment['link'],
                'text' => $comment['post'],
                'updated_at' => $dateFormatted,
            ];
            try {

                $c = Comment::where('link' ,$comment['link'])->where('updated_at', $dateFormatted)->first();
                if($c == null) {
                    Comment::create($arr);
                }

            } catch (\Exception $e) {
                $this->errorHandler($e,'saveComments 2');
            }


        }
    }


    public function title(Crawler $node)
    {
        try {
            $title = $node->filter('h1')->eq(0)->text();
            $this->data['title'] = $title;
        } catch (\Exception $e) {
            $this->errorHandler($e,'title');
        }
    }

    public function user(Crawler $node)
    {
        try {
            $name = $node->filter('.submitted .username')->eq(0)->text();
            if(mb_strtoupper(trim($name)) === mb_strtoupper('Гость')){
                $this->data['user_link'] = '/user/guest';
            } else {
                $title = $node->filter('.submitted a')->eq(0)->attr('href');
                $this->data['user_link'] = $title;
            }

        } catch (\Exception $e) {
            $this->errorHandler($e,'user');
        }

    }



    public function text(Crawler $node)
    {
        try {
            $title = $node->filter('.field-name-body  .field-item')->eq(0)->html(); //
            $this->data['text'] = $title;
        } catch (\Exception $e) {
            if($e->getMessage() != 'The current node list is empty.'){
                $this->errorHandler($e,'text');
            }
        }
    }

    public function getCategory()
    {
        try {
            $category = AdCategories::where('title_ru', trim($this->data['category_text']))->first();
            $this->data['category_id'] = $category->id;
        } catch (\Exception $e) {
            $this->errorHandler($e,'getCategory');
        }
    }

    public function category(Crawler $node)
    {
        try {
            $title = $node->filter('.field-name-field-sale-category a')->eq(0)->text();
            $this->data['category_text'] = $title;
            $this->getCategory();
        } catch (\Exception $e) {
            $this->errorHandler($e,'category');
        }
    }


    public function price(Crawler $node)
    {
        try {
            $title = $node->filter('.field-name-field-sale-price .field-item')->eq(0)->text();
            $this->data['price'] = $title;
        } catch (\Exception $e) {
            if($e->getMessage() != 'The current node list is empty.'){
                $this->errorHandler($e,'price');
            }
        }
    }

    public function getRegion()
    {
        try {
            $point = GeoList::where('text',$this->data['region_text'])->first();

            $this->data['geo_list_value'] = $point->value;
            $this->data['country_id'] = $point->country;
            $this->data['federal_id'] = $point->federal;
            $this->data['region_id'] = $point->region;
            $this->data['city_id'] = $point->city;


/*            if ($country = Country::where('title_ru', $this->data['region_text'])->first()) {
                $this->data['country_id'] = $country->id;
            } elseif ($federal = Federal::where('title_ru', $this->data['region_text'])->first()) {
                $this->data['region_id'] = $federal->id;
                $this->data['country_id'] = 1;
            } elseif ($region = Region::where('title_ru', $this->data['region_text'])->first()) {
                $this->data['region_id'] = $region->id;
                $this->data['country_id'] = 1;
            }*/
        } catch (\Exception $e) {
            $this->errorHandler($e,'getRegion');
        }
    }


    public function region(Crawler $node)
    {
        try {
            $title = $node->filter('.field-name-field-sale-region a')->eq(0)->text();
            $this->data['region_text'] = $title;
            $this->getRegion();
        } catch (\Exception $e) {
            $this->errorHandler($e,'region');
        }
    }


    public function town(Crawler $node)
    {
        try {
            $title = $node->filter('.field-name-field-sale-town .field-item')->eq(0)->text();
            $this->data['city'] = $title;
        } catch (\Exception $e) {
            if($e->getMessage() != 'The current node list is empty.'){
                $this->errorHandler($e,'town');
            }
        }
    }

    public function photo(Crawler $node)
    {
        try {
            $title = $node->filter('.field-name-field-sale-photo img')->each(function (Crawler $n) {
                $this->data['photo'][] = $n->attr('src');
            });
        } catch (\Exception $e) {
            if($e->getMessage() != 'The current node list is empty.'){
                $this->errorHandler($e,'photo');
            }
        }
    }

    public function contacts(Crawler $node)
    {
        try {
            $title = $node->filter('.field-name-field-sale-contacts .field-item')->eq(0)->text();
            $this->data['contacts'] = $title;
        } catch (\Exception $e) {
            if($e->getMessage() != 'The current node list is empty.'){
                $this->errorHandler($e,'contacts');
            }
        }
    }

    public function email(Crawler $node)
    {
        try {
            $title = $node->filter('.field-name-field-email .field-item')->eq(0)->text();
            $this->data['email'] = $title;
        } catch (\Exception $e) {
            if($e->getMessage() != 'The current node list is empty.'){
                $this->errorHandler($e,'email');
            }
        }
    }


    public function comments(Crawler $node)
    {
        try {
            $title = $node->filter('#forum-comments .forum-post.clearfix')->each(function (Crawler $n) {
                $link = null;
                $date = null;
                $post = null;

                try {
                    $link = $n->filter('.author-pane-line a')->eq(0)->attr('href');
                } catch (\Exception $e){}

                try {
                    $date = $n->filter('.forum-post-info')->text();
                } catch (\Exception $e){}

                try {
                    $post = $n->filter('.forum-post-content .field-item')->html();
                } catch (\Exception $e){}


                $this->data['comments'][] = [
                    'link' => $link,
                    'date' => $date,
                    'post' => $post
                ];

            });

        } catch (\Exception $e) {
            $this->errorHandler($e,'comments');
        }
    }

    public function viewed(Crawler $node)
    {
        try {
            $title = $node->filter('.statistics_counter span')->eq(0)->text();
            $this->data['viewed'] = preg_replace("/[^,.0-9]/", '', $title);
        } catch (\Exception $e) {
            if($e->getMessage() != 'The current node list is empty.'){
                $this->errorHandler($e,'viewed');
            }
        }
    }

    public function errorHandler(\Exception $e, $subject = '')
    {

        $fileArr = explode('/', $e->getFile());
        $this->errors[] = [
            'code' => $e->getCode(),
            'message' => $e->getMessage(),
            'file' => array_pop($fileArr),
            'line' => $e->getLine(),
            'subject_item' => $subject
        ];
    }
}
