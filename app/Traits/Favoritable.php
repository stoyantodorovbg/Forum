<?php


namespace App\Traits;


trait Favoritable
{
    public function getFavoritesCount()
    {
        return $this->favorites->count();
    }

    /**
     * Votes for the reply
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function favorites()
    {
        return $this->morphMany(\App\Models\Favorite::class, 'favorite');
    }

    /**
     * Add a vote to the reply
     */
    public function favorite($userId)
    {
        $attributes = ['user_id' => $userId];

        if (!$this->favorites()->where($attributes)->exists()) {
            return $this->favorites()->create($attributes);
        }
    }

    /**
     * @return bool
     */
    public function isFavorited()
    {
        return !!$this
            ->favorites
            ->where('user_id', auth()->id())
            ->count();
    }
}