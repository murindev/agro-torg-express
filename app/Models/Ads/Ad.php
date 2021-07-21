<?php

namespace App\Models\Ads;

use App\Models\File;
use App\Models\Geo\GeoList;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Ads\Ad
 *
 * @property int $id
 * @property string|null $link
 * @property int $adds_id
 * @property string|null $title
 * @property string|null $slug
 * @property string|null $category
 * @property string|null $type
 * @property string|null $region
 * @property string|null $datetime
 * @property string|null $comments_cnt
 * @property string|null $user_code
 * @property string|null $description
 * @property string|null $price
 * @property string|null $city
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $viewed
 * @property int|null $parsed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Ad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ad query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereAddsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereCommentsCnt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereParsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereUserCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereViewed($value)
 * @mixin \Eloquent
 * @property int $user_id
 * @property int $country_id
 * @property int|null $federal_id
 * @property string|null $region_id
 * @property int|null $geo_list_value
 * @property string|null $donor
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereDonor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereFederalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereGeoListValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ad whereUserId($value)
 */
class Ad extends Model
{
    protected $guarded = [];

    public function picture(){
        return $this->hasOne(File::class,'entity_id','id');
    }

    public function geo(){
        return $this->hasOne(GeoList::class,'value','geo_list_value');
    }

}
