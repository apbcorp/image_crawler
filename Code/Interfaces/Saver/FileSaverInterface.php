<?php

namespace Interfaces\Saver;

/**
 * Interface FileSaverInterface
 * @package Interfaces\Saver
 */
interface FileSaverInterface extends SaverInterface
{
    /**
     * FileSaverInterface constructor.
     * @param string $dirPath
     */
    public function __construct(string $dirPath);

    /**
     * @return string
     */
    public function getReportPath() : string;
}