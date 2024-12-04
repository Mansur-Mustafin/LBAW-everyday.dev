<?php

namespace App\Models;

use App\Events\SendNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notification';

    public const UPDATED_AT = null;

    protected $fillable = [
        'is_viewed',
        'created_at',
        'notification_type',
        'user_id',
        'news_post_id',
        'vote_id',
        'follower_id',
        'comment_id',
    ];

    protected $casts = [
        'is_viewed' => 'boolean',
        'created_at' => 'datetime',
    ];

    protected $with = ['newsPost', 'vote', 'follower', 'comment'];

    protected static function booted()
    {
        static::created(function (self $notification) {
            event(new SendNotification($notification));
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Isso precisa para contruir a mensagem de notificacao
    public function newsPost()
    {
        return $this->belongsTo(NewsPost::class, 'news_post_id')
            ->select('id', 'title', 'author_id')
            ->with('author');
    }

    public function vote()
    {
        return $this->belongsTo(Vote::class, 'vote_id')
            ->with('user');
    }

    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id')
            ->select('id', 'content', 'author_id')
            ->with('author');
    }
}
