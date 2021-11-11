<?php
declare(strict_types=1);


namespace TextParser\Test\Enum;

use TextParser\Enum\Format;
use PHPUnit\Framework\TestCase;


class FormatTest extends TestCase
{
    /** @test */
    public function formatMappedToCorrectName(): void
    {
        self::assertEquals('non-repeating', Format::NON_REPEATING());
        self::assertEquals('least-repeating', Format::LEAST_REPEATING());
        self::assertEquals('most-repeating', Format::MOST_REPEATING());
    }

    /** @test */
    public function getNameReturnsExpectedValue(): void
    {
        self::assertEquals('non-repeating', Format::NON_REPEATING()->getName());
        self::assertEquals('least repeating', Format::LEAST_REPEATING()->getName());
        self::assertEquals('most repeating', Format::MOST_REPEATING()->getName());
    }
}
