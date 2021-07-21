<?php

namespace App\Models\Ads;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Ads\AdCategories
 *
 * @property int $id
 * @property int $parent
 * @property int $code
 * @property string $title_ru
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AdCategories newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdCategories newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdCategories query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdCategories whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdCategories whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdCategories whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdCategories whereParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdCategories whereTitleRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdCategories whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AdCategories extends Model
{
    protected $table = 'ad_categories';

    public function children(){
        return $this->hasMany(AdCategories::class,'parent','code');
    }

    public function cnt(){
        return $this->hasMany(Ad::class,'category','id');
    }
}
