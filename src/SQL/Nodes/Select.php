<?php

namespace CodingAvenue\Proof\SQL\Nodes;

class Select extends Node
{
    public function findColumn($columnName, array $columnDef)
    {
        $hasColumn = false;

        foreach ($this->nodes as $column) {
            if ($column['name'] == $columnName) {
                $hasColumn = 
                    $this->isDistinct($column, $columnDef['distinct'])
                    && $this->isAggregate($column, $columnDef['aggregate'])
                    && $this->hasFunction($column, $columnDef['functionName'])
                    && $this->hasAlias($column, $columnDef['alias']);
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

    private function hasAlias($column, $alias): bool
    {
        return isset($alias)
            ? isset($column['alias'])
                ? $column['alias'] == $alias
                : false
            : true;
    }

    private function hasFunction($column, $functionName): bool
    {
        return isset($functionName)
            ? isset($column['functionName'])
                ? strtoupper($column['functionName']) == strtoupper($functionName)
                : false
            : true;
    }

    private function isDistinct($column, $distinct): bool
    {
        return isset($distinct)
            ? isset($column['distinct'])
                ? $distinct == $column['distinct']
                : false
            : true;

    }

    private function isAggregate($column, $aggregate): bool
    {
        return isset($aggregate)
            ? isset($column['is_aggregate'])
                ? strtoupper($column['aggregate_function']) == strtoupper($aggregate)
                : false
            : true;
    }
}