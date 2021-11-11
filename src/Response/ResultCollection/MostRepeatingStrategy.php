<?php
declare(strict_types=1);


namespace TextParser\Response\ResultCollection;


use TextParser\Enum\Format;


class MostRepeatingStrategy implements ResultCollectionStrategy
{
    public function collectResult(array $characters): string
    {
        $mostRepeatingCharacter = null;
        $mostRepeatingCharacterCount = 0;

        foreach ($characters as $character => $characterCount) {
            if ($characterCount < 2) {
                continue;
            }

            if ($mostRepeatingCharacterCount < $characterCount || $mostRepeatingCharacter === null) {
                $mostRepeatingCharacter = $character;
                $mostRepeatingCharacterCount = $characterCount;
            }
        }

        return $mostRepeatingCharacter ?? self::NONE_RESPONSE;
    }

    public function getFormat(): Format
    {
        return Format::MOST_REPEATING();
    }
}