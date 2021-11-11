<?php
declare(strict_types=1);


namespace TextParser\Parser;


use Generator;
use RuntimeException;


class FileParser
{
    public function parse(string $filePath): FileModel
    {
        $fileModel = new FileModel();

        foreach ($this->getFileCharacterStream($filePath) as $character) {
            if ($this->isLetter($character)) {
                $fileModel->addLetter($character);

                continue;
            }

            if ($this->isPunctuationMark($character)) {
                $fileModel->addPunctuationMark($character);

                continue;
            }

            if ($this->isSymbol($character)) {
                $fileModel->addSymbol($character);

                continue;
            }

            throw new RuntimeException('Not allowed character', 2);
        }

        $this->checkFileModelEmpty($fileModel);

        return $fileModel;
    }

    public function getFileCharacterStream(string $filePath): Generator
    {
        $fp = fopen($filePath, 'r');
        while (false !== ($char = fgetc($fp))) {
            yield $char;
        }
    }

    private function isLetter(string $character): bool
    {
        return preg_match('/[a-z]/', $character) === 1;
    }

    private function isPunctuationMark(string $character): bool
    {
        return preg_match('/[!"#%&\'()*,-.\/:;?@\[\\\\\]_{}]/', $character) === 1;
    }

    private function isSymbol(string $character): bool
    {
        return preg_match('/[$+<=>^`|~]/', $character) === 1;
    }

    private function checkFileModelEmpty(FileModel $fileModel): void
    {
        $isEmpty = empty($fileModel->getLetters()) &&
            empty($fileModel->getPunctuationMarks()) &&
            empty($fileModel->getSymbols());

        if ($isEmpty) {
            throw new RuntimeException('No characters found', 2);
        }
    }
}