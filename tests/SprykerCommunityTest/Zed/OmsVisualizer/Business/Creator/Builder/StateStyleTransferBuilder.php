<?php

declare(strict_types=1);

namespace SprykerCommunityTest\Zed\OmsVisualizer\Business\Creator\Builder;

use Mockery;
use Mockery\MockInterface;

class StateStyleTransferBuilder
{
    private string $backgroundColor = '';
    private string $borderColor = '';
    private string $fontColor = '';
    private string $borderWidth = '1';

    public function withBackgroundColor(string $backgroundColor): self
    {
        $this->backgroundColor = $backgroundColor;
        return $this;
    }

    public function withBorderColor(string $borderColor): self
    {
        $this->borderColor = $borderColor;
        return $this;
    }

    public function withFontColor(string $fontColor): self
    {
        $this->fontColor = $fontColor;
        return $this;
    }

    public function withBorderWidth(string $borderWidth): self
    {
        $this->borderWidth = $borderWidth;
        return $this;
    }

    public function build(): MockInterface
    {
        $mock = Mockery::mock('Generated\Shared\Transfer\StateStyleTransfer');

        $mock->shouldReceive('getBackGroundColor')
            ->andReturn($this->backgroundColor);

        $mock->shouldReceive('getBorderColor')
            ->andReturn($this->borderColor);

        $mock->shouldReceive('getFontColor')
            ->andReturn($this->fontColor);

        $mock->shouldReceive('getBorderWidth')
            ->andReturn($this->borderWidth);

        return $mock;
    }
}
