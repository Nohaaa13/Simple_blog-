<?php
namespace App\Entity;


use App\Entity\User\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Comments
 * @package App\Entity
 * @property integer $id
 * @property string $body
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property integer $post_id
 * @property integer $user_id
 * @property integer $likes
 */

class Comments extends Model
{


    protected $fillable = [
        'id', 'body','user_id','post_id','likes'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function posts()
    {
        return $this->belongsTo(Posts::class, 'post_id', 'id');
    }

    public function commentLikes()
    {
        return $this->hasMany(CommentLikes::class, 'comment_id', 'id');
    }

}
