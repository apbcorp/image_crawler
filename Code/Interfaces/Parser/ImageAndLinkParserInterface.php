<?php

namespace Interfaces\Parser;

use Interfaces\Analyzer\ImageAnalyzerInterface;
use Interfaces\Analyzer\LinkAnalyzerInterface;

interface ImageAndLinkParserInterface
    extends ParserInterface, LinkAnalyzerInterface, ImageAnalyzerInterface, ProcessingPageParserInterface
{
    
}