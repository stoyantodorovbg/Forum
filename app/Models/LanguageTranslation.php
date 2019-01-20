<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LanguageTranslation extends Model
{
    protected $fillable = [
        'language_id',
        'title',
        'short_title'
    ];

    public $timestamps = false;

    /**
     * The language for this translation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
