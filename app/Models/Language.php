<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'title',
        'short_title',
        'status',
    ];

    /**
     * The translations for the language
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translation()
    {
        return $this->hasMany(LanguageTranslation::class);
    }
}
