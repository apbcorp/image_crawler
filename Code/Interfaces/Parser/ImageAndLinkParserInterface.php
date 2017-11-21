<?php

namespace Interfaces\Parser;

use Interfaces\Analyzer\ImageAnalyzerInterface;
use Interfaces\Analyzer\LinkAnalyzerInterface;

/**
 * Interface ImageAndLinkParserInterface
 * Interface for facade
 * @package Interfaces\Parser
 */
interface ImageAndLinkParserInterface
    extends ParserInterface, LinkAnalyzerInterface, ImageAnalyzerInterface, ProcessingPageParserInterface
{
    
}