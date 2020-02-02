<?php
namespace App\Entity;


use App\Entity\User\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PostLikes
 * @package App\Entity
 * @property integer $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property integer $post_id
 * @property integer $user_id
 */

class PostLikes extends Model
{


    protected $fillable = [
        'id', 'post_id','user_id'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public function posts()
    {
        return $this->belongsTo(Posts::class, 'post_id', 'id');
    }
}
