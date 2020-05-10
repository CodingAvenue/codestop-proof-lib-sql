<?php

namespace CodingAvenue\Proof\SQL\Nodes;

class Select extends Node
{
    public function findColumn($columnName, $distinct)
    {
        $hasColumn = false;

        foreach ($this->nodes as $column) {
            if ($column['name'] == $columnName) {
                $hasColumn = isset($distinct)
                    ? isset($column['distinct'])
                        ? $distinct == $column['distinct']
                        : false
                    : true;
            }
        }

        return $hasColumn;
    }

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