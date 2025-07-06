<?php

declare(strict_types=1);

namespace SprykerCommunity\Zed\OmsVisualizer\Business;


use SprykerCommunity\Zed\OmsVisualizer\Business\Context\RenderContext;
use SprykerCommunity\Zed\OmsVisualizer\Business\Creator\FilePathCreator;
use SprykerCommunity\Zed\OmsVisualizer\Business\Creator\FlowChartRenderer;
use SprykerCommunity\Zed\OmsVisualizer\Business\Creator\StateCreator;
use SprykerCommunity\Zed\OmsVisualizer\Business\Creator\VisitedFileTracker;
use SprykerCommunity\Zed\OmsVisualizer\Business\Processor\EventProcessor;
use SprykerCommunity\Zed\OmsVisualizer\Business\Processor\StateProcessor;
use SprykerCommunity\Zed\OmsVisualizer\Business\Processor\SubProcessProcessor;
use SprykerCommunity\Zed\OmsVisualizer\Business\Processor\TransitionProcessor;
use SprykerCommunity\Zed\OmsVisualizer\OmsVisualizerConfig;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method OmsVisualizerConfig getConfig()
 */
class OmsVisualizerBusinessFactory extends AbstractBusinessFactory
{
    public function createFlowChartRenderer(): FlowChartRenderer
    {
        return new FlowChartRenderer(
            $this->createVisitedFileTracker(),
            $this->createStateCreator(),
            $this->createEventProcessor(),
            $this->createStateProcessor(),
            $this->createTransitionProcessor(),
            $this->createSubProcessProcessor(),
            $this->createRenderContext(),
            $this->createFilePathCreator()
        );
    }

    public function createVisitedFileTracker(): VisitedFileTracker
    {
        return new VisitedFileTracker();
    }

    private function createEventProcessor(): EventProcessor
    {
        return new EventProcessor();
    }

    private function createStateProcessor(): StateProcessor
    {
        return new StateProcessor(
            $this->createStateCreator(),
            $this->getConfig()
        );
    }

    private function createTransitionProcessor(): TransitionProcessor
    {
        return new TransitionProcessor(
            $this->createEventProcessor()
        );
    }

    private function createSubProcessProcessor(): SubProcessProcessor
    {
        return new SubProcessProcessor();
    }

    private function createStateCreator(): StateCreator
    {
        return new StateCreator(
            $this->getConfig()
        );
    }

    private function createRenderContext(): RenderContext
    {
        return new RenderContext();
    }

    private function createFilePathCreator(): FilePathCreator
    {
        return new FilePathCreator(
            $this->getConfig()->getOmsConfigurationDirectory()
        );
    }
}
