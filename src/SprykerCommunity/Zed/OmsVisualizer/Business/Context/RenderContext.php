<?php

declare(strict_types=1);

namespace SprykerCommunity\Zed\OmsVisualizer\Business\Context;

class RenderContext
{
    public array $lines = [];
    public array $nonFinalStates = [];
    public array $transitionStates = [];
    public array $happyPathLineIds = [];
    public array $states = [];

    public function addNonFinalState(string $state): void
    {
        $this->nonFinalStates[] = $state;
    }

    public function addTransitionState(string $state): void
    {
        $this->transitionStates[] = $state;
    }

    public function addState(string $state): void
    {
        $this->states[] = $state;
    }

    public function addHappyPathLineId(string $id): void
    {
        $this->happyPathLineIds[] = $id;
    }

    public function addLine(string $line): void
    {
        $this->lines[] = $line;
    }
}
