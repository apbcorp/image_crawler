<?php

namespace Crawler\Formatter;

use Crawler\Helper\UrlHelper;
use Interfaces\Formatter\LinksFormatterInterface;

/**
 * Class LinksFormatter
 * Links formatter, use for get absolute links to pages and ignoring links to images, pdf files, etc
 * @package Crawler\Formatter
 */
class LinksFormatter implements LinksFormatterInterface
{

    const IGNORED_LINK_PATTERNS = [
        '/javascript\:\;/',
        '/mailto\:/',
        '/\.pdf/',
        '/\.jpg/',
    ];

    /**
     * @var string
     */
    private $domain;

    /**
     * @var string
     */
    private $currentUrl;

    /**
     * @param string $domain
     */
    public function setDomain(string $domain)
    {
        $this->domain = $domain;
    }

    /**
     * @param string $url
     */
    public function setCurrentPageUrl(string $url)
    {
        $this->currentUrl = $url;
    }

    /**
     * @param array $data
     * @return array
     */
    public function format(array $data) : array
    {
        $result = [];

        foreach ($data as $link) {
            $link = trim($link);

            if (!$link) {
                continue;
            }

            if (!$this->checkLinkByPatterns($link)) {
                continue;
            }

            $link = UrlHelper::createFullLink($link, $this->domain, $this->currentUrl);

            if (!UrlHelper::checkDomain($link, $this->domain)) {
                continue;
            }

            $result[$link] = $link;
        }

        return $result;
    }

    /**
     * @param string $link
     * @return bool
     */
    private function checkLinkByPatterns(string $link) : bool
    {
        foreach (self::IGNORED_LINK_PATTERNS as $pattern) {
            if (preg_match($pattern, $link)) {
                return false;
            }
        }

        return true;
    }
}