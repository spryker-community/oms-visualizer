<?php

declare(strict_types=1);

namespace SLarisch\Zed\OmsVisualizer\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method OmsVisualizerBusinessFactory getFactory()
 */
class OmsVisualizerFacade extends AbstractFacade implements OmsVisualizerFacadeInterface
{
    public function createFlowChart(string $processName): array
    {
        return $this->getFactory()
            ->createFlowChartRenderer()
            ->render($processName);
    }
}
