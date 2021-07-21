<?php

namespace App\Models\Geo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Geo\Federal
 *
 * @property int $id
 * @property string $slug
 * @property int $code
 * @property int $country_id
 * @property int $sort
 * @property string $name_ru
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Federal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Federal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Federal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Federal whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Federal whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Federal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Federal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Federal whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Federal whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Federal whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Federal whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $title_ru
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Geo\Region[] $regions
 * @property-read int|null $regions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Federal whereTitleRu($value)
 */
class Federal extends Model
{
    protected $table = 'geo_federals';
    public $guarded = [];
    public function regions(){
        return $this->hasMany(Region::class,'federal_id','code');
    }
}
