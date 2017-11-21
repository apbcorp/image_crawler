<?php

require_once __DIR__.'/vendor/autoload.php';

use Factory\ObjectFactory;

if (!isset($argv[1])) {
    echo 'ERROR: parse url is empty';

    return;
}

$factory = new ObjectFactory();

$crawler = $factory->createCrawler();

try {
    $result = $crawler->parse($argv[1]);
} catch (Exception $e) {
    echo 'ERROR: ' . $e->getMessage();
}

$saver = $factory->createSaver();
$saver->save($result);

echo 'Parsing finish. Save to file ' . $saver->getReportPath();