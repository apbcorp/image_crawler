<?php

namespace Interfaces\Saver;

interface SaverInterface
{
    /**
     * @param array $data
     */
    public function save(array $data);
}