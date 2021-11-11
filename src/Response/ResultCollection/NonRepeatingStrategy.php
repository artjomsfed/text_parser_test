<?php
declare(strict_types=1);


namespace TextParser\Response\ResultCollection;


use TextParser\Enum\Format;

class NonRepeatingStrategy implements ResultCollectionStrategy
{
    public function collectResult(array $characters): string
    {
        foreach ($characters as $character => $characterCount) {
            if ($characterCount === 1) {
                return $character;
            }
        }

        return self::NONE_RESPONSE;
    }

    public function getFormat(): Format
    {
        return Format::NON_REPEATING();
    }
}