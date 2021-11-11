<?php
declare(strict_types=1);


namespace TextParser\Test\Response\ResponseTypeHandler;


use TextParser\Parser\FileModel;
use TextParser\Response\ResponseTypeHandler\LetterHandler;
use PHPUnit\Framework\TestCase;
use TextParser\Response\ResultCollection\NonRepeatingStrategy;


class LetterHandlerTest extends TestCase
{
    /** @test */
    public function handle(): void
    {
        $fileModel = new FileModel();
        $fileModel->setLetters(['l' => 2, 'c' => 1, 'q' => 1, 'v' => 1, 'n' => 2, 'y' => 2, 'm' => 1, 'x' => 2, 'i' => 1, 'a' => 2]);
        $fileModel->setSymbols(['<' => 1, '`' => 1, '=' => 3, '+' => 1, '^' => 1]);
        $fileModel->setPunctuationMarks(['\\' =>  1,',' =>  1,'}' =>  1,'@' =>  1,]);

        $strategy = new NonRepeatingStrategy();
        $symbolHandler = new LetterHandler();

        $result = $symbolHandler->handle($fileModel, $strategy);

        self::assertEquals('First non-repeating letter: c', $result);
    }
}
