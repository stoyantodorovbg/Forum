<?php

namespace App\Models;

use App\Traits\RecordActivity;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use RecordActivity;

    /**
     * Don't auto apply mass assignment protection
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Fetch the associated subject for the activity
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function favorite()
    {
        return $this->morphTo();
    }
}
