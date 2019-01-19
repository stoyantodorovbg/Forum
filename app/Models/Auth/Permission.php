<?php

namespace App\Models\Auth;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'title',
        'description',
        'system_name',
        'status',
    ];

    /**
     * The roles that belong to the permission.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_permissions');
    }

    /**
     * The users that belongs to the permission
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_permissions');
    }

    /**
     * The rights that belong to the permission.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function rights()
    {
        return $this->belongsToMany(Right::class, 'permissions_rights');
    }
}
