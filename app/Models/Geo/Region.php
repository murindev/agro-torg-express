<?php

namespace App\Models\Geo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Geo\Region
 *
 * @property int $id
 * @property string $slug
 * @property string $code
 * @property string $sort
 * @property string $country_id
 * @property string $federal_id
 * @property string $name_ru
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Region newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Region newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Region query()
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereFederalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $title_ru
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Geo\City[] $cities
 * @property-read int|null $cities_count
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereTitleRu($value)
 */
class Region extends Model
{
    protected $table = 'geo_regions';
    public $guarded = [];

    public function cities(){
        return $this->hasMany(City::class,'region_id','code');
    }
}
