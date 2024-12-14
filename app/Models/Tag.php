<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tag';

    public const UPDATED_AT = null;
    public const CREATED_AT = null;

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
