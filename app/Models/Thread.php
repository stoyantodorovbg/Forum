<?php

namespace App\Models;

use App\User;
use App\Redis\Visits;
use App\Traits\RecordActivity;
use App\Events\ThreadHasNewReply;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use RecordActivity;

    protected $guarded = [];

    protected $with = [
        'owner',
        'channel'
    ];

    protected $casts = [
        'locked' => 'boolean',
    ];

    protected static function boot ()
    {
        parent::boot();;

        static::deleting(function($thread){
            $thread->replies->each->delete();
        });

        static::created(function($thread){
            $thread->update(['slug' => $thread->title]);
        });
    }

    protected $appends = ['isSubscribedTo'];

    /**
     * Fetch a path to the current threat
     *
     * @return string
     */
    public function path()
    {
        return '/threads/'.$this->slug;
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
        $reply = $this->replies()->create($reply);

        //notify users for the replies of the other user for the subscribed thread
        event(new ThreadHasNewReply($this, $reply));

        return $reply;
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

    /**
     * add thread subscription
     *
     * @param null $userId
     */
    public function subscribe($userId = null)
    {
        $this->subscriptions()->create([
            'user_id' => $userId ?: auth()->id(),
        ]);
    }

    /**
     * remove thread subscription
     *
     * @param null $userId
     */
    public function unsubscribe($userId = null)
    {
        $this->subscriptions()
            ->where('user_id', $userId ?: auth()->id())
            ->delete();
    }

    /**
     * The thread subscriptions
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscriptions()
    {
        return $this->hasMany(ThreadSubscription::class);
    }

    /**
     * Show if the authenticated user is subscribed to this thread
     *
     * @return mixed
     */
    public function getIsSubscribedToAttribute()
    {
        return $this->subscriptions()
            ->where('user_id', auth()->id())
            ->exists();
    }

    /**
     * Check if the thread has unread from the user updates
     *
     * @param null $user
     * @return bool
     * @throws \Exception
     */
    public function hasUpdatesFor($user = null)
    {
        $user = $user ?: auth()->user();
        $key = $user->visitedThreadCacheKey($this);

        return $this->updated_at > cache($key);
    }

    /**
     * Get the number of the thread visits
     *
     * @return mixed
     */
    public function visits()
    {
        return new Visits($this);
    }

    /**
     * Lock the thread
     */
    public function lock()
    {
        $this->update(['locked' => true]);
    }

    /**
     * Unlock the thread
     */
    public function unlock()
    {
        $this->update(['locked' => false]);
    }

    /**
     * Set the best reply for the thread
     *
     * @param Reply $reply
     */
    public function markBestReply(Reply $reply)
    {
        $this->best_reply_id = $reply->id;
        $this->save();
    }

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @param $value
     */
    public function setSlugAttribute($value)
    {
        $slug = str_slug($value);

        $slug = $this->incrementSlug($slug);

        $this->attributes['slug'] = $slug;
    }

    /**
     * @param $slug
     * @return null|string|string[]
     */
    protected function incrementSlug($slug)
    {
        if (static::whereSlug($slug)->exists()) {
            $slug = "$slug-" . $this->id;
        }

        return $slug;
    }
}
