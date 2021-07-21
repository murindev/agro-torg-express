<?php


namespace App\Models\Geo;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Geo\GeoIP
 *
 * @property int $ID
 * @property int|null $UF_ACTIVE
 * @property string $UF_BLOCK_BEGIN
 * @property string|null $UF_BLOCK_END
 * @property string|null $UF_BLOCK_ADDR
 * @property string|null $UF_COUNTRY_CODE
 * @property string|null $UF_CITY_ID
 * @method static \Illuminate\Database\Eloquent\Builder|GeoIP newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GeoIP newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GeoIP query()
 * @method static \Illuminate\Database\Eloquent\Builder|GeoIP whereID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoIP whereUFACTIVE($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoIP whereUFBLOCKADDR($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoIP whereUFBLOCKBEGIN($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoIP whereUFBLOCKEND($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoIP whereUFCITYID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeoIP whereUFCOUNTRYCODE($value)
 * @mixin \Eloquent
 */
class GeoIP extends Model
{
    protected $table = 'geobase_codeip';

    public function city(){
        return $this->hasOne(GeoCity::class, 'UF_XML_ID','UF_CITY_ID');
    }

}
