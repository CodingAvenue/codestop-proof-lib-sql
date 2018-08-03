<?php

namespace CodingAvenue\Proof\SQL\Nodes;

class From extends Node
{
    public function hasTables(array $tables)
    {
        $hasTables = true;
        foreach ($tables as $table) {
            if (!in_array($table, $this->nodes)) {
                $hasTables = false;
                break;
            }
        }

        return $hasTables;
    }

    public function getSubNodes(): array
    {
        return array();
    }
}