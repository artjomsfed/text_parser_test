<?php
declare(strict_types=1);


namespace TextParser\Response\ResponseTypeHandler;


use TextParser\Parser\FileModel;
use TextParser\Response\ResultCollection\ResultCollectionStrategy;


class PunctuationMarkHandler implements ResponseHandler
{
    public function handle(FileModel $fileModel, ResultCollectionStrategy $collectionStrategy): string
    {
        $characters = $fileModel->getPunctuationMarks();
        $resultingCharacter = $collectionStrategy->collectResult($characters);

        return 'First ' . $collectionStrategy->getFormat()->getName() . ' punctuation: ' . $resultingCharacter;
    }
}