<?php

declare(strict_types=1);

namespace SLarisch\Zed\OmsVisualizer\Business\Processor;

use SLarisch\Zed\OmsVisualizer\Business\Creator\FlowChartRenderer;
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
