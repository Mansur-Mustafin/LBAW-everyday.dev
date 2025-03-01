<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationSetting extends Model
{
    use HasFactory;

    protected $table = 'notification_settings';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'follow_notifications',
        'vote_notifications',
        'post_notifications',
        'comment_notifications',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
