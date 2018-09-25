<?php
declare (strict_types = 1);
namespace App\Model\Authentification;

use Illuminate\Database\Eloquent\Model;
use App\Lib\ModelTrait\UuidForKey;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Lib\ModelTrait\CreatedByAndModifiedBy;
use App\Lib\ModelTrait\StartDateAndEndDateAccessorAndMutator;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use App\Model\Authentification\User;

class Role extends Model
{
    use UuidForKey, SoftDeletes, StartDateAndEndDateAccessorAndMutator, CreatedByAndModifiedBy;

    protected $table      = 'authentification.roles';
    protected $connection = 'authentification';
    protected $fillable   = ['name', 'title'];
    protected $guarded    = ['id', 'created_at', 'updated_at', 'deleted_at'];
    protected $casts      = [
        'id'          => 'string',
        'code'        => 'string',
        'name'        => 'string',
        'created_by'  => 'string',
        'modified_by' => 'string',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
        'deleted_at'  => 'datetime',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'authentification.role_user')->withTimeStamps();
    }
}
