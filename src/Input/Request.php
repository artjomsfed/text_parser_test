<?php
declare(strict_types=1);


namespace TextParser\Input;


use TextParser\Enum\Format;
use TextParser\Enum\ResponseType;

class Request
{
    /** @var string */
    private $filePath;

    /** @var Format */
    private $format;

    /** @var ResponseType[] */
    private $responseTypes;

    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->filePath;
    }

    /**
     * @param string $filePath
     *
     * @return Request
     */
    public function setFilePath(string $filePath): Request
    {
        $this->filePath = $filePath;

        return $this;
    }

    /**
     * @return Format
     */
    public function getFormat(): Format
    {
        return $this->format;
    }

    /**
     * @param Format $format
     *
     * @return Request
     */
    public function setFormat(Format $format): Request
    {
        $this->format = $format;

        return $this;
    }

    /**
     * @return ResponseType[]
     */
    public function getResponseTypes(): array
    {
        return $this->responseTypes;
    }

    /**
     * @param ResponseType[] $responseTypes
     *
     * @return Request
     */
    public function setResponseTypes(array $responseTypes): Request
    {
        $this->responseTypes = $responseTypes;

        return $this;
    }
}