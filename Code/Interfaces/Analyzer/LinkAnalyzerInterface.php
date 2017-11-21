<?php

namespace Interfaces\Analyzer;

/**
 * Interface LinkAnalyzerInterface
 * @package Interfaces\Analyzer
 */
interface LinkAnalyzerInterface
{
    /**
     * @return array
     */
    public function getLinks() : array;
}