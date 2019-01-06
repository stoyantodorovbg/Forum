<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class Right extends Model
{
    /**
     * The permissions that belong to the right.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Permission::class);
    }
}
