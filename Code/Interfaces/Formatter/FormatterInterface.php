<?php

namespace Interfaces\Formatter;

interface FormatterInterface
{
    /**
     * @param array $imgCount
     * @param array $processingTime
     * @return array
     */
    public function format(array $imgCount, array $processingTime) : array;
}