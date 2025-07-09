<?php

namespace Generated\Shared\Transfer;

class TransitionStyleTransfer
{
    private string $color = '';

    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;
        return $this;
    }
}
