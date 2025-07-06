<?php

declare(strict_types=1);

namespace SprykerCommunityTest\Zed\OmsVisualizer\Business;

use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use SprykerCommunity\Zed\OmsVisualizer\Business\Creator\FlowChartRendererInterface;
use SprykerCommunity\Zed\OmsVisualizer\Business\OmsVisualizerBusinessFactory;
use SprykerCommunity\Zed\OmsVisualizer\Business\OmsVisualizerFacade;

class OmsVisualizerFacadeTest extends TestCase
{
    /**
     * @var \SprykerCommunity\Zed\OmsVisualizer\Business\OmsVisualizerFacade
     */
    protected OmsVisualizerFacade $facade;

    /**
     * @var \SprykerCommunity\Zed\OmsVisualizer\Business\OmsVisualizerBusinessFactory|\Mockery\MockInterface
     */
    protected OmsVisualizerBusinessFactory|MockInterface $factoryMock;

    /**
     * @var \SprykerCommunity\Zed\OmsVisualizer\Business\Creator\FlowChartRenderer|\Mockery\MockInterface
     */
    protected FlowChartRendererInterface|MockInterface $flowChartRendererMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->flowChartRendererMock = Mockery::mock(FlowChartRendererInterface::class);

        $this->factoryMock = Mockery::mock(OmsVisualizerBusinessFactory::class);
        $this->factoryMock->shouldReceive('createFlowChartRenderer')
            ->andReturn($this->flowChartRendererMock);

        $this->facade = new OmsVisualizerFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testCreateFlowChartDelegatesToFlowChartRenderer(): void
    {
        // Arrange
        $processName = 'test-process';
        $expectedResult = ['flowchart TB', 'A --> B'];

        $this->flowChartRendererMock->shouldReceive('render')
            ->once()
            ->with($processName)
            ->andReturn($expectedResult);

        // Act
        $result = $this->facade->createFlowChart($processName);

        // Assert
        $this->assertSame($expectedResult, $result);
    }
}
