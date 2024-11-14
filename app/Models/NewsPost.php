<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * App\Models\NewsPost
 *
 * @property-read \App\Models\User|null $author
 * @property-read mixed $tag_names
 * @property-read mixed $time_ago
 * @property-read mixed $title_image_path
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tag> $tags
 * @property-read int|null $tags_count
 * @property-read \App\Models\Image|null $titleImage
 * @method static \Illuminate\Database\Eloquent\Builder|NewsPost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsPost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsPost query()
 * @mixin \Eloquent
 */
class NewsPost extends Model
{
    use HasFactory;

    protected $table = 'news_post';

    public const UPDATED_AT = null;
    protected $fillable = [
        'title',
        'content',
        'author_id',
        'for_followers',
        'upvotes',
        'downvotes',
        'is_omitted'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'news_post_tag', 'news_post_id', 'tag_id');
    }

    public function getTagNamesAttribute()
    {
        return $this->tags()->pluck('name')->toArray();
    }

    public function titleImage()
    {
        return $this->hasOne(Image::class, 'news_post_id')
                    ->where('image_type', Image::TYPE_POST_TITLE);
    }

    public function getTitleImagePathAttribute()
    {
        return $this->titleImage->getPath();
    }

    // time_ago shows time in readable format
    public function getTimeAgoAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
