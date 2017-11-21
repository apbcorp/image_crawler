<?php

namespace Interfaces\Formatter;

/**
 * Interface FormatterInterface
 * @package Interfaces\Formatter
 */
interface FormatterInterface
{
    /**
     * @param array $imgCount
     * @param array $processingTime
     * @return array
     */
    public function format(array $imgCount, array $processingTime) : array;
}