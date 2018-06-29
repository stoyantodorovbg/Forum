<?php


namespace App\Traits;


use App\Models\Activity;

trait RecordActivity
{
    protected static function bootRecordActivity()
    {
        if (auth()->guest()) return;

        foreach (static::getActivitiesRecord() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity($event);
            });
        }
    }

    protected static function getActivitiesRecord()
    {
        return ['created'];
    }

    public function activity()
    {
        return $this->morphMany('App\Models\Activity', 'subject');
    }

    protected function recordActivity($event)
    {
        $this->activity()->create([
            'user_id'      => auth()->id(),
            'type'         => $this->getActivityType($event),
        ]);
    }

    protected function getActivityType($event)
    {
        $type = strtolower((new \ReflectionClass($this))->getShortName());

        return $event . '_' . $type;
    }
}