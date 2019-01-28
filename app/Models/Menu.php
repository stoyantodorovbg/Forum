<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'menu_item_id',
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
     * The menu can be assigned to menu item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parentMenuItem()
    {
        return $this->belongsTo(MenuItem::class, 'menu_item_id');
    }
}
