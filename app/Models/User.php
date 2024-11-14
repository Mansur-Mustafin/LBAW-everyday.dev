<?php

namespace App\Models;

use App\Http\Controllers\FileController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\User
 *
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'user';

    public const UPDATED_AT = null;

    protected $fillable = [
        'username', 'public_name', 'password', 'email', 'rank', 'status', 'reputation', 'is_admin'
    ];

    public function getProfileImage() {
        return FileController::get('profile', $this->id);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'author_id');
    }
}
