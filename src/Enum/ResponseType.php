<?php
declare(strict_types=1);


namespace TextParser\Enum;


use MyCLabs\Enum\Enum;


/**
 * @method static self INCLUDE_LETTER()
 * @method static self INCLUDE_PUNCTUATION()
 * @method static self INCLUDE_SYMBOL()
 */
class ResponseType extends Enum
{
    private const INCLUDE_LETTER = 'include_letter';
    private const INCLUDE_PUNCTUATION = 'include_punctuation';
    private const INCLUDE_SYMBOL = 'include_symbol';

    public function getShortParameter(): string
    {
        return match ($this->getValue()) {
            self::INCLUDE_LETTER => '-L',
            self::INCLUDE_PUNCTUATION => '-P',
            self::INCLUDE_SYMBOL => '-S',
        };
    }

    public function getLongParameter(): string
    {
        return match ($this->getValue()) {
            self::INCLUDE_LETTER => '--include-letter',
            self::INCLUDE_PUNCTUATION => '--include-punctuation',
            self::INCLUDE_SYMBOL => '--include-symbol',
        };
    }
}