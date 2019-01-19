<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class Right extends Model
{
    protected $fillable = [
        'title',
        'status',
    ];

    /**
     * The permissions that belong to the right.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permissions_rights');
    }
}
