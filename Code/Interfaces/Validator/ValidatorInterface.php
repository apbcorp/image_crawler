<?php

namespace Interfaces\Validator;

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