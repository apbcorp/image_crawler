<?php

namespace Interfaces\Parser;

use Interfaces\ClearableInterface;

/**
 * Interface ParserInterface
 * @package Interfaces\Parser
 */
interface ParserInterface extends ClearableInterface
{
    /**
     * @param string $url
     */
    public function parseUrl(string $url);
}