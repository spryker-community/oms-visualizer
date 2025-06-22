<?php

declare(strict_types=1);

namespace SLarisch\Zed\OmsVisualizer\Business;


use SLarisch\Zed\OmsVisualizer\Business\Context\RenderContext;
use SLarisch\Zed\OmsVisualizer\Business\Creator\FilePathCreator;
use SLarisch\Zed\OmsVisualizer\Business\Creator\FlowChartRenderer;
use SLarisch\Zed\OmsVisualizer\Business\Creator\StateCreator;
use SLarisch\Zed\OmsVisualizer\Business\Creator\VisitedFileTracker;
use SLarisch\Zed\OmsVisualizer\Business\Processor\EventProcessor;
use SLarisch\Zed\OmsVisualizer\Business\Processor\StateProcessor;
use SLarisch\Zed\OmsVisualizer\Business\Processor\SubProcessProcessor;
use SLarisch\Zed\OmsVisualizer\Business\Processor\TransitionProcessor;
use SLarisch\Zed\OmsVisualizer\OmsVisualizerConfig;
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
