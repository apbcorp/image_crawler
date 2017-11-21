<?php

namespace Interfaces\Formatter;

/**
 * Interface LinksFormatterInterface
 * @package Interfaces\Formatter
 */
interface LinksFormatterInterface
{
    /**
     * @param string $domain
     */
    public function setDomain(string $domain);

    /**
     * @param string $url
     */
    public function setCurrentPageUrl(string $url);

    /**
     * @param array $data
     * @return array
     */
    public function format(array $data) : array;
}