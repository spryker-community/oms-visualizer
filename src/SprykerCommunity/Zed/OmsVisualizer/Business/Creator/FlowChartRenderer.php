<?php

declare(strict_types=1);

namespace SprykerCommunity\Zed\OmsVisualizer\Business\Creator;

use SprykerCommunity\Zed\OmsVisualizer\Business\Context\RenderContext;
use SprykerCommunity\Zed\OmsVisualizer\Business\Processor\EventPreProcessor;
use SprykerCommunity\Zed\OmsVisualizer\Business\Processor\EventProcessor;
use SprykerCommunity\Zed\OmsVisualizer\Business\Processor\StateProcessor;
use SprykerCommunity\Zed\OmsVisualizer\Business\Processor\SubProcessProcessor;
use SprykerCommunity\Zed\OmsVisualizer\Business\Processor\TransitionProcessor;

readonly class FlowChartRenderer implements FlowChartRendererInterface
{
    public function __construct(
        private VisitedFileTracker $visitedFileTracker,
        private StateCreator $stateCreator,
        private StateProcessor $stateProcessor,
        private TransitionProcessor $transitionProcessor,
        private SubProcessProcessor $subProcessProcessor,
        private RenderContext $renderContext,
        private FilePathCreator $filePathCreator,
        private EventPreProcessor $eventPreProcessor
    ) {
    }

    public function render(string $processName): array
    {
        $this->eventPreProcessor->preProcessEvents($processName);

        if ($this->visitedFileTracker->hasVisited($processName)) {
            return [];
        }

        $filePath = $this->filePathCreator->getFilePath($processName);

        $xml = simplexml_load_file($filePath);

        if (!$xml) {
            return ["Error loading XML from $processName"];
        }

        $this->visitedFileTracker->markAsVisited($processName);

        $lines = [];
        if ($this->visitedFileTracker->getVisitedCount() === 1) {
            $lines[] = ["flowchart TB"];
        }

        foreach ($xml->process as $process) {
            $lines[] = $this->stateProcessor->process($process, $processName, $this->renderContext);
            $lines[] = $this->transitionProcessor->process($process, $this->renderContext);
            $lines[] = $this->subProcessProcessor->process($process, $this);
        }

        if ($this->visitedFileTracker->getVisitedCount() === count($xml->process)) {
            $lines[] = $this->createFinalStates();
            $lines[] = $this->createFailedStates();
            $lines[] = $this->createHappyPathLines();
            $lines[] = $this->createObsoleteStates();
        }

        return array_merge(...$lines);
    }

    private function createFinalStates(): array
    {
        $finalStates = array_diff(
            $this->renderContext->transitionStates,
            $this->renderContext->nonFinalStates
        );

        return array_map(
            fn(string $state) => $this->stateCreator->createStateByType($state, 'final'),
            $finalStates
        );
    }

    private function createFailedStates(): array
    {
        $failedStates = array_filter(
            $this->renderContext->transitionStates,
            fn(string $state) => str_ends_with($state, 'failed')
        );

        return array_map(
            fn(string $state) => $this->stateCreator->createStateByType($state, 'failed'),
            $failedStates
        );
    }

    private function createHappyPathLines(): array
    {
        return array_map(
            // fn(string $id): string => "class $id happyPath", TODO: animated config
            fn(string $id): string => "class $id animatedPath",
            $this->renderContext->happyPathLineIds
        );
    }

    private function createObsoleteStates(): array
    {
        $transitionStates = $this->renderContext->transitionStates;
        $states = $this->renderContext->states;

        $obsoleteStates = array_diff($states, $transitionStates);

        return array_map(
            fn(string $state) => $this->stateCreator->createStateByType($state, 'obsolete'),
            $obsoleteStates
        );
    }
}
