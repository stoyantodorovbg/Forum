<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'position',
        'link',
    ];

    /**
     * The menu for this menu item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    /**
     * The menu that is assigned to t the menu item
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function childMenu()
    {
        return $this->hasOne(Menu::class);
    }
}
