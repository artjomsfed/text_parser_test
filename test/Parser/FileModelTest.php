<?php
declare(strict_types=1);


namespace TextParser\Test\Parser;

use TextParser\Parser\FileModel;
use PHPUnit\Framework\TestCase;


class FileModelTest extends TestCase
{
    /** @test  */
    public function setAndGetPunctuationMarks()
    {
        $data = ['a', 'b', 'c'];
        $fileModel = new FileModel();
        $fileModel->setPunctuationMarks($data);

        self::assertEquals($data, $fileModel->getPunctuationMarks());
    }

    /** @test */
    public function setAndGetSymbols()
    {
        $data = ['a', 'b', 'c'];
        $fileModel = new FileModel();
        $fileModel->setSymbols($data);

        self::assertEquals($data, $fileModel->getSymbols());
    }

    /** @test */
    public function setAndGetLetters()
    {
        $data = ['a', 'b', 'c'];
        $fileModel = new FileModel();
        $fileModel->setLetters($data);

        self::assertEquals($data, $fileModel->getLetters());
    }

    /** @test */
    public function addPunctuationMark()
    {
        $fileModel = new FileModel();
        $fileModel->addPunctuationMark('!');

        self::assertEquals(['!' => 1], $fileModel->getPunctuationMarks());
    }

    /** @test */
    public function addLetter()
    {
        $fileModel = new FileModel();
        $fileModel->addLetter('a');

        self::assertEquals(['a' => 1], $fileModel->getLetters());
    }

    /** @test */
    public function addSymbol()
    {
        $fileModel = new FileModel();
        $fileModel->addSymbol('=');

        self::assertEquals(['=' => 1], $fileModel->getSymbols());
    }
}
