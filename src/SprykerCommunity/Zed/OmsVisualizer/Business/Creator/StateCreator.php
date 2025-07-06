<?php

declare(strict_types=1);

namespace SprykerCommunity\Zed\OmsVisualizer\Business\Creator;

use Generated\Shared\Transfer\StateStyleTransfer;
use SprykerCommunity\Zed\OmsVisualizer\OmsVisualizerConfig;
use RuntimeException;

readonly class StateCreator implements StateCreateInterface
{
    public function __construct(
        private OmsVisualizerConfig $mermaidConfig
    ) {
    }

    public function createStateByType(string $stateName, string $stateType): string
    {
        $defaultStyle = $this->mermaidConfig->getDefaultStyleConfig();

        $method = sprintf('get%sStateStyle', ucfirst($stateType));

        try {
            /** @var StateStyleTransfer $style */
            $style = $defaultStyle->$method();
        } catch (\Exception $e) {
            throw new RuntimeException("Method $method does not exist on DefaultStyleConfig");
        }

        $backgroundColor = $style->getBackGroundColor();
        $borderColor = $style->getBorderColor();
        $borderWidth = $style->getBorderWidth();
        $fontColor = $style->getFontColor();

        return
            sprintf(
                "style %s fill:%s,stroke:%s,color:%s",
                $stateName,
                $backgroundColor,
                $borderColor,
                $fontColor
            );
    }
}
