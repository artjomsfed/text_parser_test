<?php
declare(strict_types=1);


namespace TextParser\Test\Input\Retriever;


use TextParser\Enum\Format;
use TextParser\Input\Retriever\FormatRetriever;
use PHPUnit\Framework\TestCase;


class FormatRetrieverTest extends TestCase
{
    public function getFormatThrowsExceptionProvider(): array
    {
        return [
            'no_parameter' => [
                [],
                'Required format parameter not passed',
            ],
            'incorrect_parameter_value' => [
                ['-f' => 'afsdasfa'],
                'Incorrect format specified',
            ],
        ];
    }

    /**
     * @test
     * @dataProvider getFormatThrowsExceptionProvider
     */
    public function getFormatThrowsException(array $inputParameters, string $expectedExceptionMessage): void
    {
        $retriever = new FormatRetriever();

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage($expectedExceptionMessage);
        $this->expectExceptionCode(3);

        $retriever->getFormat($inputParameters);
    }

    public function getFormatReturnsExpectedFormatProvider(): array
    {

        //non-repeating, least-repeating, or most-repeating
        return [
            'short_non_repeating' => [
                ['-f' => 'non-repeating'],
                Format::NON_REPEATING(),
            ],
            'short_least_repeating' => [
                ['-f' => 'least-repeating'],
                Format::LEAST_REPEATING(),
            ],
            'short_most_repeating' => [
                ['-f' => 'most-repeating'],
                Format::MOST_REPEATING(),
            ],
            'long_non_repeating' => [
                ['--format' => 'non-repeating'],
                Format::NON_REPEATING(),
            ],
            'long_least_repeating' => [
                ['--format' => 'least-repeating'],
                Format::LEAST_REPEATING(),
            ],
            'long_most_repeating' => [
                ['--format' => 'most-repeating'],
                Format::MOST_REPEATING(),
            ],
        ];
    }

    /**
     * @test
     * @dataProvider getFormatReturnsExpectedFormatProvider
     */
    public function getFormatReturnsExpectedFormat(array $inputParameters, Format $expectedFormat): void
    {
        $retriever = new FormatRetriever();
        $format = $retriever->getFormat($inputParameters);

        self::assertEquals($expectedFormat, $format);
    }
}
