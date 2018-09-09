<?php


namespace App\Inspections;


class Spam
{
    protected $inspections = [
        InvalidKeyword::class,
        KeyHeldDown::class,
    ];

    /**
     * Find spam
     *
     * @param $body
     * @return bool
     */
    public function detect($body)
    {
        foreach ($this->inspections as $inspection) {
            app($inspection)->detect($body);
        }

        return false;
    }
}