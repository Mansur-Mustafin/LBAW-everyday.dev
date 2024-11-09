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
        'title', 'content', 'author_id', 'for_followers', 'upvotes', 'downvotes', 'is_omitted'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // time_ago shows time in readable format
    public function getTimeAgoAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }
}
