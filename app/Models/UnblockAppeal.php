<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnblockAppeal extends Model
{
    use HasFactory;

    protected $table = 'unblock_appeal';

    public const UPDATED_AT = null;
    public const CREATED_AT = null;

    protected $fillable = [
        'name',
        'description',
        'is_resolved',
        'user_id'
    ];

    public function proposer()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
