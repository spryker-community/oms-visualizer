<?php

declare(strict_types=1);

namespace SprykerCommunity\Zed\OmsVisualizer\Business\Processor;

use SprykerCommunity\Zed\OmsVisualizer\Business\Creator\FlowChartRenderer;
use SimpleXMLElement;

class SubProcessProcessor
{
    public function process(SimpleXMLElement $process, FlowChartRenderer $flowChartRenderer): array
    {
        if (!isset($process['file'])) {
            return [];
        }

        return $flowChartRenderer->render((string)$process['file']);
    }
}
