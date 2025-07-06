<?php

declare(strict_types=1);

namespace SprykerCommunity\Zed\OmsVisualizer\Business\Processor;

use SprykerCommunity\Zed\OmsVisualizer\Business\Context\RenderContext;
use SimpleXMLElement;

readonly class TransitionProcessor
{
    public function __construct(
        private EventProcessor $eventProcessor
    ) {
    }

    public function process(SimpleXMLElement $process, RenderContext $renderContext): array
    {
        if (!isset($process->transitions)) {
            return [];
        }

        $lines = [];

        foreach ($process->transitions->transition as $transition) {
            $from = $this->sanitizeNode((string)$transition->source);
            $to = $this->sanitizeNode((string)$transition->target);

            $renderContext->addTransitionState($from);
            $renderContext->addTransitionState($to);
            $renderContext->addNonFinalState($from);

            $label = $this->eventProcessor->getEventLabel((string)$transition->event);
            $arrow = $this->determineArrow($transition, $label, $renderContext);

            $lines[] = "$from$arrow$to";
        }

        return $lines;
    }

    private function determineArrow($transition, string $label, RenderContext $renderContext): string
    {
        $isCondition = isset($transition['condition']);
        $isHappy = isset($transition['happy']);

        if ($isCondition) {
            $label = !empty($transition['condition']) ? $transition['condition'] : $label;
            $path = $label ? " -. $label -.-> " : " -.-> ";

            if ($isHappy) {
                $id = substr(str_shuffle(MD5(microtime())), 0, 3);
                $renderContext->addHappyPathLineId($id);

                $styledHappyPathWithoutLabel = sprintf(' %s@-.-> ', $id);
                $styledHappyPathWithLabel = sprintf(' %s@-. ', $id);

                return $label ? " $styledHappyPathWithLabel $label -.-> " : " $styledHappyPathWithoutLabel ";
            }

            return $path;
        }

        if ($isHappy) {
            $id = substr(str_shuffle(MD5(microtime())), 0, 3);
            $renderContext->addHappyPathLineId($id);

            $styledHappyPathWithoutLabel = sprintf(' %s@==> ', $id);
            $styledHappyPathWithLabel = sprintf(' %s@== ', $id);

            return $label ? " $styledHappyPathWithLabel $label ==> " : " $styledHappyPathWithoutLabel ";
        }

        return $label ? " -- $label --> " : " --> ";
    }

    private function sanitizeNode(string $name): string
    {
        return preg_replace('/[^a-zA-Z0-9_]/', '_', strtolower(trim($name)));
    }
}
