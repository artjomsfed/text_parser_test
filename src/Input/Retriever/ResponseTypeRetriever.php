<?php
declare(strict_types=1);


namespace TextParser\Input\Retriever;


use TextParser\Enum\ResponseType;


class ResponseTypeRetriever
{
    /** @return ResponseType[] */
    public function getResponseTypes(array $tokens): array
    {
        $responseTypes = [];
        foreach (ResponseType::values() as $responseType) {
            if ($this->isRequested($tokens, $responseType)) {
                $responseTypes[] = $responseType;
            }
        }

        if (empty($responseTypes)) {
            throw new \InvalidArgumentException('No response type specified', 4);
        }

        return $responseTypes;
    }

    private function isRequested(array $tokens, ResponseType $responseType): bool
    {
        $shortParameter = $responseType->getShortParameter();
        $longParameter = $responseType->getLongParameter();
        if (array_key_exists($shortParameter, $tokens) || array_key_exists($longParameter, $tokens)) {
            return true;
        }

        return false;
    }
}