<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use App\Traits\Favoritable;
use App\Traits\RecordActivity;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Favoritable, RecordActivity;

    protected $guarded = [];

    protected $with = [
        'owner',
        'favorites',
        ];

    protected $appends = [
        'favoritesCount',
        'isFavorited',
        'isBest',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($reply) {
            $reply->thread->increment('replies_count');
        });

        static::deleted(function ($reply) {
            $reply->thread->decrement('replies_count');
        });
    }

    /**
     * Fetch a path to the related threat
     *
     * @return string
     */
    public function path()
    {
        return $this->thread->path() . "#reply-{$this->id}";
    }

    /**
     * The owner of the reply
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * For witch thread is the reply
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    /**
     * @return mixed
     */
    public function wasJustPublished()
    {
        return $this->created_at->gt(Carbon::now()->subMinute());
    }

    /**
     * Find the user names in the reply body
     *
     * @return mixed
     */
    public function mentionedUsers()
    {
        preg_match_all('/\@([^\s\.\,\!\?\:\;\<]+)/', $this->body, $matches);

        return $matches[1];
    }

    /**
     * Add link to to mentioned user's name that leads to the user's profile
     *
     * @param $body
     */
    public function setBodyAttribute($body)
    {
        $this->attributes['body'] = preg_replace(
            '/@([^\s\.\,\!\?\:\;]+)/',
            '<a href="/profiles/$1">$0</a>',
            $body);
    }

    /**
     * Check if the reply is marked as best for the thread
     *
     * @return bool
     */
    public function isBest()
    {
        return $this->thread->best_reply_id == $this->id;
    }

    /**
     * Show if the reply is best for the thread
     *
     * @return mixed
     */
    public function getIsBestAttribute()
    {
        return $this->isBest();
    }

    /**
     * @param $body
     * @return array|string
     */
    public function getBodyAttribute($body)
    {
        return Purify::clean($body);
    }
}
