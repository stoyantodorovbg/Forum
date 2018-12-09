<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'system_name',
        'default_content',
        'default_language_id',
    ];

    /**
     * If the label has a translation for a given language, return it
     *
     * @param $languageId
     * @return bool|\Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getTranslation($languageId)
    {
        if($translation = $this->translations()->where('language_id', $languageId)->first()) {
            return $translation->content;
        }

        return false;
    }

    /**
     * The translations of the label
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translations()
    {
        return $this->hasMany(Translation::class);
    }
}
