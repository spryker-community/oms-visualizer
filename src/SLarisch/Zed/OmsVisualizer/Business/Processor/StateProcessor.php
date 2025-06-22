<?php

declare(strict_types=1);

namespace SLarisch\Zed\OmsVisualizer\Business\Processor;

use SLarisch\Zed\OmsVisualizer\Business\Context\RenderContext;
use SLarisch\Zed\OmsVisualizer\Business\Creator\StateCreator;
use SLarisch\Zed\OmsVisualizer\OmsVisualizerConfig;
use SimpleXMLElement;

class StateProcessor
{
    private const string START_STATE = 'new';

    public function __construct(
        private readonly StateCreator $stateCreator,
        private readonly OmsVisualizerConfig $mermaidConfig,
    ) {
    }

    public function process(SimpleXMLElement $process, string $filePath, RenderContext $renderContext): array
    {
        if (!isset($process->states)) {
            return [];
        }

        $processName = (string)($process['name'] ?? basename($filePath));

        return [
            ...$this->createSubGraphHeader($processName),
            ...$this->createStateNodes($process, $renderContext),
            'end',
            ...$this->createStylingLines(),
        ];
    }

    private function createSubGraphHeader(string $processName): array
    {
        $style = $this->mermaidConfig->getDefaultStyleConfig()->getSubGraphStyle();

        return [
            "subgraph $processName",
            sprintf("style %s fill:%s,stroke:%s", $processName, $style->getBackGroundColor(), $style->getBorderColor()),
            "direction TB",
        ];
    }

    private function createStateNodes(SimpleXMLElement $process, RenderContext $renderContext): array
    {
        $lines = [];

        foreach ($process->states->state as $state) {
            $stateName = (string)$state['name'];
            $sanitizedName = $this->sanitizeNode($stateName);
            $renderContext->addState($sanitizedName);

            $lines[] = sprintf('%s[%s]', $sanitizedName, $stateName);

            if ($stateName === self::START_STATE) {
                $lines[] = $this->stateCreator->createStateByType($stateName, 'initial');
            }
        }

        return $lines;
    }

    private function createStylingLines(): array
    {
        $happyPathColor = $this->mermaidConfig->getDefaultStyleConfig()->getHappyPathStyle()->getColor();

        return [
            // sprintf("classDef happyPath stroke:%s;", $happyPathColor), TODO: animated config
            sprintf("classDef animatedPath stroke:%s, stroke-dasharray: 9,5,stroke-dashoffset: 900,animation: dash 60s linear infinite;", $happyPathColor),
        ];
    }

    private function sanitizeNode(string $name): string
    {
        return preg_replace('/[^a-zA-Z0-9_]/', '_', strtolower(trim($name)));
    }
}
