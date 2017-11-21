<?php

namespace Interfaces\Parser;

interface PageParserInterface extends ParserInterface
{
    /**
     * @return string
     */
    public function getHtmlCode() : string;

    /**
     * @return int
     */
    public function getResponseCode() : int;
}