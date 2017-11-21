<?php

namespace Interfaces\Parser;


interface ProcessingPageParserInterface
{
    /**
     * @return float
     */
    public function getProcessingTime() : float;
}