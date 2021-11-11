<?php
declare(strict_types=1);


namespace TextParser\Response\ResultCollection;


use TextParser\Enum\Format;


interface ResultCollectionStrategy
{
    const NONE_RESPONSE = 'None';

    public function collectResult(array $characters): string;

    public function getFormat(): Format;
}