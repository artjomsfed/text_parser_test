<?php
declare(strict_types=1);


namespace TextParser\Response\ResponseTypeHandler;


use TextParser\Parser\FileModel;
use TextParser\Response\ResultCollection\ResultCollectionStrategy;


interface ResponseHandler
{
    public function handle(FileModel $fileModel, ResultCollectionStrategy $collectionStrategy): string;
}