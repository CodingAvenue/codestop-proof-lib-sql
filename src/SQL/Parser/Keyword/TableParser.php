<?php

namespace CodingAvenue\Proof\SQL\Parser\Keyword;

use CodingAvenue\Proof\SQL\Nodes\Table;

class TableParser
{
    public function parse(array $attributes = array())
    {
        $tableName = $attributes['name'];
        $primaryKey = null;
        $columns = [];

        foreach ($attributes['create-def']['sub_tree'] as $def) {
            if ($def['expr_type'] == 'primary-key') {
                $primaryKey = $def['sub_tree'][2]['sub_tree'][0]['base_expr'];
            } else if ($def['expr_type'] == 'column-def') {
                $columns[] = array(
                    'column' => $def['sub_tree'][0]['base_expr'],
                    'type'   => $def['sub_tree'][1]['sub_tree'][0]['base_expr'],
                    'length' => isset($def['sub_tree'][1]['sub_tree'][0]['length']) ? $def['sub_tree'][1]['sub_tree'][0]['length'] : null,
                    'nullable' => $def['sub_tree'][1]['nullable'],
                    'unique' => $def['sub_tree'][1]['unique'],
                    'default' => $def['sub_tree'][1]['default']
                );

                if ($def['sub_tree'][1]['primary'] == 1) {
                    $primaryKey = $def['sub_tree'][0]['base_expr'];
                }
            } else if ($def['expr_type'] == 'foreign-key') {
                foreach ($def['sub_tree'] as $foreignTree) {
                    if ($foreignTree['expr_type'] == 'constraint') {
                        $constraintName = $foreignTree['sub_tree']['base_expr'];
                    } else if ($foreignTree['expr_type'] == 'column-list') {
                        $columnRef = $foreignTree['sub_tree'][0]['base_expr'];
                    } else if ($foreignTree['expr_type'] == 'foreign-ref') {
                        foreach ($foreignTree['sub_tree'] as $foreignMeta) {
                            if ($foreignMeta['expr_type'] == 'table') {
                                $tableRef = $foreignMeta['table'];
                            } else if ($foreignMeta['expr_type'] == 'column-list') {
                                $tableColumnRef = $foreignMeta['sub_tree'][0]['base_expr'];
                            } 
                        }

                        if (isset($foreignTree['on_delete'])) {
                            $foreignRules = [ 'DELETE' => $foreignTree['on_delete'] ];
                        } else if (isset($foreignTree['on_update'])) {
                            $foreignRules = [ 'UPDATE' => $foreignTree['on_update'] ];
                        }
                    }
                }

                $references[] = [
                    'name'              => $constraintName,
                    'column'            => $columnRef,
                    'table-ref'         => $tableRef,
                    'table-column-ref'  => $tableColumnRef,
                    'rules'             => $foreignRules
                ];
            }
        }

        return new Table(array(
            'name' => $tableName,
            'primaryKey' => $primaryKey,
            'columns' => $columns,
            'references' => $references
        ));
    }
}