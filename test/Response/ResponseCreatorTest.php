<?php

namespace TextParser\Test\Response;


use TextParser\Enum\Format;
use TextParser\Input\Request;
use TextParser\Enum\ResponseType;
use TextParser\Parser\FileModel;
use TextParser\Response\ResponseCreator;
use PHPUnit\Framework\TestCase;


class ResponseCreatorTest extends TestCase
{
    public function createResponseProvider(): array
    {
        $fileModel = new FileModel();
        $fileModel->setLetters(['l' => 2, 'c' => 1, 'q' => 1, 'v' => 1, 'n' => 2, 'y' => 7, 'm' => 1, 'x' => 2, 'i' => 1, 'a' => 2]);
        $fileModel->setSymbols(['<' => 1, '`' => 1, '=' => 3, '+' => 2, '^' => 1]);
        $fileModel->setPunctuationMarks(['\\' =>  1,',' =>  1, '}' =>  5,'@' =>  3,]);

        $filePath = 'test.txt';
        $request = new Request();
        $request->setFilePath($filePath);
        $request->setResponseTypes(
            [ResponseType::INCLUDE_LETTER(), ResponseType::INCLUDE_SYMBOL(), ResponseType::INCLUDE_PUNCTUATION()]
        );

        $mostRepeatingRequest = clone $request;
        $mostRepeatingRequest->setFormat(Format::MOST_REPEATING());

        $mostRepeatingResponse = 'File test.txt' . PHP_EOL .
            'First most repeating letter: y' . PHP_EOL .
            'First most repeating symbol: =' . PHP_EOL .
            'First most repeating punctuation: }' . PHP_EOL
        ;


        $nonRepeatingRequest = clone $request;
        $nonRepeatingRequest->setFormat(Format::NON_REPEATING());

        $nonRepeatingResponse = 'File test.txt' . PHP_EOL .
            'First non-repeating letter: c' . PHP_EOL .
            'First non-repeating symbol: <' . PHP_EOL .
            'First non-repeating punctuation: \\' . PHP_EOL
        ;


        $leastRepeatingRequest = clone $request;
        $leastRepeatingRequest->setFormat(Format::LEAST_REPEATING());

        $leastRepeatingResponse = 'File test.txt' . PHP_EOL .
            'First least repeating letter: l' . PHP_EOL .
            'First least repeating symbol: +' . PHP_EOL .
            'First least repeating punctuation: @' . PHP_EOL
        ;

        return [
            'most_repeating' => [$mostRepeatingRequest, $fileModel, $mostRepeatingResponse],
            'least_repeating' => [$leastRepeatingRequest, $fileModel, $leastRepeatingResponse],
            'non_repeating' => [$nonRepeatingRequest, $fileModel, $nonRepeatingResponse],
        ];
    }

    /**
     * @test
     * @dataProvider createResponseProvider
     */
    public function createResponse(Request $request, FileModel $fileModel, string $expectedResponse)
    {
        $responseCreator = new ResponseCreator();

        $response = $responseCreator->createResponse($request, $fileModel);

        self::assertEquals($expectedResponse, $response);
    }
}
