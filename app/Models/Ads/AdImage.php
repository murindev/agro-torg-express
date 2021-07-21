<?php

namespace App\Models\Ads;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Ads\AdImage
 *
 * @property int $id
 * @property int $ad_id
 * @property string $path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AdImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdImage whereAdId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdImage wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdImage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AdImage extends Model
{
    protected $table = 'ads_images';
}
