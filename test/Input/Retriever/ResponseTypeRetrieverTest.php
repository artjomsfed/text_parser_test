<?php
declare(strict_types=1);

namespace TextParser\Test\Input\Retriever;


use TextParser\Enum\ResponseType;
use TextParser\Input\Retriever\ResponseTypeRetriever;
use PHPUnit\Framework\TestCase;


class ResponseTypeRetrieverTest extends TestCase
{
    public function getResponseTypesProvider(): array
    {
        return [
            'short_single' => [['-L' => ''], [ResponseType::INCLUDE_LETTER()]],
            'short_multiple' => [['-L' => '', '-S' => ''], [ResponseType::INCLUDE_LETTER(), ResponseType::INCLUDE_SYMBOL()]],
            'long_single' => [['--include-punctuation' => ''], [ResponseType::INCLUDE_PUNCTUATION()]],
            'long_multiple' => [
                ['--include-punctuation' => '', '--include-symbol' => ''],
                [ResponseType::INCLUDE_PUNCTUATION(), ResponseType::INCLUDE_SYMBOL()],
            ],
            'mixed' => [
                ['-L' => '', '--include-symbol' => '', '-P' => ''],
                [ResponseType::INCLUDE_LETTER(), ResponseType::INCLUDE_PUNCTUATION(), ResponseType::INCLUDE_SYMBOL()],
            ],
        ];
    }

    /**
     * @test
     * @dataProvider getResponseTypesProvider
     */
    public function getResponseTypes(array $input, array $expectedResult): void
    {
        $retriever = new ResponseTypeRetriever();
        $result = $retriever->getResponseTypes($input);

        self::assertEquals($expectedResult, $result);
    }

    /** @test */
    public function getResponseTypesThrowsException(): void
    {
        $retriever = new ResponseTypeRetriever();

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('No response type specified');
        $this->expectExceptionCode(4);

        $retriever->getResponseTypes(['asd', 'dgadfg']);
    }
}
