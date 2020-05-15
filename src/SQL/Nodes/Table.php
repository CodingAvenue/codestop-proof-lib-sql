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
                && $this->hasDataLength($columnDef, $column)
                && $this->hasDefaultValue($columnDef, $column)
                && $this->isNullable($columnDef, $column)
                && $this->isUnique($columnDef, $column)) {

                    $hasColumnDef = true;
            }
        }

        return $hasColumnDef;
    }

    public function hasReferenceDef(array $referenceDef): bool
    {
        $hasReferenceDef = false;

        foreach ($this->nodes['references'] as $reference) {
            if ($reference['name'] == $referenceDef['name']
                && $this->hasReferenceColumn($referenceDef, $reference)
                && $this->hasReferenceTable($referenceDef, $reference)
                && $this->hasReferenceTableColumn($referenceDef, $reference)
                && $this->hasReferenceDeleteRule($referenceDef, $reference)
                && $this->hasReferenceUpdateRule($referenceDef, $reference)) {

                    $hasReferenceDef = true;
                }
        }

        return $hasReferenceDef;
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

    private function hasDefaultValue(array $columnDef, array $column): bool
    {
        return (
            isset($columnDef['default'])
                ? isset($column['default'])
                    ? $columnDef['default'] == $column['default']
                    : false
                : true
        );
    }

    private function isNullable(array $columnDef, array $column): bool
    {
        return (
            isset($columnDef['nullable'])
                ? $column['nullable']
                    ? $columnDef['nullable']
                    : !$columnDef['nullable']
                : true
        );
    }

    private function isUnique(array $columnDef, array $column): bool
    {
        return (
            isset($columnDef['unique'])
                ? $column['unique']
                    ? $columnDef['unique']
                    : !$columnDef['unique']
                : true
        );
    }

    private function hasReferenceColumn(array $referenceDef, array $reference): bool
    {
        return (
            isset($referenceDef['column'])
                ? isset($reference['column'])
                    ? $referenceDef['column'] == $reference['column']
                    : false
                : true
        );
    }

    private function hasReferenceTable(array $referenceDef, array $reference): bool
    {
        return (
            isset($referenceDef['table-ref'])
                ? isset($reference['table-ref'])
                    ? $referenceDef['table-ref'] == $reference['table-ref']
                    : false
                : true
        );
    }

    private function hasReferenceTableColumn(array $referenceDef, array $reference): bool
    {
        return (
            isset($referenceDef['table-column-ref'])
                ? isset($reference['table-column-ref'])
                    ? $referenceDef['table-column-ref'] == $reference['table-column-ref']
                    : false
                : true
        );
    }

    private function hasReferenceDeleteRule(array $referenceDef, array $reference): bool
    {
        return (
            isset($referenceDef['delete-rule'])
                ? isset($reference['rules']['DELETE'])
                    ? strtoupper($referenceDef['delete-rule']) == strtoupper($reference['rules']['DELETE'])
                    : false
                : true
        );
    }

    private function hasReferenceUpdateRule(array $referenceDef, array $reference): bool
    {
        return (
            isset($referenceDef['update-rule'])
                ? isset($reference['rules']['UPDATE'])
                    ? strtoupper($referenceDef['update-rule']) == strtoupper($reference['rules']['UPDATE'])
                    : false
                : true
        );
    }

    public function getSubNodes(): array
    {
        return array();
    }
}