<?php

namespace CodingAvenue\Proof\SQL\Nodes;

abstract class Node
{
    public $nodes;

    public function __construct(array $nodes)
    {
        $this->nodes = $nodes;
    }

    abstract function getSubNodes(): array;
}