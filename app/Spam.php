<?php


namespace App;


class Spam
{
    /**
     * Find spam
     *
     * @param $body
     * @return bool
     */
    public function detect($body)
    {
        $this->detectInvalidKeywords($body);

        return false;
    }

    /**
     * Basic spam filter
     *
     * @param $body
     * @throws \Exception
     */
    protected function detectInvalidKeywords($body)
    {
        $invalidKeywords = [
            'yahoo customer support',
        ];

        foreach ($invalidKeywords as $keyword) {

            if(stripos($body, $keyword) !== false) {
                throw new \Exception('Your reply contains spam.');
            }
        }
    }

}