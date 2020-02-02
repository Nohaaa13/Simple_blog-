<?php
namespace App\Entity\User;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * @package App\Entity
 * @property integer $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */

class Role extends Model
{

    public const ADMIN = 1;
    public const CLIENT = 2;

    protected $fillable = [
        'id', 'name',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }

}
