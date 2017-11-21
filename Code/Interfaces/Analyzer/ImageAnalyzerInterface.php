<?php

namespace Interfaces\Analyzer;

/**
 * Interface ImageAnalyzerInterface
 * @package Interfaces\Analyzer
 */
interface ImageAnalyzerInterface
{
    /**
     * @return int
     */
    public function getImageCount() : int;
}