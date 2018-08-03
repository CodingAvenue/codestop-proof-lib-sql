<?php

namespace CodingAvenue\Proof\SQL\Nodes;

class Values extends Node
{
    public function hasData(string $data)
    {
        $hasData = false;

        foreach ($this->nodes as $node) {
            foreach ($node as $insertData) {
                if ($data == $insertData) {
                    $hasData = true;
                    break 2;
                }
            }
        }

        return $hasData;
    }

    public function getSubNodes(): array
    {
        return array();
    }
}