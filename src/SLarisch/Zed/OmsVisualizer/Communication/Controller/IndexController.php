<?php

namespace SLarisch\Zed\OmsVisualizer\Communication\Controller;

use SLarisch\Zed\OmsVisualizer\Business\OmsVisualizerFacadeInterface;
use SLarisch\Zed\OmsVisualizer\Communication\OmsVisualizerCommunicationFactory;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;

/**
 * @method OmsVisualizerFacadeInterface getFacade()
 * @method OmsVisualizerCommunicationFactory getFactory()
 */
class IndexController extends AbstractController
{
    public function indexAction(): array
    {
        return $this->viewResponse([
            'processes' => $this->getFactory()->getOmsFacade()->getProcesses(),
        ]);
    }
}
