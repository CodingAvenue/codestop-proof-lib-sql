<?php

namespace CodingAvenue\Proof\SQL\Nodes;

class Where extends Node
{
    public function getSubNodes(): array
    {
        return $this->nodes;
    }
}