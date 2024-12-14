<?php

namespace App\Models;

use App\Enums\ImageTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        'username',
        'public_name',
        'password',
        'google_id',
        'email',
        'rank',
        'status',
        'reputation',
        'is_admin'
    ];

    protected $with = ['profileImage'];

    protected $hidden = ['password', 'remember_token'];

    public function profileImage()
    {
        return $this->hasOne(Image::class, 'user_id')
            ->where('image_type', ImageTypeEnum::PROFILE->value)
            ->withDefault(function ($image, $user) {
                $image->image_type = ImageTypeEnum::PROFILE->value;
                $image->path = null;
                $image->user_id = $user->id;
            });
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'author_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id');
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

    public function posts()
    {
        return $this->hasMany(NewsPost::class, 'author_id')->orderBy('created_at', 'desc');
    }

    public function bookmarkedPosts()
    {
        return $this->belongsToMany(NewsPost::class, 'bookmarks', 'user_id', 'news_post_id');
    }

    public function notificationSetting()
    {
        return $this->hasOne(NotificationSetting::class, 'user_id', 'id');
    }

    public function getTagNamesAttribute()
    {
        return $this->tags()->pluck('name')->toArray();
    }

    // TODO: para o que isso serve?
    public function isAdmin(): bool
    {
        return $this->is_admin == true;
    }

    public function hasUnseenNotifications(): bool
    {
        return $this->notifications()->where('is_viewed', false)->exists();
    }
}
