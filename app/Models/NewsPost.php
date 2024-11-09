<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class NewsPost extends Model
{
    use HasFactory;

    protected $table = 'news_post';

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
}
