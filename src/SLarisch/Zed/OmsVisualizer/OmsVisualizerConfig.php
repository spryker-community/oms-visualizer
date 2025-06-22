<?php

declare(strict_types=1);

namespace SLarisch\Zed\OmsVisualizer;

use Generated\Shared\Transfer\OmsVisualizerStyle;
use Generated\Shared\Transfer\StateStyleTransfer;
use Generated\Shared\Transfer\TransitionStyleTransfer;
use SLarisch\Shared\OmsVisualizer\OmsVisualizerConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class OmsVisualizerConfig extends AbstractBundleConfig
{
    private const bool DEFAULT_DEBUG_MODE = false;

    private const string DEFAULT_STATE_BORDER_WIDTH = '1';

    private const string DEFAULT_INITIAL_STATE_BORDER_COLOR = '#33CC66';

    private const string DEFAULT_INITIAL_STATE_BACKGROUND_COLOR = '#33CC66';

    private const string DEFAULT_INITIAL_STATE_FONT_COLOR = '#FFFFFF';

    private const string DEFAULT_NORMAL_STATE_BORDER_COLOR = '#33CC66';

    private const string DEFAULT_NORMAL_STATE_BACKGROUND_COLOR = '#FFFADD';

    private const string DEFAULT_NORMAL_STATE_FONT_COLOR = '#FFFFFF';

    private const string DEFAULT_OBSOLETE_STATE_BORDER_COLOR = '#DDDDDD';

    private const string DEFAULT_OBSOLETE_STATE_BACKGROUND_COLOR = '#DDDDDD';

    private const string DEFAULT_OBSOLETE_STATE_FONT_COLOR = '#BBBBBB';

    private const string DEFAULT_FINAL_STATE_BORDER_COLOR = '#FFFADD';

    private const string DEFAULT_FINAL_BACKGROUND_COLOR = '#6699FF';

    private const string DEFAULT_FINAL_STATE_FONT_COLOR = '#FFFFFF';

    private const string DEFAULT_FAILED_STATE_BORDER_COLOR = '#F08080';

    private const string DEFAULT_FAILED_BACKGROUND_COLOR = '#F08080';

    private const string DEFAULT_FAILED_STATE_FONT_COLOR = '#FFFFFF';

    private const string DEFAULT_SUB_GRAPH_BACKGROUND_COLOR = '#EEEEEE';

    private const string DEFAULT_SUB_GRAPH_BORDER_COLOR = '#CCCCCC';

    private const string DEFAULT_HAPPY_PATH_COLOR = '#00FF00';

    private const string DEFAULT_LABEL_BACKGROUND_COLOR = '#FFFFFF';

    private const string DEFAULT_OMS_CONFIGURATION_DIRECTORY = '/data/config/Zed/oms';

    private const array MERMAID_GLOBAL_CONFIGURATION = [
        'htmlLabels' => true,
        'useMaxWidth' => true,
        'startOnLoad' => false,
        'logLevel' => 3,
        'layout' => 'elk',
        'look' => 'default',
        'theme' => 'base',
        'themeVariables' => [
            'edgeLabelBackground' => self::DEFAULT_LABEL_BACKGROUND_COLOR,
        ],
    ];

    public function getDefaultStyleConfig(): OmsVisualizerStyleTransfer
    {
        return (new OmsVisualizerStyleTransfer())
            ->setSubGraphStyle(
                (new StateStyleTransfer())
                    ->setBackgroundColor($this->getSubGraphBackgroundColor())
                    ->setBorderColor($this->getSubGraphBorderColor())
                    ->setBorderWidth($this->getStateBorderWidth())
            )
            ->setInitialStateStyle(
                (new StateStyleTransfer())
                    ->setBackgroundColor($this->getInitialStateBackgroundColor())
                    ->setBorderColor($this->getInitialStateBorderColor())
                    ->setBorderWidth($this->getStateBorderWidth())
                    ->setFontColor($this->getInitialStateFontColor())
            )
            ->setNormalStateStyle(
                (new StateStyleTransfer())
                    ->setBackgroundColor($this->getNormalStateBackgroundColor())
                    ->setBorderColor($this->getNormalStateBorderColor())
                    ->setBorderWidth($this->getStateBorderWidth())
                    ->setFontColor($this->getNormalStateFontColor())
            )
            ->setFinalStateStyle(
                (new StateStyleTransfer())
                    ->setBackgroundColor($this->getFinalBackgroundStateColor())
                    ->setBorderColor($this->getFinalStateBorderColor())
                    ->setBorderWidth($this->getStateBorderWidth())
                    ->setFontColor($this->getFinalStateFontColor())
            )
            ->setFailedStateStyle(
                (new StateStyleTransfer())
                    ->setBackgroundColor($this->getFailedBackgroundStateColor())
                    ->setBorderColor($this->getFailedStateBorderColor())
                    ->setBorderWidth($this->getStateBorderWidth())
                    ->setFontColor($this->getFailedStateFontColor())
            )
            ->setObsoleteStateStyle(
                (new StateStyleTransfer())
                    ->setBackgroundColor($this->getObsoleteBackgroundStateColor())
                    ->setBorderColor($this->getObsoleteStateBorderColor())
                    ->setBorderWidth($this->getStateBorderWidth())
                    ->setFontColor($this->getObsoleteStateFontColor())
            )
            ->setHappyPathStyle(
                (new TransitionStyleTransfer())
                    ->setColor($this->getHappyPathColor())
            );
    }

    private function getInitialStateBackgroundColor(): string
    {
        return $this->get(
            OmsVisualizerConstants::INITIAL_STATE_BACKGROUND_COLOR,
            self::DEFAULT_INITIAL_STATE_BACKGROUND_COLOR
        );
    }

    private function getInitialStateBorderColor(): string
    {
        return $this->get(OmsVisualizerConstants::INITIAL_STATE_BORDER_COLOR, self::DEFAULT_INITIAL_STATE_BORDER_COLOR);
    }

    private function getFinalBackgroundStateColor(): string
    {
        return $this->get(OmsVisualizerConstants::FINAL_STATE_BACKGROUND_COLOR, self::DEFAULT_FINAL_BACKGROUND_COLOR);
    }

    private function getFinalStateBorderColor(): string
    {
        return $this->get(OmsVisualizerConstants::FINAL_STATE_BORDER_COLOR, self::DEFAULT_FINAL_STATE_BORDER_COLOR);
    }

    private function getFinalStateFontColor(): string
    {
        return $this->get(OmsVisualizerConstants::FINAL_STATE_FONT_COLOR, self::DEFAULT_FINAL_STATE_FONT_COLOR);
    }

    private function getFailedBackgroundStateColor(): string
    {
        return $this->get(OmsVisualizerConstants::FAILED_STATE_BACKGROUND_COLOR, self::DEFAULT_FAILED_BACKGROUND_COLOR);
    }

    private function getFailedStateBorderColor(): string
    {
        return $this->get(OmsVisualizerConstants::FAILED_STATE_BORDER_COLOR, self::DEFAULT_FAILED_STATE_BORDER_COLOR);
    }

    private function getFailedStateFontColor(): string
    {
        return $this->get(OmsVisualizerConstants::FAILED_STATE_FONT_COLOR, self::DEFAULT_FAILED_STATE_FONT_COLOR);
    }

    private function getObsoleteBackgroundStateColor(): string
    {
        return $this->get(OmsVisualizerConstants::OBSOLETE_STATE_BACKGROUND_COLOR, self::DEFAULT_OBSOLETE_STATE_BACKGROUND_COLOR);
    }

    private function getObsoleteStateBorderColor(): string
    {
        return $this->get(OmsVisualizerConstants::OBSOLETE_STATE_BORDER_COLOR, self::DEFAULT_OBSOLETE_STATE_BORDER_COLOR);
    }

    private function getObsoleteStateFontColor(): string
    {
        return $this->get(OmsVisualizerConstants::OBSOLETE_STATE_FONT_COLOR, self::DEFAULT_OBSOLETE_STATE_FONT_COLOR);
    }

    private function getStateBorderWidth(): string
    {
        return $this->get(OmsVisualizerConstants::STATE_BORDER_WIDTH, self::DEFAULT_STATE_BORDER_WIDTH);
    }

    private function getHappyPathColor(): string
    {
        return $this->get(OmsVisualizerConstants::HAPPY_PATH_COLOR, self::DEFAULT_HAPPY_PATH_COLOR);
    }

    private function getSubGraphBackgroundColor(): string
    {
        return $this->get(OmsVisualizerConstants::SUB_GRAPH_BACKGROUND_COLOR, self::DEFAULT_SUB_GRAPH_BACKGROUND_COLOR);
    }

    private function getSubGraphBorderColor(): string
    {
        return $this->get(OmsVisualizerConstants::SUB_GRAPH_BORDER_COLOR, self::DEFAULT_SUB_GRAPH_BORDER_COLOR);
    }

    private function getInitialStateFontColor(): string
    {
        return $this->get(OmsVisualizerConstants::INITIAL_STATE_FONT_COLOR, self::DEFAULT_INITIAL_STATE_FONT_COLOR);
    }

    public function getMermaidGlobalConfiguration(): string
    {
        return json_encode($this->get(OmsVisualizerConstants::MERMAID_GLOBAL_CONFIGURATION, self::MERMAID_GLOBAL_CONFIGURATION));
    }

    private function getNormalStateBackgroundColor(): string
    {
        return $this->get(OmsVisualizerConstants::NORMAL_STATE_BACKGROUND_COLOR, self::DEFAULT_NORMAL_STATE_BACKGROUND_COLOR);
    }

    private function getNormalStateBorderColor(): string
    {
        return $this->get(OmsVisualizerConstants::NORMAL_STATE_BORDER_COLOR, self::DEFAULT_NORMAL_STATE_BORDER_COLOR);
    }

    private function getNormalStateFontColor(): string
    {
        return $this->get(OmsVisualizerConstants::NORMAL_STATE_FONT_COLOR, self::DEFAULT_NORMAL_STATE_FONT_COLOR);
    }

    public function getOmsConfigurationDirectory(): string
    {
        return $this->get(OmsVisualizerConstants::OMS_CONFIGURATION_DIRECTORY, self::DEFAULT_OMS_CONFIGURATION_DIRECTORY);
    }

    public function isDebug(): bool
    {
        return $this->get(OmsVisualizerConstants::DEBUG_MODE, self::DEFAULT_DEBUG_MODE);
    }
}
