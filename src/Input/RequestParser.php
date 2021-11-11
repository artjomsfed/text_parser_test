<?php
declare(strict_types=1);


namespace TextParser\Input;


use TextParser\Input\Retriever\FilePathRetriever;
use TextParser\Input\Retriever\FormatRetriever;
use TextParser\Input\Retriever\ResponseTypeRetriever;


class RequestParser
{
    private $tokenizer;
    private $filePathRetriever;
    private $formatRetriever;
    private $responseTypeRetriever;

    public function __construct(
        RequestTokenizer $tokenizer,
        FilePathRetriever $filePathRetriever,
        FormatRetriever $formatRetriever,
        ResponseTypeRetriever $responseTypeRetriever
    )
    {
        $this->tokenizer = $tokenizer;
        $this->filePathRetriever = $filePathRetriever;
        $this->formatRetriever = $formatRetriever;
        $this->responseTypeRetriever = $responseTypeRetriever;
    }

    public function createRequest(array $input): Request
    {
        $tokens = $this->tokenizer->tokenize($input);

        $request = new Request();

        $filePath = $this->filePathRetriever->getFilePath($tokens);
        $request->setFilePath($filePath);

        $format = $this->formatRetriever->getFormat($tokens);
        $request->setFormat($format);

        $responseTypes = $this->responseTypeRetriever->getResponseTypes($tokens);
        $request->setResponseTypes($responseTypes);

        return $request;
    }
}