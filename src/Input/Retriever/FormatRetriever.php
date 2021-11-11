<?php
declare(strict_types=1);


namespace TextParser\Input\Retriever;


use TextParser\Enum\Format;


class FormatRetriever
{
    private const SHORT_INPUT_PARAMETER = '-f';

    private const LONG_INPUT_PARAMETER = '--format';

    public function getFormat(array $tokens): Format
    {
        $formatValue = $this->getFormatParameterValue($tokens);

        foreach (Format::values() as $format) {
            if ($format->getValue() === $formatValue) {
                return $format;
            }
        }

        throw new \InvalidArgumentException('Incorrect format specified', 3);
    }

    private function getFormatParameterValue(array $tokens): string
    {
        if (array_key_exists(self::SHORT_INPUT_PARAMETER, $tokens)) {
            return $tokens[self::SHORT_INPUT_PARAMETER];
        }

        if (array_key_exists(self::LONG_INPUT_PARAMETER, $tokens)) {
            return $tokens[self::LONG_INPUT_PARAMETER];
        }

        throw new \InvalidArgumentException('Required format parameter not passed', 3);
    }
}