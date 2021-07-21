<?php


namespace App\Models\Geo;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Geo\Cities
 *
 * @property int $ID
 * @property int|null $UF_XML_ID
 * @property int|null $UF_ACTIVE
 * @property string|null $UF_NAME
 * @property string|null $UF_REGION_NAME
 * @property string|null $UF_COUNTY_NAME
 * @property string|null $UF_BREADTH_CITY
 * @property string|null $UF_LONGITUDE_CITY
 * @property string|null $UF_STATE
 * @property string|null $UF_REGION_SHORT
 * @property int|null $UF_CAPITAL
 * @property int|null $UF_CAPITAL_SORT
 * @property int|null $UF_REGION_SORT
 * @method static \Illuminate\Database\Eloquent\Builder|GeoCity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GeoCity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GeoCity query()
 * @method static \Illuminate\Database\Eloquent\Builder|GeoCity whereID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoCity whereUFACTIVE($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoCity whereUFBREADTHCITY($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoCity whereUFCAPITAL($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoCity whereUFCAPITALSORT($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoCity whereUFCOUNTYNAME($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoCity whereUFLONGITUDECITY($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoCity whereUFNAME($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoCity whereUFREGIONNAME($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoCity whereUFREGIONSHORT($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoCity whereUFREGIONSORT($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoCity whereUFSTATE($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoCity whereUFXMLID($value)
 * @mixin \Eloquent
 */
class GeoCity extends Model
{

    protected $table = 'geobase_cities';




}
