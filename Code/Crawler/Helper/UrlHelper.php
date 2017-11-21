<?php

namespace Crawler\Helper;

class UrlHelper
{
    const URL_PATTERN = '/(https?:\/\/.*)(\/|$)/U';
    const PARENT_DIR_PATTERN = '/\.\.\//';

    const HTTP_CODE_OK = 200;

    /**
     * @param string $url
     * @return bool
     */
    public static function checkUrl(string $url) : bool
    {
        return preg_match(self::URL_PATTERN, $url);
    }

    /**
     * @param string $url
     * @return string
     * @throws \Exception
     */
    public static function getDomain(string $url) : string
    {
        if (!preg_match(self::URL_PATTERN, $url, $match)) {
            throw new \Exception('Not valid URL.');
        }

        return $match[1];
    }

    /**
     * @param string $link
     * @param string $domain
     * @return string
     */
    public static function checkDomain(string $link, string $domain) : string
    {
        return strpos($link, $domain) !== false;
    }

    /**
     * @param string $link
     * @param string $domain
     * @param string $currentUrl
     * @return string
     */
    public static function createFullLink(string $link, string $domain, string $currentUrl) : string
    {
        if (!$link) {
            return $link;
        }

        if (self::checkUrl($link)) {
            return $link;
        }

        switch ($link[0]) {
            case '/':
                return $domain . $link;
            default:
                if ($domain == $currentUrl) {
                    return $domain . $link;
                }

                $parts = explode('/', $currentUrl);
                unset($parts[count($parts) - 1]);

                return implode('/', $parts) . '/' . $link;
        }
    }
}