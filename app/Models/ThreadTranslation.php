<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThreadTranslation extends Model
{
    protected $fillable = [
        'thread_id',
        'language_id',
        'title',
        'body',
    ];

    public $timestamps = false;

    /**
     * The label for the translation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thread()
    {
        return $this->belongsTo(Thread::class);
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
