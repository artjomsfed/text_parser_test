<?php
declare(strict_types=1);


namespace TextParser\Test\Response\ResultCollection;


use TextParser\Enum\Format;
use TextParser\Response\ResultCollection\LeastRepeatingStrategy;
use PHPUnit\Framework\TestCase;
use TextParser\Response\ResultCollection\MostRepeatingStrategy;


class LeastRepeatingStrategyTest extends TestCase
{
    public function collectResultProvider(): array
    {
        return [
            'empty_input' => [[], 'None'],
            'no_repeating_chars' => [['a' => 1, 'b' => 1], 'None'],
            'repeating_chars_exists' => [['a' => 1, 'b' => 3, 'c' => 2, 'd' => 7], 'c'],
            'multiple_repeating_chars_same_count' => [['a' => 1, 'b' => 2, 'c' => 2, 'd' => 7], 'b'],
        ];
    }

    /**
     * @test
     * @dataProvider collectResultProvider
     */
    public function collectResult(array $input, ?string $expectedResult): void
    {
        $strategy = new LeastRepeatingStrategy();
        $result = $strategy->collectResult($input);

        self::assertEquals($expectedResult, $result);
    }

    /** @test  */
    public function getFormat(): void
    {
        $strategy = new LeastRepeatingStrategy();

        self::assertEquals(Format::LEAST_REPEATING(), $strategy->getFormat());
    }
}
