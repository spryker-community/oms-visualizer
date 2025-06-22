<?php

declare(strict_types=1);

namespace SLarisch\Zed\OmsVisualizer\Business\Creator;

use Generated\Shared\Transfer\StateStyleTransfer;
use SLarisch\Zed\OmsVisualizer\OmsVisualizerConfig;
use RuntimeException;

readonly class StateCreator
{
    public function __construct(
        private OmsVisualizerConfig $mermaidConfig
    ) {
    }

    public function createStateByType(string $stateName, string $stateType): string
    {
        $defaultStyle = $this->mermaidConfig->getDefaultStyleConfig();

        $method = sprintf('get%sStateStyle', ucfirst($stateType));

        if (!method_exists($defaultStyle, $method)) {
            throw new RuntimeException("Method $method does not exist on DefaultStyleConfig");
        }

        /** @var StateStyleTransfer $style */
        $style = $defaultStyle->$method();

        $backgroundColor = $style->getBackGroundColor();
        $borderColor = $style->getBorderColor();
        $borderWidth = $style->getBorderWidth();
        $fontColor = $style->getFontColor();

        return
            sprintf(
                "style %s fill:%s, stroke: %s, color: %s, stroke-width: %spx",
                $stateName,
                $backgroundColor,
                $borderColor,
                $fontColor,
                $borderWidth
            );
    }
}
