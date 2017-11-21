<?php

namespace Interfaces\Analyzer;

use Interfaces\ClearableInterface;

interface CodeAnalyzerInterface extends ClearableInterface
{
    /**
     * @param string $code
     */
    public function analyze(string $code);
}