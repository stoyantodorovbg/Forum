<?php

namespace App;

use Carbon\Carbon;
use App\Models\Thread;
use App\Models\Activity;
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
        'name', 'email', 'password',
    ];

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
     * Activities, associated with the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activity()
    {
        return $this->hasMany(Activity::class);
    }

    /**
     * Write the cache key
     *
     * @param Thread $thread
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

}
