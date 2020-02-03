<?php
namespace App\Entity;


use App\Entity\User\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CommentLikes
 * @package App\Entity
 * @property integer $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property integer $comment_id
 * @property integer $user_id
 * @property bool $like
 */

class CommentLikes extends Model
{


    protected $fillable = [
        'id', 'comment_id','user_id','like'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public function comments()
    {
        return $this->belongsTo(Comments::class, 'comment_id', 'id');
    }
}
