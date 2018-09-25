<?php
declare (strict_types = 1);
namespace App\Model\Authentification;

use App\Lib\ModelTrait\UuidForKey;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use App\Model\Authentification\Role;

class User extends Authenticatable
{
    use UuidForKey, SoftDeletes, Notifiable;
    public $incrementing  = false;
    protected $table      = 'authentification.users';
    protected $connection = 'authentification';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts      = [
        'id'                     => 'string',
        'name'                   => 'string',
        'email'                  => 'string',
        'password'               => 'string',
        'active'                 => 'boolean',
        'remember_token'         => 'string',
        'created_at'             => 'datetime',
        'updated_at'             => 'datetime',
        'deleted_at'             => 'datetime',
    ];


    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'authentification.role_user')->withTimeStamps();
    }


    public static function resolveId()
    {
        return Auth::check() ? Auth::user()->getAuthIdentifier() : null;
    }

    public function hasRole(string $roleName): bool
    {
        $returned = false;
        foreach ($this->roles()->get() as $role) {
            if ($role->name == $roleName) {
                $returned = true;
            }
        }
        return $returned;
    }
}
