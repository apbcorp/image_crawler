<?php

namespace Factory;

use Crawler\Crawler;
use Crawler\Analyzer\ImageCodeAnalyzer;
use Crawler\Analyzer\LinkCodeAnalyzer;
use Crawler\Formatter\LinksFormatter;
use Crawler\Formatter\ResultFormatter;
use Crawler\Parser\PageParser;
use Crawler\Parser\PageParserFacade;
use Interfaces\Analyzer\ImageCodeAnalyzerInterface;
use Interfaces\Analyzer\LinkCodeAnalyzerInterface;
use Interfaces\Formatter\FormatterInterface;
use Interfaces\Formatter\LinksFormatterInterface;
use Interfaces\Parser\ImageAndLinkParserInterface;
use Interfaces\Parser\PageParserInterface;
use Interfaces\Saver\FileSaverInterface;
use Interfaces\Validator\ValidatorInterface;
use Saver\FileSaver;
use Validator\UrlValidator;

/**
 * Class ObjectFactory
 * Factory, implements create classes with its dependencies
 * @package Factory
 */
class ObjectFactory
{
    const CURL_WAIT = 100000;
    const REPORTS_PATH = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Reports';

    /**
     * @var PageParserInterface
     */
    private $pageParser;

    /**
     * @return Crawler
     */
    public function createCrawler() : Crawler
    {
        return new Crawler(
            $this->createUrlValidator(),
            $this->createPageParserFacade(),
            $this->createLinkFormatter(),
            $this->createResultFormatter()
        );
    }

    /**
     * @return ImageAndLinkParserInterface
     */
    public function createPageParserFacade() : ImageAndLinkParserInterface
    {
        return new PageParserFacade(
            $this->getPageParser(),
            $this->createImageCodeAnalyzer(),
            $this->createLinkCodeAnalyzer()
        );
    }

    /**
     * @return PageParserInterface
     */
    public function getPageParser() : PageParserInterface
    {
        if (!$this->pageParser) {
            $this->pageParser = new PageParser(self::CURL_WAIT);
        }

        return $this->pageParser;
    }

    /**
     * @return ImageCodeAnalyzerInterface
     */
    public function createImageCodeAnalyzer() : ImageCodeAnalyzerInterface
    {
        return new ImageCodeAnalyzer();
    }

    /**
     * @return LinkCodeAnalyzerInterface
     */
    public function createLinkCodeAnalyzer() : LinkCodeAnalyzerInterface
    {
        return new LinkCodeAnalyzer();
    }
    
    /**
     * @return ValidatorInterface
     */
    public function createUrlValidator() : ValidatorInterface
    {
        return new UrlValidator(
            $this->getPageParser()
        );
    }

    /**
     * @return FormatterInterface
     */
    public function createResultFormatter() : FormatterInterface
    {
        return new ResultFormatter();
    }

    /**
     * @return LinksFormatterInterface
     */
    public function createLinkFormatter() : LinksFormatterInterface
    {
        return new LinksFormatter();
    }

    /**
     * @return FileSaverInterface
     */
    public function createSaver() : FileSaverInterface
    {
        return new FileSaver(self::REPORTS_PATH);
    }
}