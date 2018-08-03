<?php

namespace CodingAvenue\Proof\SQL\Parser\Keyword;

use CodingAvenue\Proof\SQL\Nodes\Insert;

class InsertParser
{
    public function parse(array $attributes = array())
    {
        $table = $attributes[1]['table'];
        $columns = [];

        if (isset($attributes[2])) {
            foreach ($attributes[2]['sub_tree'] as $column) {
                $columns[] = $column['base_expr'];
            }
        }

        return new Insert(array('table' => $table, 'columns' => $columns));
    }
}