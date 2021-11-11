<?php
declare(strict_types=1);


namespace TextParser\Test\Enum;


use TextParser\Enum\ResponseType;
use PHPUnit\Framework\TestCase;


class ResponseTypeTest extends TestCase
{
    /** @test */
    public function responseTypeMappedToCorrectName(): void
    {
        self::assertEquals('include_letter', ResponseType::INCLUDE_LETTER());
        self::assertEquals('include_punctuation', ResponseType::INCLUDE_PUNCTUATION());
        self::assertEquals('include_symbol', ResponseType::INCLUDE_SYMBOL());
    }

    /** @test  */
    public function getShortParameterReturnsExpectedValue(): void
    {
        self::assertEquals('-L', ResponseType::INCLUDE_LETTER()->getShortParameter());
        self::assertEquals('-P', ResponseType::INCLUDE_PUNCTUATION()->getShortParameter());
        self::assertEquals('-S', ResponseType::INCLUDE_SYMBOL()->getShortParameter());
    }

    /** @test  */
    public function getLongParameterReturnsExpectedValue(): void
    {
        self::assertEquals('--include-letter', ResponseType::INCLUDE_LETTER()->getLongParameter());
        self::assertEquals('--include-punctuation', ResponseType::INCLUDE_PUNCTUATION()->getLongParameter());
        self::assertEquals('--include-symbol', ResponseType::INCLUDE_SYMBOL()->getLongParameter());
    }
}
