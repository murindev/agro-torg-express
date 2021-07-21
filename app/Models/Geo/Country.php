<?php

namespace App\Models\Geo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Geo\Country
 *
 * @property int $id
 * @property string $slug
 * @property int $code
 * @property int $sort
 * @property string $name_ru
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country query()
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $country_code
 * @property string $title_ru
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Geo\Federal[] $federals
 * @property-read int|null $federals_count
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereTitleRu($value)
 */
class Country extends Model
{
    protected $table = 'geo_countries';
    public $guarded = [];

    public function federals(){
        return $this->hasMany(Federal::class,'country_id','code');
    }
}
