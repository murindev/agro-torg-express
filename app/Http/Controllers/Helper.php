<?php


namespace App\Http\Controllers;


use App\Models\File;
use App\Models\Geo\GeoList;
use Intervention\Image\ImageManager;
use phpDocumentor\Reflection\Types\This;

class Helper extends Controller
{
    public static function imageSave($path,$entity_id,$entity,$key, $resize = false ){
        $result = false;
        try {
            $path = explode('?',$path);
            $path = $path[0];

            $manager = new ImageManager(array('driver' => 'gd'));
            $arrPath = explode('.',$path);
            $ext = array_pop($arrPath);
            $filename = $entity.'_'.$entity_id.'_'.$key.'.'.$ext;

            $imgOriginal = $manager->make($path);
            $imgOriginal->response($ext);

            if($resize){
                $imgMiddle = $manager->make($path);
                $imgMiddle->resize(null, '452', function ($constraint) {
                    $constraint->aspectRatio();
                })->response($ext);

                $imgThumb = $manager->make($path);
                $imgThumb->resize(null, '185', function ($constraint) {
                    $constraint->aspectRatio();
                })->response($ext);
                \Storage::disk('public')->put('/uploads/'.$entity.'/middle/' . $filename,  $imgMiddle);
                \Storage::disk('public')->put('/uploads/'.$entity.'/thumb/' . $filename,  $imgThumb);
            }


            $fullPath = '/uploads/'.$entity.'/orig/' . $filename;




            $file = File::where('path',$fullPath)->first();

            if($file) {
                $result = null;
            }

            if(\Storage::disk('public')->put($fullPath,  $imgOriginal) && is_null($file)){
                $result = File::create([
                    'path' => $fullPath,
                    'entity' => $entity,
                    'entity_id' => $entity_id,
                ]);
            }



            return $result;



        } catch (\Exception $error) {
            dump($error);
        }
    }

    public static function geoSlug($code) {
        $entity = GeoList::where('value',$code)->first();
        return $entity->slug;
    }
    public static function isGeoIsset($slug){
        return GeoList::where('slug',$slug)->first() ? true : false;
    }
    public function getGeoIdArray(){
        $point = GeoList::where('slug',request()->session()->get('country'))->first();
        if($point->is == 'city'){
            return  [$point->value];
        } elseif ($point->is == 'region'){
            return [$point->value,];
        } elseif ($point->is == 'federal') {
            return [$point->value];
        } elseif ($point->is == 'country') {
            return [$point->value];
        }
    }

    public static function formatPrice($price){
        if(mb_strtoupper($price) === mb_strtoupper('договорная')){
            return $price;
        } elseif (strlen($price) > 0) {
            $v = preg_replace("/[^0-9]/", '', $price);
            $n = number_format((int)$v, 0, ' ',' ');
            return $n. ' руб';
        } else {
            return '';
        }
    }
}
