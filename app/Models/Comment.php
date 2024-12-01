<?php

namespace App\Models;

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
}
