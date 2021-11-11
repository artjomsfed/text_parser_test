<?php
declare(strict_types=1);


namespace TextParser\Test\Input;

use TextParser\Input\RequestTokenizer;
use PHPUnit\Framework\TestCase;


class RequestTokenizerTest extends TestCase
{

    public function tokenizeProvider()
    {
        return [
            'nothing' => [
                [],
                [],
            ],
            'no_arguments' => [
                ['1231231'], []
            ],
            'single_long_without_value' => [
                ['asdasd', '--include-symbol'],
                ['--include-symbol' => ''],
            ],
            'single_long_with_value' => [
                ['asdasd', '--include-symbol=traa'],
                ['--include-symbol' => 'traa'],
            ],
            'single_short_without_value' => [
                ['asdasd', '-S'],
                ['-S' => ''],
            ],
            'single_short_with_value' => [
                ['asdasd', '-S', 'asdeteasd'],
                ['-S' => 'asdeteasd'],
            ],
            'long_short_and_single_1' => [
                ['index.php', '--input=input.txt', '-f', 'non-repeating', '-L', '-P', '-S'],
                ['--input' => 'input.txt', '-f' => 'non-repeating', '-L' => '', '-P' => '', '-S' => ''],
            ],
            'long_short_and_single_2' => [
                ['index.php', '-S', '--input=input.txt', '-L', '-f', 'non-repeating', '-P'],
                ['-S' => '', '--input' => 'input.txt', '-L' => '', '-f' => 'non-repeating', '-P' => ''],
            ],
            'long_without_value' => [
                ['index.php', '--include-symbol', '--input=input.txt', '-L', '-f', 'non-repeating', '-P'],
                ['--include-symbol' => '', '--input' => 'input.txt', '-L' => '', '-f' => 'non-repeating', '-P' => ''],
            ]
        ];
    }

    /**
     * @test
     * @dataProvider tokenizeProvider
     */
    public function tokenize(array $input, array $expectedResult): void
    {
        $tokenizer = new RequestTokenizer();
        $result = $tokenizer->tokenize($input);

        self::assertEquals($expectedResult, $result);
    }
}
