<?php

namespace App;

use App\Models\Reply;
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
            return 'avatars/default.jpeg';
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
}
