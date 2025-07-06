<?php

namespace SprykerCommunity\Zed\OmsVisualizer\Communication\Controller;

use SprykerCommunity\Zed\OmsVisualizer\Business\OmsVisualizerFacadeInterface;
use SprykerCommunity\Zed\OmsVisualizer\Communication\OmsVisualizerCommunicationFactory;
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
