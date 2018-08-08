<?php

namespace CodingAvenue\Proof\SQL\Nodes;

class Table extends Node
{
    public function getTableName()
    {
        return $this->nodes['name'];
    }

    public function hasPrimaryKey(): bool
    {
        return isset($this->nodes['primaryKey']);
    }

    public function getPrimaryKeyColumn()
    {
        return $this->nodes['primaryKey'];
    }

    public function hasColumnDef(array $columnDef): bool
    {
        $hasColumnDef = false;

        foreach ($this->nodes['columns'] as $column) {
            if ($this->hasColumnName($columnDef, $column)
                && $this->hasDataType($columnDef, $column)
                && $this->hasDataLength($columnDef, $column)) {

                    $hasColumnDef = true;
            }
        }

        return $hasColumnDef;
    }

    private function hasColumnName(array $columnDef, array $column): bool
    {
        return $columnDef['column'] == $column['column'];
    }

    private function hasDataType(array $columnDef, array $column): bool
    {
        return (
            isset($columnDef['type'])
                ? strtolower($columnDef['type']) == strtolower($column['type'])
                : true
        );
    }

    private function hasDataLength(array $columnDef, array $column): bool
    {
        return (
            isset($columnDef['length'])
                ? isset($column['length'])
                    ? $columnDef['length'] == $column['length']
                    : false
                : true
        );
    }

    public function getSubNodes(): array
    {
        return array();
    }
}