<?php


namespace App\Traits;


trait Favoritable
{
    public function getFavoritesCountAttribute()
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
     * Add a vote to the model
     *
     * @param $userId
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function favorite($userId)
    {
        $attributes = ['user_id' => $userId];

        if (!$this->favorites()->where($attributes)->exists()) {
            return $this->favorites()->create($attributes);
        }
    }

    /**
     * Delete a vote for the model
     *
     * @param $userId
     */
    public function unfavorite($userId)
    {
        $attributes = ['user_id' => $userId];

        $this->favorites()->where($attributes)->delete();
    }

    /**
     * Determine if the current model has been favorited
     *
     * @return bool
     */
    public function isFavorited()
    {
        return !!$this
            ->favorites
            ->where('user_id', auth()->id())
            ->count();
    }

    /**
     * @return bool
     */
    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }
}