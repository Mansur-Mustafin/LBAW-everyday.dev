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

    const TYPE_PROFILE = 'Profile';
    const TYPE_POST_TITLE = 'PostTitle';
    const TYPE_POST_CONTENT = 'PostContent';

    const DEFAULT_IMAGES = [
        self::TYPE_PROFILE => 'profile/default-profile-image.jpg',
        self::TYPE_POST_TITLE => 'post/default-post-title-image.jpg',
        self::TYPE_POST_CONTENT => 'post/default-post-content-image.jpg',
    ];

    protected $table = 'image';

    protected $fillable = [
        'path',
        'image_type',
        'news_post_id',
        'user_id',
    ];

    public function getPath()
    {
        if ($this->path && Storage::disk('public_uploads')->exists($this->path)) {
            return $this->path;
        } else {
            return self::DEFAULT_IMAGES[$this->image_type];
        }
    }
}
