<?php
namespace App\Entity;


use App\Entity\User\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class Posts
 * @package App\Entity
 * @property integer $id
 * @property string $title
 * @property string $body
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property integer $user_id
 * @property integer $likes
 */

class Posts extends Model
{


    protected $fillable = [
        'id', 'title','body','user_id','likes'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class, 'post_id', 'id');
    }

    public function postLikes()
    {
        return $this->hasMany(PostLikes::class, 'post_id', 'id');
    }


    public function scopeByAuthor(Builder $query, string $author)

    {

        $userIds = User::where('name', 'like', "%$author%" )->pluck('id')->toArray();



        return $query->whereIn('user_id', $userIds);

    }

    public function isCreatedByActiveUser( int $id)

    {
        $user = Auth::user()->id;
      if( Posts::where('id', '=', $id)->get()->first()->user_id == $user)
          return true;
        else
            return false;

    }
}
