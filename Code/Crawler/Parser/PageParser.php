<?php

namespace Crawler\Parser;

use Interfaces\Parser\PageParserInterface;

class PageParser implements PageParserInterface
{
    /**
     * @var string
     */
    private $html;

    /**
     * @var int
     */
    private $httpCode;

    /**
     * @var int
     */
    private $wait;

    /**
     * PageParser constructor.
     * @param int $wait
     */
    public function __construct(int $wait)
    {
        $this->wait = $wait;
    }

    /**
     * @param string $url
     */
    public function parseUrl(string $url)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url
        ));

        $this->html = curl_exec($curl);
        $header = curl_getinfo($curl);
        $this->httpCode = $header['http_code'];

        curl_close($curl);

        usleep($this->wait);
    }

    /**
     * @return string
     */
    public function getHtmlCode() : string
    {
        return $this->html;
    }

    /**
     *
     */
    public function clear()
    {
        $this->html = '';
        $this->httpCode = 0;
    }

    /**
     * @return int
     */
    public function getResponseCode() : int
    {
        return $this->httpCode;
    }
}