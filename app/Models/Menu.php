<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
    ];

    /**
     * The menu items for this menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }

    /**
     * The menu may be assigned to one menu item
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parentMenuItem()
    {
        return $this->hasOne(MenuItem::class);
    }
}
