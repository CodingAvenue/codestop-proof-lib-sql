<?php

namespace CodingAvenue\Proof\SQL\WhereNodes;

class Const_
{
    public function filter($value, $nodes)
    {
        $value = $value['value'][0];

        $found = [];

        foreach ($nodes as $node) {
            foreach ($node as $subNode) {
                if ($subNode['expr_type'] == 'const' && preg_match('/([\'"]?)' . strtolower($value) . '\1/', strtolower($subNode['base_expr']))) {
                    $found[] = $node;
                    break;
                }
            }
        }

        return $found;
    }
}