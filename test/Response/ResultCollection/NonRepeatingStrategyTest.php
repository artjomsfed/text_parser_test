<?php
declare(strict_types=1);


namespace TextParser\Test\Response\ResultCollection;


use TextParser\Enum\Format;
use TextParser\Response\ResultCollection\NonRepeatingStrategy;
use PHPUnit\Framework\TestCase;


class NonRepeatingStrategyTest extends TestCase
{
    public function collectResultProvider(): array
    {
        return [
            'empty_input' => [[], 'None'],
            'no_non_repeating_chars' => [['a' => 2, 'b' => 3], 'None'],
            'single_non_repeating_char' => [['a' => 1, 'b' => 3], 'a'],
            'multiple_non_repeating_chars' => [['a' => 1, 'b' => 3, 'c' => 1], 'a'],
        ];
    }

    /**
     * @test
     * @dataProvider collectResultProvider
     */
    public function collectResult(array $input, ?string $expectedResult): void
    {
        $strategy = new NonRepeatingStrategy();
        $result = $strategy->collectResult($input);

        self::assertEquals($expectedResult, $result);
    }

    /** @test  */
    public function getFormat(): void
    {
        $strategy = new NonRepeatingStrategy();

        self::assertEquals(Format::NON_REPEATING(), $strategy->getFormat());
    }
}
