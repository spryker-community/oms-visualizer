<?php

namespace SLarisch\Zed\OmsVisualizer\Communication\Controller;

use SLarisch\Zed\OmsVisualizer\Business\OmsVisualizerFacadeInterface;
use SLarisch\Zed\OmsVisualizer\Communication\OmsVisualizerCommunicationFactory;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method OmsVisualizerFacadeInterface getFacade()
 * @method OmsVisualizerCommunicationFactory getFactory()
 */
class ViewController extends AbstractController
{
    public function indexAction(Request $request): array|RedirectResponse
    {
        /** @var string|null $processName */
        $processName = $request->query->get('process');
        if ($processName === null) {
            return $this->redirectResponse('/oms');
        }

        $config = $this->getFactory()->getConfig();

        $globalConfiguration = $config->getMermaidGlobalConfiguration();
        $defaultStyles = $config->getDefaultStyleConfig();

        $flowChartLines = $this->getFacade()->createFlowChart($processName);

        $flatten = $this->flatten($flowChartLines);

        $omsVisualizerFlowChart = implode("\n", $flatten);

        return $this->viewResponse([
            'omsVisualizerFlowChart' => $omsVisualizerFlowChart,
            'omsVisualizerConfig' => $globalConfiguration,
            'defaultStyles' => $defaultStyles,
            'debug' => $config->isDebug()
        ]);
    }

    public function flatten(array $array): array
    {
        $result = [];
        foreach ($array as $item) {
            if (is_array($item)) {
                $result = array_merge($result, $this->flatten($item));
            } else {
                $result[] = $item;
            }
        }
        return $result;
    }
}
