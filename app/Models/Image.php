<?php

namespace App\Models;

use App\Enums\ImageTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $hidden = ['user_id', 'news_post_id', 'path'];

    protected $table = 'image';

    protected $appends = ['url'];

    protected $fillable = [
        'path',
        'image_type',
        'news_post_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function newsPost()
    {
        return $this->belongsTo(NewsPost::class, 'news_post_id');
    }

    public function getUrlAttribute()
    {
        if ($this->path && Storage::disk('public_uploads')->exists($this->path)) {
            return asset($this->path);
        }


        $type = match ($this->image_type) {
            'Profile' => ImageTypeEnum::PROFILE,
            'PostTitle' => ImageTypeEnum::POST_TITLE,
            'PostContent' => ImageTypeEnum::POST_CONTENT,
        };

        return asset($type->label());
    }
}
