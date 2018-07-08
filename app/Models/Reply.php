<?php

namespace App\Models;

use App\User;
use App\Traits\Favoritable;
use App\Traits\RecordActivity;
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
    ];

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
}
