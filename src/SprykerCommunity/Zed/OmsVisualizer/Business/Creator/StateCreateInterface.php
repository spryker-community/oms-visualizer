<?php

namespace SprykerCommunity\Zed\OmsVisualizer\Business\Creator;

interface StateCreateInterface
{
    public function createStateByType(string $stateName, string $stateType): string;
}
