<?php

namespace Saver;

use Interfaces\Saver\FileSaverInterface;

class FileSaver implements FileSaverInterface
{
    const HEAD_TEMPLATE = '<html><head><title>Report</title></head><body><table border="1"><tr><td>URL</td><td>Image count</td><td>Parsing time</td></tr>';
    const ROW_TEMPLATE = '<tr><td>%s</td><td>%d</td><td>%s</td></tr>';
    const BACK_TEMPLATE = '</table></body></html>';

    /**
     * @var string
     */
    private $dirPath;

    /**
     * @var string
     */
    private $reportPath;

    /**
     * FileSaver constructor.
     * @param string $dirPath
     */
    public function __construct(string $dirPath)
    {
        $this->dirPath = $dirPath;
    }

    /**
     * @param array $data
     */
    public function save(array $data)
    {
        $this->reportPath = $this->dirPath . DIRECTORY_SEPARATOR . $this->generateFileName();

        $html = self::HEAD_TEMPLATE;

        foreach ($data as $row) {
            $html .= sprintf(self::ROW_TEMPLATE, $row['url'], $row['imgCount'], $row['time']);
        }

        $html .= self::BACK_TEMPLATE;

        file_put_contents($this->reportPath, $html);
    }

    /**
     * @return string
     */
    public function getReportPath() : string
    {
        return $this->reportPath;
    }

    /**
     * @return string
     */
    private function generateFileName() : string
    {
        return 'report_' . date('d.m.Y') . '.html';
    }
}