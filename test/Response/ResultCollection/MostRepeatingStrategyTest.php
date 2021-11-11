<?php
declare(strict_types=1);


namespace TextParser\Test\Response\ResultCollection;


use PHPUnit\Framework\TestCase;
use TextParser\Enum\Format;
use TextParser\Response\ResultCollection\MostRepeatingStrategy;


class MostRepeatingStrategyTest extends TestCase
{
    public function collectResultProvider(): array
    {
        return [
            'empty_input' => [[], 'None'],
            'no_repeating_chars' => [['a' => 1, 'b' => 1], 'None'],
            'repeating_chars_exists' => [['a' => 1, 'b' => 3, 'c' => 2, 'd' => 7], 'd'],
            'multiple_repeating_chars_same_count' => [['a' => 1, 'b' => 7, 'c' => 2, 'd' => 7], 'b'],
        ];
    }

    /**
     * @test
     * @dataProvider collectResultProvider
     */
    public function collectResult(array $input, ?string $expectedResult): void
    {
        $strategy = new MostRepeatingStrategy();
        $result = $strategy->collectResult($input);

        self::assertEquals($expectedResult, $result);
    }

    /** @test  */
    public function getFormat(): void
    {
        $strategy = new MostRepeatingStrategy();

        self::assertEquals(Format::MOST_REPEATING(), $strategy->getFormat());
    }
}
