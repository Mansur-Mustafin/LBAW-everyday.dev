<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'report';

    public const UPDATED_AT = null;
    public const CREATED_AT = null;

    protected $fillable = [
        'created_at',
        'description',
        'report_type',
        'reporter_id',
        'news_post_id',
        'comment_id',
        'reported_user_id',
    ]; 
}
