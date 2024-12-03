<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $table = 'vote';

    public const UPDATED_AT = null;

    protected $fillable = [
        'user_id',
        'news_post_id',
        'comment_id',
        'is_upvote',
        'created_at',
        'vote_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function newsPost()
    {
        return $this->belongsTo(NewsPost::class, 'news_post_id');
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }

    // public function notification()
    // {
    //     return $this->hasOne(Notification::class, 'vote_id');
    // }
}
