<?php

namespace Crawler\Formatter;

use Interfaces\Formatter\FormatterInterface;

class ResultFormatter implements FormatterInterface
{
    /**
     * @param array $imgCount
     * @param array $processingTime
     * @return array
     */
    public function format(array $imgCount, array $processingTime) : array
    {
        asort($imgCount);

        $result = [];
        foreach ($imgCount as $key => $value) {
            $result[] = [
                'url' => $key,
                'imgCount' => $value,
                'time' =>$processingTime[$key]
            ];
        }

        return $result;
    }
}