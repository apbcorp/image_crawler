<?php

namespace Validator;

use Crawler\Helper\UrlHelper;
use Interfaces\Parser\PageParserInterface;
use Interfaces\Validator\ValidatorInterface;

/**
 * Class UrlValidator
 * Validator, validate URL, using regex and curl request to page
 * @package Validator
 */
class UrlValidator implements ValidatorInterface
{
    /**
     * @var PageParserInterface
     */
    private $parser;

    /**
     * @var string[]
     */
    private $errors;

    /**
     * UrlValidator constructor.
     * @param PageParserInterface $parser
     */
    public function __construct(PageParserInterface $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function validate($value) : bool
    {
        $this->errors = [];

        if (!UrlHelper::checkUrl($value)) {
            $this->errors[] = $value - ' is not valid URL';
            
            return false;
        }

        $this->parser->clear();
        $this->parser->parseUrl($value);

        if ($this->parser->getResponseCode() != UrlHelper::HTTP_CODE_OK) {
            $this->errors[] = sprintf('Page %s not found, return code %d', $value, $this->parser->getResponseCode());

            return false;
        }

        return true;
    }

    /**
     * @return array
     */
    public function getErrors() : array
    {
        return $this->errors;
    }
}