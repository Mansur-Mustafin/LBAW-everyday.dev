<?php

namespace App\Models;

use App\Enums\NotificationTypeEnum;
use App\Enums\ImageTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    protected $with = ['author', 'tags', 'titleImage'];

    protected $fillable = [
        'title',
        'content',
        'author_id',
        'for_followers',
        'upvotes',
        'downvotes',
        'is_omitted'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'changed_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::created(function ($newsPost) {
            $followers = $newsPost->author->followers()->pluck('id');

            // TODO: use Notification::insert or make as a job.
            foreach ($followers as $followerId) {
                Notification::create([
                    'notification_type' => NotificationTypeEnum::POST,
                    'user_id' => $followerId,
                    'news_post_id' => $newsPost->id,
                ]);
            }
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'news_post_tag', 'news_post_id', 'tag_id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'news_post_id');
    }

    // public function notifications()
    // {
    //     return $this->hasMany(Notification::class, 'news_post_id');
    // }

    public function titleImage()
    {
        return $this->hasOne(Image::class, 'news_post_id')
            ->where('image_type', ImageTypeEnum::POST_TITLE->value)
            ->withDefault(function ($image, $newsPost) {
                $image->image_type = ImageTypeEnum::POST_TITLE->value;
                $image->path = null;
                $image->news_post_id = $newsPost->id;
            });
    }

    public function contentImages()
    {
        return $this->hasMany(Image::class, 'news_post_id')
            ->where('image_type', ImageTypeEnum::POST_CONTENT->value);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getTagNamesAttribute()
    {
        return $this->tags()->pluck('name')->toArray();
    }
}
