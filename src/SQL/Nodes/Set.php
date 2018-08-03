<?php

namespace CodingAvenue\Proof\SQL\Nodes;

class Set extends Node
{
    public function getSubNodes(): array
    {
        return $this->nodes;
    }
}