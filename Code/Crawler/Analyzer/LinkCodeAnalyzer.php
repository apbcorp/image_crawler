<?php

namespace Crawler\Analyzer;

use Interfaces\Analyzer\LinkCodeAnalyzerInterface;

class LinkCodeAnalyzer implements LinkCodeAnalyzerInterface
{
    const LINK_PATTERN = '/<a href=\"(.*)\"/U';
    /**
     * @var string[]
     */
    private $links;

    /**
     * @param string $code
     */
    public function analyze(string $code)
    {
        if (preg_match_all(self::LINK_PATTERN, $code, $match)) {
            $this->links = $match[1];
        }
    }

    /**
     * @return array
     */
    public function getLinks() : array
    {
        return $this->links;
    }

    /**
     *
     */
    public function clear()
    {
        $this->links = [];
    }
}