<?php

namespace Interfaces\Parser;

use Interfaces\ClearableInterface;

interface ParserInterface extends ClearableInterface
{
    /**
     * @param string $url
     */
    public function parseUrl(string $url);
}