<?php
declare(strict_types=1);


namespace TextParser\Response\ResponseTypeHandler;


use TextParser\Parser\FileModel;
use TextParser\Response\ResultCollection\ResultCollectionStrategy;

class LetterHandler implements ResponseHandler
{
    public function handle(FileModel $fileModel, ResultCollectionStrategy $collectionStrategy): string
    {
        $characters = $fileModel->getLetters();
        $resultingCharacter = $collectionStrategy->collectResult($characters);

        return 'First ' . $collectionStrategy->getFormat()->getName() . ' letter: ' . $resultingCharacter;
    }
}