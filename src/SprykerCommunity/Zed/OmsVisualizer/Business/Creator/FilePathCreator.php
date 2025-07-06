<?php

declare(strict_types=1);

namespace SprykerCommunity\Zed\OmsVisualizer\Business\Creator;

readonly class FilePathCreator
{
    public function __construct(
        private string $omsDirectoryPath
    ) {
    }

    public function getFilePath(string $processName): string
    {
        $fileName = str_ends_with($processName, '.xml') ? $processName : $processName . '.xml';

        return sprintf('%s/%s', $this->omsDirectoryPath, $fileName);
    }
}
