<?php

namespace App\Models\Geo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Geo\GeoList
 *
 * @property int $id
 * @property int $geo_id
 * @property int $geo_xml_id
 * @property string $is
 * @property int $cnt
 * @property string $country
 * @property string $federal
 * @property string $region
 * @property string $city
 * @property string $value
 * @property string $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|GeoList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GeoList newQuery()
 * @method static \Illuminate\Database\Query\Builder|GeoList onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|GeoList query()
 * @method static \Illuminate\Database\Eloquent\Builder|GeoList whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoList whereCnt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoList whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoList whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoList whereFederal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoList whereGeoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoList whereGeoXmlId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoList whereIs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoList whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoList whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoList whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoList whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|GeoList withTrashed()
 * @method static \Illuminate\Database\Query\Builder|GeoList withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $slug
 * @property string|null $geo_city
 * @method static \Illuminate\Database\Eloquent\Builder|GeoList whereGeoCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoList whereSlug($value)
 */
class GeoList extends Model
{
    use SoftDeletes;

    protected $table = 'geo_list';
    public $guarded = [];
}
