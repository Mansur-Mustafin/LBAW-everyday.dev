<?php

namespace App\Models;

use App\Enums\NotificationTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comment';

    public const UPDATED_AT = null;

    protected $with = ['author'];

    protected $fillable = [
        'content',
        'is_omitted',
        'upvotes',
        'downvotes',
        'author_id',
        'news_post_id',
        'parent_comment_id'
    ];

    protected static function booted()
    {
        static::created(function ($comment) {
            if ($comment->news_post_id) {
                Notification::create([
                    'notification_type' => NotificationTypeEnum::COMMENT,
                    'user_id' => optional($comment->post)->author_id,
                    'comment_id' => $comment->id,
                ]);
            } else {
                Notification::create([
                    'notification_type' => NotificationTypeEnum::COMMENT,
                    'user_id' => optional($comment->parent)->author_id,
                    'comment_id' => $comment->id,
                ]);
            }
        });
    }

    public function post()
    {
        return $this->belongsTo(NewsPost::class, 'news_post_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_comment_id')->orderBy('created_at');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_comment_id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'comment_id');
    }

    // public function notification()
    // {
    //     return $this->hasOne(Notification::class, 'comment_id');
    // }
}
