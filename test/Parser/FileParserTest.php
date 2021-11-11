<?php

namespace TextParser\Test\Parser;

use TextParser\Parser\FileParser;
use PHPUnit\Framework\TestCase;

class FileParserTest extends TestCase
{
    public function parseThrowsExceptionProvider(): array
    {
        return [
            'empty_file' => [__DIR__ . '/../test_files/file_path_test', 'No characters found'],
            'incorrect_character' => [__DIR__ . '/../test_files/incorrect_input.txt', 'Not allowed character'],
        ];
    }

    /**
     * @test
     * @dataProvider parseThrowsExceptionProvider
     */
    public function parseThrowsException(string $filePath, string $expectedExceptionMessage): void
    {
        $parser = new FileParser();

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage($expectedExceptionMessage);
        $this->expectExceptionCode(2);

        $parser->parse($filePath);
    }

    /** @test */
    public function parse(): void
    {
        $filePath = __DIR__ . '/../test_files/correct_input.txt';
        $parser = new FileParser();

        $fileModel = $parser->parse($filePath);

        self::assertEquals(
            ['l' => 2, 'c' => 1, 'q' => 1, 'v' => 1, 'n' => 2, 'y' => 2, 'm' => 1, 'x' => 2, 'i' => 1, 'a' => 2],
            $fileModel->getLetters()
        );
        self::assertEquals(
            ['<' => 1, '`' => 1, '=' => 3, '+' => 1, '^' => 1],
            $fileModel->getSymbols()
        );
        self::assertEquals(
            ['\\' =>  1,',' =>  1,'}' =>  1,'@' =>  1,],
            $fileModel->getPunctuationMarks()
        );
    }
}
