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
                    'length' => isset($def['sub_tree'][1]['sub_tree'][0]['length']) ? $def['sub_tree'][1]['sub_tree'][0]['length'] : null
                );
            }
        }

        return new Table(array(
            'name' => $tableName,
            'primaryKey' => $primaryKey,
            'columns' => $columns
        ));
    }
}