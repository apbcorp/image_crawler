<?php

namespace Crawler\Parser;

use Crawler\Exception\RequestException;
use Crawler\Helper\UrlHelper;
use Interfaces\Parser\ImageAndLinkParserInterface;
use Interfaces\Analyzer\ImageCodeAnalyzerInterface;
use Interfaces\Analyzer\LinkCodeAnalyzerInterface;
use Interfaces\Parser\PageParserInterface;

class PageParserFacade implements ImageAndLinkParserInterface
{
    /**
     * @var PageParserInterface
     */
    private $parser;

    /**
     * @var ImageCodeAnalyzerInterface
     */
    private $imageAnalyzer;

    /**
     * @var LinkCodeAnalyzerInterface
     */
    private $linkAnalyzer;

    /**
     * @var float
     */
    private $processingTime;

    /**
     * PageParserFacade constructor.
     * @param PageParserInterface $parser
     * @param ImageCodeAnalyzerInterface $imageAnalyzer
     * @param LinkCodeAnalyzerInterface $linkAnalyzer
     */
    public function __construct(PageParserInterface $parser, ImageCodeAnalyzerInterface $imageAnalyzer, LinkCodeAnalyzerInterface $linkAnalyzer)
    {
        $this->parser = $parser;
        $this->imageAnalyzer = $imageAnalyzer;
        $this->linkAnalyzer = $linkAnalyzer;
    }
    
    public function parseUrl(string $url)
    {
        $this->clear();

        $startTime = microtime(true);

        $this->parser->parseUrl($url);

        if ($this->parser->getResponseCode() != UrlHelper::HTTP_CODE_OK) {
            throw new RequestException(sprintf('Request to URL %s return http code %d', $url, $this->parser->getResponseCode()));
        }

        $html = $this->parser->getHtmlCode();
        $this->imageAnalyzer->analyze($html);
        $this->linkAnalyzer->analyze($html);

        $this->processingTime = round(microtime(true) - $startTime, 3);
    }

    /**
     * @return float
     */
    public function getProcessingTime() : float
    {
        return $this->processingTime;
    }

    /**
     * @return int
     */
    public function getImageCount() : int
    {
        return $this->imageAnalyzer->getImageCount();
    }

    /**
     * @return array
     */
    public function getLinks() : array
    {
        return $this->linkAnalyzer->getLinks();
    }

    /**
     *
     */
    public function clear()
    {
        $this->processingTime = 0;

        $this->parser->clear();
        $this->imageAnalyzer->clear();
        $this->linkAnalyzer->clear();
    }
}