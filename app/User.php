<?php

namespace App;

use Carbon\Carbon;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\Activity;
use App\Models\Auth\Role;
use App\Models\Auth\Permission;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar_path',
        'confirmation_token',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'confirmed' => 'boolean'
    ];

    protected $permissionsWithRights = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email'
    ];

    /**
     * Return slug instead id
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }

    /**
     * Threads, created by the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function threads()
    {
        return $this->hasMany(Thread::class)->latest();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|\Illuminate\Database\Query\Builder
     */
    public function lastReply()
    {
        return $this->hasOne(Reply::class)->latest();
    }

    /**
     * Activities, associated with the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activity()
    {
        return $this->hasMany(Activity::class);
    }

    /**
     * The roles that belong to the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    /**
     * The permissions that belong to the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return$this->belongsToMany(Permission::class, 'users_permissions');
    }

    /**
     * @param Thread $thread
     * @throws \Exception
     */
    public function readThread(Thread $thread)
    {
        cache()->forever(
            $this->visitedThreadCacheKey($thread),
            Carbon::now()
        );
    }

    /**
     * Return cache key that marks a visited thread
     *
     * @param Thread $thread
     * @return string
     */
    public function visitedThreadCacheKey(Thread $thread)
    {
        return sprintf("users.%s.visits.%s", $this->id, $thread->id);

    }

    /**
     * Get the user's avatar path
     *
     * @return mixed
     */
    public function avatar($avatar)
    {
        if (! $avatar) {
            return 'avatars/default.jpg';
        }

        return $avatar;
    }

    /**
     * When the user confirms his email address
     */
    public function confirm()
    {
        $this->confirmed = true;
        $this->confirmation_token = NULL;
        $this->save();
    }

    /**
     * Permanently check for admin rights
     *
     * @return bool
     */
    public function isAdmin()
    {
        return in_array($this->name, ['Admin']);
    }

    /**
     * Check if the user has e role
     *
     * @param $role
     * @return mixed
     */
    public function hasRole($role)
    {
        return $this->roles()->where('title', $role)->first();
    }

    /**
     * Check if the user has e permission
     * @param $permission
     * @return mixed
     */
    public function hasPermission($permission)
    {
        return $this->permission()->where('title', $permission)->first();
    }

    /**
     * Fetch the rights that have all user role permissions
     *
     * @return mixed
     */
    public function getUserRolePermissions()
    {
        $this->roles()
            ->with('permissions.rights')
            ->get()
            ->map(function ($role) {
                return $role->permissions
                    ->map(function ($permission) {
                    return $permission->rights
                        ->map(function ($right) use ($permission) {
                            $this->permissionsWithRights[$permission->title][] = $right->title;
                        });
                });
            });

        return $this->permissionsWithRights;
    }
}
