<?php

declare(strict_types=1);

namespace SprykerCommunity\Zed\OmsVisualizer\Business;

interface OmsVisualizerFacadeInterface
{
    public function createFlowChart(string $processName): array;
}
