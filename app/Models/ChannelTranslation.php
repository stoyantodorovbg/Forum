<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChannelTranslation extends Model
{
    protected $fillable = [
        'channel_id',
        'language_id',
        'name',
    ];

    public $timestamps = false;

    /**
     * The label for the translation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    /**
     * The language for the translation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
