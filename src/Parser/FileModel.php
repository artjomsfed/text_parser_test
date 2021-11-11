<?php
declare(strict_types=1);


namespace TextParser\Parser;


class FileModel
{
    private $letters = [];

    private $symbols = [];

    private $punctuationMarks = [];

    /**
     * @return array
     */
    public function getLetters(): array
    {
        return $this->letters;
    }

    /**
     * @param array $letters
     *
     * @return FileModel
     */
    public function setLetters(array $letters): FileModel
    {
        $this->letters = $letters;

        return $this;
    }

    /**
     * @return array
     */
    public function getPunctuationMarks(): array
    {
        return $this->punctuationMarks;
    }

    /**
     * @param array $punctuationMarks
     *
     * @return FileModel
     */
    public function setPunctuationMarks(array $punctuationMarks): FileModel
    {
        $this->punctuationMarks = $punctuationMarks;

        return $this;
    }

    /**
     * @return array
     */
    public function getSymbols(): array
    {
        return $this->symbols;
    }

    /**
     * @param array $symbols
     *
     * @return FileModel
     */
    public function setSymbols(array $symbols): FileModel
    {
        $this->symbols = $symbols;

        return $this;
    }

    public function addLetter(string $character): void
    {
        if (!array_key_exists($character, $this->letters)) {
            $this->letters[$character] = 0;
        }

        $this->letters[$character] += 1;
    }

    public function addPunctuationMark(string $character): void
    {
        if (!array_key_exists($character, $this->punctuationMarks)) {
            $this->punctuationMarks[$character] = 0;
        }

        $this->punctuationMarks[$character] += 1;
    }

    public function addSymbol(string $character): void
    {
        if (!array_key_exists($character, $this->symbols)) {
            $this->symbols[$character] = 0;
        }

        $this->symbols[$character] += 1;
    }
}