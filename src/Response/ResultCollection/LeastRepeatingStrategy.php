<?php
declare(strict_types=1);


namespace TextParser\Response\ResultCollection;


use TextParser\Enum\Format;

class LeastRepeatingStrategy implements ResultCollectionStrategy
{
    public function collectResult(array $characters): string
    {
        $leastRepeatingCharacter = null;
        $leastRepeatingCharacterCount = 0;

        foreach ($characters as $character => $characterCount) {
            if ($characterCount < 2) {
                continue;
            }

            if ($leastRepeatingCharacterCount > $characterCount || $leastRepeatingCharacter === null) {
                $leastRepeatingCharacter = $character;
                $leastRepeatingCharacterCount = $characterCount;
            }
        }

        return $leastRepeatingCharacter ?? self::NONE_RESPONSE;
    }

    public function getFormat(): Format
    {
        return Format::LEAST_REPEATING();
    }
}