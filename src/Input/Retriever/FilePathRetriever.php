<?php
declare(strict_types=1);


namespace TextParser\Input\Retriever;


class FilePathRetriever
{
    private const SHORT_INPUT_PARAMETER = '-i';

    private const LONG_INPUT_PARAMETER = '--input';

    public function getFilePath(array $tokens): string
    {
        $pathParameter = $this->getPathParameterValue($tokens);

        return $this->getAbsolutePath($pathParameter);
    }

    private function getPathParameterValue(array $tokens): string
    {
        if (array_key_exists(self::SHORT_INPUT_PARAMETER, $tokens)) {
            return $tokens[self::SHORT_INPUT_PARAMETER];
        }

        if (array_key_exists(self::LONG_INPUT_PARAMETER, $tokens)) {
            return $tokens[self::LONG_INPUT_PARAMETER];
        }

        throw new \InvalidArgumentException('Required file path parameter not passed', 1);
    }

    private function getAbsolutePath(string $specifiedPath): string
    {
        $absolutePath = realpath($specifiedPath);
        if (!$absolutePath) {
            throw new \InvalidArgumentException('File does not exist', 1);
        }

        return $absolutePath;
    }
}