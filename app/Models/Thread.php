<?php

namespace App\Models;

use App\User;
use App\Traits\RecordActivity;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use RecordActivity;

    protected $guarded = [];

    protected $with = [
        'owner',
        'channel'
    ];

    protected static function boot ()
    {
        parent::boot();;

        static::deleting(function($thread){
            $thread->replies->each->delete();
        });
    }

    /**
     * Fetch a path to the current threat
     *
     * @return string
     */
    public function path()
    {
        return '/threads/'.$this->id;
    }

    /**
     * The replies of the thread
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(Reply::class)
            ->with('owner');
    }

    /**
     * The owner of the thread
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * The thread belongs to a channel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    /**
     * Add a reply to the thread
     *
     * @param array $reply
     * @return Model
     */
    public function addReply($reply)
    {
        return $this->replies()->create($reply);
    }

    /**
     * @param $query
     * @param $filters
     * @return mixed
     */
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
