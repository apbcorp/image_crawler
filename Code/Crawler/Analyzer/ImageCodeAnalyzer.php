<?php

namespace Crawler\Analyzer;

use Interfaces\Analyzer\ImageCodeAnalyzerInterface;

class ImageCodeAnalyzer implements ImageCodeAnalyzerInterface
{
    const IMG_PATTERN = '/<img /';

    /**
     * @var int
     */
    private $imageCount;

    /**
     * @param string $code
     */
    public function analyze(string $code)
    {
        if (preg_match_all(self::IMG_PATTERN, $code, $match)) {
            $this->imageCount = count($match[0]);
        }
    }

    /**
     * @return int
     */
    public function getImageCount() : int
    {
        return $this->imageCount;
    }

    /**
     *
     */
    public function clear()
    {
        $this->imageCount = 0;
    }
}