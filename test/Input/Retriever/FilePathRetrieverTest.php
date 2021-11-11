<?php
declare(strict_types=1);


namespace TextParser\Test\Input\Retriever;


use TextParser\Input\Retriever\FilePathRetriever;
use PHPUnit\Framework\TestCase;


class FilePathRetrieverTest extends TestCase
{
    public function getFilePathThrowsExceptionProvider(): array
    {
        return [
            'no_input_parameter' => [
                ['asd', 'a'],
                'Required file path parameter not passed',
            ],
            'file_does_not_exist' => [
                ['-i' => 'dummy'],
                'File does not exist',
            ],
        ];
    }

    /**
     * @test
     * @dataProvider getFilePathThrowsExceptionProvider
     */
    public function getFilePathThrowsException(array $inputParameters, string $expectedExceptionMessage): void
    {
        $retriever = new FilePathRetriever();

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage($expectedExceptionMessage);
        $this->expectExceptionCode(1);

        $retriever->getFilePath($inputParameters);
    }

    public function getFilePathReturnsAbsolutePathToExistingFileProvider(): array
    {
        return [
            'file_exists_short_parameter' => [
                ['-i' => 'test/test_files/file_path_test'],
            ],
            'file_exists_long_parameter' => [
                ['--input' => 'test/test_files/file_path_test'],
            ],
        ];
    }

    /**
     * @test
     * @dataProvider getFilePathReturnsAbsolutePathToExistingFileProvider
     */
    public function getFilePathReturnsAbsolutePathToExistingFile(array $inputParameters): void
    {
        $retriever = new FilePathRetriever();
        $filePath = $retriever->getFilePath($inputParameters);

        self::assertTrue(file_exists($filePath));
    }
}
