<?php
declare(strict_types=1);


namespace TextParser\Response;


use TextParser\Enum\Format;
use TextParser\Enum\ResponseType;
use TextParser\Parser\FileModel;
use TextParser\Input\Request;
use TextParser\Response\ResponseTypeHandler\LetterHandler;
use TextParser\Response\ResponseTypeHandler\PunctuationMarkHandler;
use TextParser\Response\ResponseTypeHandler\ResponseHandler;
use TextParser\Response\ResponseTypeHandler\SymbolHandler;
use TextParser\Response\ResultCollection\LeastRepeatingStrategy;
use TextParser\Response\ResultCollection\MostRepeatingStrategy;
use TextParser\Response\ResultCollection\NonRepeatingStrategy;
use TextParser\Response\ResultCollection\ResultCollectionStrategy;


class ResponseCreator
{
    public function createResponse(Request $request, FileModel $fileModel): string
    {
        $strategy = $this->getCollectionStrategy($request);
        $handlers = $this->getHandlers($request);

        $responseString = 'File ' . $request->getFilePath() . PHP_EOL;
        foreach ($handlers as $handler) {
            $handlerResponse = $handler->handle($fileModel, $strategy);
            $responseString .= $handlerResponse . PHP_EOL;
        }

        return $responseString;
    }

    private function getCollectionStrategy(Request $request): ResultCollectionStrategy
    {
        $a = $request->getFormat();

        $r = 0;
        $b = $a;

        return match ($request->getFormat()->getValue()) {
            Format::MOST_REPEATING()->getValue() => new MostRepeatingStrategy(),
            Format::LEAST_REPEATING()->getValue() => new LeastRepeatingStrategy(),
            Format::NON_REPEATING()->getValue() => new NonRepeatingStrategy(),
        };
    }

    /** @return ResponseHandler[] */
    private function getHandlers(Request $request): array
    {
        $handlers = [];
        foreach ($request->getResponseTypes() as $responseType) {
            $handlers[] = $this->createHandler($responseType);
        }

        return $handlers;
    }

    private function createHandler(ResponseType $responseType): ResponseHandler
    {
        return match ($responseType->getValue()) {
            ResponseType::INCLUDE_LETTER()->getValue() => new LetterHandler(),
            ResponseType::INCLUDE_SYMBOL()->getValue() => new SymbolHandler(),
            ResponseType::INCLUDE_PUNCTUATION()->getValue() => new PunctuationMarkHandler(),
        };
    }
}