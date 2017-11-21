<?php

namespace Interfaces\Analyzer;

use Interfaces\ClearableInterface;

/**
 * Interface CodeAnalyzerInterface
 * @package Interfaces\Analyzer
 */
interface CodeAnalyzerInterface extends ClearableInterface
{
    /**
     * @param string $code
     */
    public function analyze(string $code);
}