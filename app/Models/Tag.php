<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tag
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\NewsPost> $newsPosts
 * @property-read int|null $news_posts_count
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag query()
 * @mixin \Eloquent
 */
class Tag extends Model
{
    use HasFactory;

    protected $table = 'tag';

    public const UPDATED_AT = null;

    protected $fillable = [
        'name',
    ];

    public function newsPosts()
    {
        return $this->belongsToMany(NewsPost::class, 'news_post_tag', 'tag_id', 'news_post_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_tag_subscribes', 'tag_id', 'user_id');
    }
}
