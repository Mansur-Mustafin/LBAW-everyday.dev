<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagProposal extends Model
{
    use HasFactory;

    protected $table = 'tag_proposal';

    public const UPDATED_AT = null;
    public const CREATED_AT = null;

    protected $fillable = [
        'name',
        'description',
        'is_resolved',
        'proposer_id'
    ];

    public function proposer()
    {
        return $this->belongsTo(User::class,'proposer_id');
    }
}
