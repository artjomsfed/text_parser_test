<?php

use TextParser\Input\RequestParser;
use TextParser\Input\RequestTokenizer;
use TextParser\Input\Retriever\FilePathRetriever;
use TextParser\Input\Retriever\FormatRetriever;
use TextParser\Input\Retriever\ResponseTypeRetriever;
use TextParser\Parser\FileParser;
use TextParser\Response\ResponseCreator;

require_once __DIR__ . '/vendor/autoload.php';

$requestParser = new RequestParser(
    new RequestTokenizer(),
    new FilePathRetriever(),
    new FormatRetriever(),
    new ResponseTypeRetriever()
);

$fileParser = new FileParser();
$responseCreator = new ResponseCreator();

try {
    $request = $requestParser->createRequest($_SERVER['argv']);
    $fileModel = $fileParser->parse($request->getFilePath());

    echo $responseCreator->createResponse($request, $fileModel);
} catch (\Throwable $exception) {
    echo 'Program exited with error code: ' . $exception->getCode() . PHP_EOL;
}

exit;