<?php

namespace CodingAvenue\Proof\SQL\Nodes;

class Select extends Node
{
    public function hasColumns(array $columns)
    {
        $hasColumn = true;
        foreach ($columns as $column) {
            if (!in_array($column, $this->nodes)) {
                $hasColumn = false;
                break;
            }
        }

        return $hasColumn;
    }

    public function getSubNodes(): array
    {
        return array();
    }
}