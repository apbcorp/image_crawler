<?php

namespace Crawler;

use Crawler\Exception\RequestException;
use Crawler\Helper\UrlHelper;
use Interfaces\Formatter\FormatterInterface;
use Interfaces\Formatter\LinksFormatterInterface;
use Interfaces\Parser\ImageAndLinkParserInterface;
use Interfaces\Validator\ValidatorInterface;

class Crawler
{
    /**
     * @var string[]
     */
    private $links;

    /**
     * @var int[]
     */
    private $imgCount;

    /**
     * @var float[]
     */
    private $parsingTime;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var ImageAndLinkParserInterface
     */
    private $parser;

    /**
     * @var FormatterInterface
     */
    private $formatter;

    /**
     * @var LinksFormatterInterface
     */
    private $linkFormatter;

    /**
     * Crawler constructor.
     * @param ValidatorInterface $domainValidator
     * @param ImageAndLinkParserInterface $parser
     * @param LinksFormatterInterface $linkFormatter
     * @param FormatterInterface $formatter
     */
    public function __construct(
        ValidatorInterface $domainValidator,
        ImageAndLinkParserInterface $parser,
        LinksFormatterInterface $linkFormatter,
        FormatterInterface $formatter
    ) {
        $this->validator = $domainValidator;
        $this->parser = $parser;
        $this->formatter = $formatter;
        $this->linkFormatter = $linkFormatter;
    }

    /**
     * @param string $url
     * @return array
     * @throws \Exception
     */
    public function parse(string $url) : array
    {
        $domain = UrlHelper::getDomain($url);

        if (!$this->validator->validate($domain)) {
            throw new \Exception(implode('; ', $this->validator->getErrors()));
        }

        $this->links = [$domain];
        $this->linkFormatter->setDomain($domain);

        $i = 0;
        while (isset($this->links[$i])) {
            $link = $this->links[$i];

            try {
                $this->parser->parseUrl($link);
            } catch (RequestException $e) {
                unset($this->links[$i]);

                continue;
            }

            $this->linkFormatter->setCurrentPageUrl($link);
            $formattedLinks = $this->linkFormatter->format($this->parser->getLinks());
            $this->addLinks($formattedLinks);
            $this->imgCount[$link] = $this->parser->getImageCount();
            $this->parsingTime[$link] = $this->parser->getProcessingTime();

            echo sprintf("Parse %d from %d links, found %d images...\r\n", $i, count($this->links), $this->imgCount[$link]);

            $i++;
        }
        
        return $this->formatter->format($this->imgCount, $this->parsingTime);
    }

    /**
     * @param array $links
     */
    private function addLinks(array $links)
    {
        foreach ($links as $link) {
            if (!in_array($link, $this->links)) {
                $this->links[] = $link;
            }
        }
    }
}