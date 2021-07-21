<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Users\UsersGender
 *
 * @property int $id
 * @property string $title_ru
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UsersGender newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UsersGender newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UsersGender query()
 * @method static \Illuminate\Database\Eloquent\Builder|UsersGender whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsersGender whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsersGender whereTitleRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsersGender whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UsersGender extends Model
{
    protected $table = 'users_genders';
}
