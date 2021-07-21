<?php

namespace App\Models\Geo;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Geo\City
 *
 * @property int $id
 * @property string $slug
 * @property int $code
 * @property int $sort
 * @property int|null $geobase_id
 * @property int|null $geobase_xml_id
 * @property int|null $country_id
 * @property int|null $federal_id
 * @property int|null $region_id
 * @property string $name_ru
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City query()
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereFederalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereGeobaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereGeobaseXmlId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $title_ru
 * @method static \Illuminate\Database\Eloquent\Builder|City whereTitleRu($value)
 */
class City extends Model
{
    protected $table = 'geo_cities';
    public $guarded = [];


}
