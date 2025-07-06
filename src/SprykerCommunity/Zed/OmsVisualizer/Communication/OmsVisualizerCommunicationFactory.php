<?php

declare(strict_types=1);

namespace SprykerCommunity\Zed\OmsVisualizer\Communication;

use SprykerCommunity\Zed\OmsVisualizer\OmsVisualizerDependencyProvider;
use SprykerCommunity\Zed\OmsVisualizer\OmsVisualizerConfig;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Spryker\Zed\Oms\Business\OmsFacadeInterface;

/**
 * @method OmsVisualizerConfig getConfig()
 */
class OmsVisualizerCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \Spryker\Zed\Oms\Business\OmsFacadeInterface
     */
    public function getOmsFacade(): OmsFacadeInterface
    {
        return $this->getProvidedDependency(OmsVisualizerDependencyProvider::FACADE_OMS);
    }
}
