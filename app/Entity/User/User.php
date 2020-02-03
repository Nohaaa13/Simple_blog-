<?php

namespace App\Entity\User;

use App\Entity\CommentLikes;
use App\Entity\Comments;
use App\Entity\PostLikes;
use App\Entity\Posts;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class User
 * @package App\Entity
 * @property integer $id
 * @property string $email
 * @property string $name
 * @property integer $role_id
 * @property string $password
 * @property string $remember_token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */

class User extends Authenticatable
{
    use Notifiable;


    protected $fillable = [
        'email', 'password','name', 'role_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function posts()
    {
        return $this->hasMany(Posts::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class, 'user_id', 'id');
    }


    public function likes()
    {
        return $this->hasMany(PostLikes::class, 'user_id', 'id');
    }

    public function commentsLikes()
    {
        return $this->hasMany(CommentLikes::class, 'user_id', 'id');
    }



    /**
     * @return bool
     */
    public function canLogin()
    {
        return $this->isAdmin() || $this->isClient();
    }

    /**
     * @return int
     */
    protected function getRoleId()
    {
        return $this->role_id;
    }
    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->getRoleId() === Role::ADMIN;
    }

    /**
     * @return bool
     */
    public function isClient()
    {
        return $this->getRoleId() === Role::CLIENT;
    }

}
