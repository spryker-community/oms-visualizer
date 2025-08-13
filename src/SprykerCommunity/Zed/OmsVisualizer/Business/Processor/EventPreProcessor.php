<?php

declare(strict_types=1);

namespace SprykerCommunity\Zed\OmsVisualizer\Business\Processor;

use SprykerCommunity\Zed\OmsVisualizer\Business\Creator\FilePathCreator;
use SprykerCommunity\Zed\OmsVisualizer\Business\Creator\VisitedFileTracker;
use SimpleXMLElement;

class EventPreProcessor
{
    public function __construct(
        private readonly EventProcessor $eventProcessor,
        private readonly FilePathCreator $filePathCreator,
        private readonly VisitedFileTracker $visitedFileTracker
    ) {}

    public function preProcessEvents(string $processName): void
    {
        if ($this->visitedFileTracker->hasVisited($processName)) {
            return;
        }

        $filePath = $this->filePathCreator->getFilePath($processName);
        $xml = simplexml_load_file($filePath);

        if (!$xml) {
            return;
        }

        $this->visitedFileTracker->markAsVisited($processName);

        foreach ($xml->process as $process) {
            $this->eventProcessor->process($process);

            if (!empty((string)$process['file'])) {
                $this->preProcessEvents((string)$process['file']);
            }
        }
    }
}
