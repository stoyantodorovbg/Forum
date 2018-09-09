<?php


namespace App\Inspections;


class InvalidKeyword
{
    protected $invalidKeywords = [
        'yahoo customer support',
    ];

    /**
     * Basic spam filter
     *
     * @param $body
     * @throws \Exception
     */
    public function detect($body)
    {
        foreach ($this->invalidKeywords as $keyword) {

            if(stripos($body, $keyword) !== false) {
                throw new \Exception('Your reply contains spam.');
            }
        }
    }
}