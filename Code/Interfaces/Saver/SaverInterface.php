<?php

namespace Interfaces\Saver;

/**
 * Interface SaverInterface
 * @package Interfaces\Saver
 */
interface SaverInterface
{
    /**
     * @param array $data
     */
    public function save(array $data);
}