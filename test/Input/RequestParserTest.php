<?php
declare(strict_types=1);


namespace TextParser\Test\Input;


use TextParser\Input\Retriever\FilePathRetriever;
use TextParser\Enum\Format;
use TextParser\Input\Retriever\FormatRetriever;
use TextParser\Input\RequestTokenizer;
use TextParser\Enum\ResponseType;
use TextParser\Input\Retriever\ResponseTypeRetriever;
use TextParser\Input\RequestParser;
use PHPUnit\Framework\TestCase;


class RequestParserTest extends TestCase
{
    private static $requestParser;

    protected function setUp(): void
    {
        self::$requestParser = new RequestParser(
            new RequestTokenizer(),
            new FilePathRetriever(),
            new FormatRetriever(),
            new ResponseTypeRetriever()
        );
    }

    /** @test */
    public function createRequest(): void
    {
        $input = [
            0 => 'index.php',
            1 => '--input=test/test_files/file_path_test',
            2 => '-f',
            3 => 'non-repeating',
            4 => '-L',
            5 => '-P',
            6 => '-S',
        ];

        $request = self::$requestParser->createRequest($input);

        self::assertTrue(file_exists($request->getFilePath()));
        self::assertEquals(Format::NON_REPEATING(), $request->getFormat());
        self::assertEquals(
            [ResponseType::INCLUDE_LETTER(), ResponseType::INCLUDE_PUNCTUATION(), ResponseType::INCLUDE_SYMBOL()],
            $request->getResponseTypes()
        );
    }
}
