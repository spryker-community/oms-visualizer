<?php

namespace SprykerCommunity\Zed\OmsVisualizer\Business\Creator;

interface FlowChartRendererInterface
{
    public function render(string $processName): array;
}
