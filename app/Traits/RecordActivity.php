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

        static::deleting(function ($model) {
            $model->activity()->delete();
        });
    }

    /**
     * @return array
     */
    protected static function getActivitiesRecord()
    {
        return ['created'];
    }

    /**
     * @return mixed
     */
    public function activity()
    {
        return $this->morphMany('App\Models\Activity', 'subject');
    }

    /**
     * @param $event
     */
    protected function recordActivity($event)
    {
        $this->activity()->create([
            'user_id'      => auth()->id(),
            'type'         => $this->getActivityType($event),
        ]);
    }

    /**
     * @param $event
     * @return string
     */
    protected function getActivityType($event)
    {
        $type = strtolower((new \ReflectionClass($this))->getShortName());

        return $event . '_' . $type;
    }
}