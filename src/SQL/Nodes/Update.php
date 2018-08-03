<?php

namespace CodingAvenue\Proof\SQL\Nodes;

class Update extends Node
{
    public function getTable()
    {
        return $this->nodes['table'];
    }

    public function getSubNodes(): array
    {
        return array();
    }
}