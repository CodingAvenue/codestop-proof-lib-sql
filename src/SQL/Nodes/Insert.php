<?php

namespace CodingAvenue\Proof\SQL\Nodes;

class Insert extends Node
{
    public function hasTable(string $table)
    {
        return $this->nodes['table'] == $table;
    }

    public function hasColumn(string $column)
    {
        return in_array($column, $this->nodes['columns']);
    }

    public function getSubNodes(): array
    {
        return array();
    }
}