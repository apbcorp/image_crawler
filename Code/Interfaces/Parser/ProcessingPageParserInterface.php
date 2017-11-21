<?php

namespace Interfaces\Parser;

/**
 * Interface ProcessingPageParserInterface
 * @package Interfaces\Parser
 */
interface ProcessingPageParserInterface
{
    /**
     * @return float
     */
    public function getProcessingTime() : float;
}