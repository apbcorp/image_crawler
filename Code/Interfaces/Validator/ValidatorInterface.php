<?php

namespace Interfaces\Validator;

/**
 * Interface ValidatorInterface
 * Validator interface, implements validation method and method for get errors
 * @package Interfaces\Validator
 */
interface ValidatorInterface
{
    /**
     * @param mixed $value
     * @return bool
     */
    public function validate($value) : bool;

    /**
     * @return array
     */
    public function getErrors() : array;
}