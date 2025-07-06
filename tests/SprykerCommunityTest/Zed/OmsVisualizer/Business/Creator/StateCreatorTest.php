<?php

declare(strict_types=1);

namespace SprykerCommunityTest\Zed\OmsVisualizer\Business\Creator;

use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use SprykerCommunity\Zed\OmsVisualizer\Business\Creator\StateCreator;
use SprykerCommunity\Zed\OmsVisualizer\OmsVisualizerConfig;
use SprykerCommunityTest\Zed\OmsVisualizer\Business\Creator\Builder\OmsVisualizerStyleTransferBuilder;
use SprykerCommunityTest\Zed\OmsVisualizer\Business\Creator\Builder\StateStyleTransferBuilder;

class StateCreatorTest extends TestCase
{
    /**
     * @var \SprykerCommunity\Zed\OmsVisualizer\Business\Creator\StateCreator
     */
    protected StateCreator $stateCreator;

    /**
     * @var \SprykerCommunity\Zed\OmsVisualizer\OmsVisualizerConfig|\Mockery\MockInterface
     */
    protected OmsVisualizerConfig|MockInterface $configMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->configMock = Mockery::mock(OmsVisualizerConfig::class);
        $this->stateCreator = new StateCreator($this->configMock);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /**
     * @dataProvider stateTypeDataProvider
     */
    public function testCreateStateByTypeReturnsCorrectStateDefinition(
        string $stateName,
        string $stateType,
        string $methodName,
        array $styleData,
        string $expectedResult
    ): void {
        // Arrange
        $stateStyle = (new StateStyleTransferBuilder())
            ->withBackgroundColor($styleData['backgroundColor'])
            ->withBorderColor($styleData['borderColor'])
            ->withFontColor($styleData['fontColor'])
            ->build();

        $omsVisualizerStyle = (new OmsVisualizerStyleTransferBuilder())
            ->withStateStyle($methodName, $stateStyle)
            ->build();

        $this->configMock->shouldReceive('getDefaultStyleConfig')
            ->once()
            ->andReturn($omsVisualizerStyle);

        // Act
        $result = $this->stateCreator->createStateByType($stateName, $stateType);

        // Assert
        $this->assertSame($expectedResult, $result);
    }

    public function stateTypeDataProvider(): array
    {
        return [
            'initial state' => [
                'stateName' => 'new',
                'stateType' => 'initial',
                'methodName' => 'getInitialStateStyle',
                'styleData' => [
                    'backgroundColor' => '#e1f5fe',
                    'borderColor' => '#03a9f4',
                    'fontColor' => '#01579b',
                ],
                'expectedResult' => 'style new fill:#e1f5fe,stroke:#03a9f4,color:#01579b',
            ],
            'normal state' => [
                'stateName' => 'processing',
                'stateType' => 'normal',
                'methodName' => 'getNormalStateStyle',
                'styleData' => [
                    'backgroundColor' => '#ffffff',
                    'borderColor' => '#999999',
                    'fontColor' => '#333333',
                ],
                'expectedResult' => 'style processing fill:#ffffff,stroke:#999999,color:#333333',
            ],
            'final state' => [
                'stateName' => 'completed',
                'stateType' => 'final',
                'methodName' => 'getFinalStateStyle',
                'styleData' => [
                    'backgroundColor' => '#e8f5e9',
                    'borderColor' => '#4caf50',
                    'fontColor' => '#1b5e20',
                ],
                'expectedResult' => 'style completed fill:#e8f5e9,stroke:#4caf50,color:#1b5e20',
            ],
            'failed state' => [
                'stateName' => 'payment_failed',
                'stateType' => 'failed',
                'methodName' => 'getFailedStateStyle',
                'styleData' => [
                    'backgroundColor' => '#ffebee',
                    'borderColor' => '#f44336',
                    'fontColor' => '#b71c1c',
                ],
                'expectedResult' => 'style payment_failed fill:#ffebee,stroke:#f44336,color:#b71c1c',
            ],
            'obsolete state' => [
                'stateName' => 'deprecated',
                'stateType' => 'obsolete',
                'methodName' => 'getObsoleteStateStyle',
                'styleData' => [
                    'backgroundColor' => '#f5f5f5',
                    'borderColor' => '#9e9e9e',
                    'fontColor' => '#616161',
                ],
                'expectedResult' => 'style deprecated fill:#f5f5f5,stroke:#9e9e9e,color:#616161',
            ],
        ];
    }
}
