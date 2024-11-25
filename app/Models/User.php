<?php

namespace App\Models;

use App\Http\Controllers\FileController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\User
 *
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'user';

    public const UPDATED_AT = null;

    protected $fillable = [
        'username', 'public_name', 'password', 'email', 'rank', 'status', 'reputation', 'is_admin'
    ];

    protected $hidden = ['password', 'remember_token'];

    public function getProfileImagePathAttribute() {
        return $this->profileImage ? $this->profileImage->getPath() : asset(Image::DEFAULT_IMAGES[Image::TYPE_PROFILE]);
    }

    public function profileImage() {
        return $this->hasOne(Image::class, 'user_id')
                    ->where('image_type', Image::TYPE_PROFILE);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'author_id');
    }

    public function followers()
    {
        return $this->belongsToMany(self::class, 'follows', 'followed_id', 'follower_id');
    }

    public function following()
    {
        return $this->belongsToMany(self::class, 'follows', 'follower_id', 'followed_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'user_tag_subscribes', 'user_id', 'tag_id');
    }

    public function getTagNamesAttribute()
    {
        return $this->tags()->pluck('name')->toArray();
    }

    public function isAdmin() : bool
    {
        return $this->is_admin == true;
    }
}
