<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\Image
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image query()
 * @mixin \Eloquent
 */
class Image extends Model
{
    use HasFactory;

    public $timestamps = false;
    const TYPE_PROFILE = 'Profile';
    const TYPE_POST_TITLE = 'PostTitle';
    const TYPE_POST_CONTENT = 'PostContent';

    const DEFAULT_IMAGES = [
        self::TYPE_PROFILE => 'profile/default-profile-image.jpg',
        self::TYPE_POST_TITLE => 'post/default-post-title-image.jpg',
        self::TYPE_POST_CONTENT => 'post/default-post-content-image.jpg',
    ];

    protected $hidden = ['user_id', 'news_post_id', 'path'];

    protected $table = 'image';

    protected $appends = ['url'];

    protected $fillable = [
        'path',
        'image_type',
        'news_post_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function newsPost()
    {
        return $this->belongsTo(NewsPost::class, 'news_post_id');
    }

    public function getUrlAttribute()
    {
        if ($this->path && Storage::disk('public_uploads')->exists($this->path)) {
            return asset($this->path);
        } 
        
        return asset(self::DEFAULT_IMAGES[$this->image_type]);
    }
}
