<?php

namespace CodingAvenue\Proof\SQL\WhereNodes;

class Column
{
    public function filter($value, $nodes)
    {
        $value = $value['value'][0];
        $found = [];

        foreach ($nodes as $node) {
            foreach ($node as $subNode) {
                if ($subNode['expr_type'] == 'colref' && $subNode['base_expr'] == $value) {
                    $found[] = $node;
                    break;
                }
            }
        }

        return $found;
    }
}