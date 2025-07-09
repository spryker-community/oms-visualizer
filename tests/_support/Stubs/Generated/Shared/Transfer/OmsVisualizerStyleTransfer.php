<?php

namespace Generated\Shared\Transfer;

class OmsVisualizerStyleTransfer
{
    private ?StateStyleTransfer $subGraphStyle = null;
    private ?TransitionStyleTransfer $happyPathStyle = null;

    public function getSubGraphStyle(): StateStyleTransfer
    {
        return $this->subGraphStyle ?? new StateStyleTransfer();
    }

    public function getHappyPathStyle(): TransitionStyleTransfer
    {
        return $this->happyPathStyle ?? new TransitionStyleTransfer();
    }

    public function setSubGraphStyle(StateStyleTransfer $stateStyleTransfer): self
    {
        $this->subGraphStyle = $stateStyleTransfer;
        return $this;
    }

    public function setHappyPathStyle(TransitionStyleTransfer $transitionStyleTransfer): self
    {
        $this->happyPathStyle = $transitionStyleTransfer;
        return $this;
    }

    public function setInitialStateStyle(StateStyleTransfer $stateStyleTransfer): self
    {
        return $this;
    }

    public function setNormalStateStyle(StateStyleTransfer $stateStyleTransfer): self
    {
        return $this;
    }

    public function setFinalStateStyle(StateStyleTransfer $stateStyleTransfer): self
    {
        return $this;
    }

    public function setFailedStateStyle(StateStyleTransfer $stateStyleTransfer): self
    {
        return $this;
    }

    public function setObsoleteStateStyle(StateStyleTransfer $stateStyleTransfer): self
    {
        return $this;
    }
}
