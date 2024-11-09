<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    
    protected $table = 'tag';

    protected $fillable = [
        'name',
    ];

    // Define inverse relationship
    public function newsPosts()
    {
        return $this->belongsToMany(NewsPost::class, 'news_post_tag', 'tag_id', 'news_post_id');
    }
}
