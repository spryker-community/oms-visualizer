<?php

declare(strict_types=1);

namespace SprykerCommunityTest\Zed\OmsVisualizer\Business\Creator\Builder;

use Mockery;
use Mockery\MockInterface;

class OmsVisualizerStyleTransferBuilder
{
    private array $stateStyles = [];

    public function withStateStyle(string $methodName, MockInterface $stateStyleTransfer): self
    {
        $this->stateStyles[$methodName] = $stateStyleTransfer;
        return $this;
    }

    public function build(): MockInterface
    {
        $mock = Mockery::mock('Generated\Shared\Transfer\OmsVisualizerStyleTransfer');

        foreach ($this->stateStyles as $methodName => $stateStyleTransfer) {
            $mock->shouldReceive($methodName)
                ->andReturn($stateStyleTransfer);
        }

        return $mock;
    }
}
