<?php

namespace CodingAvenue\Proof\SQL\WhereNodes;

class Range
{
    public function filter($value, $nodes)
    {
        $start = $value['start'][0];
        $end = $value['end'][0];
        $found = [];

        foreach ($nodes as $node) {
            if (array_key_exists(2, $node) && array_key_exists(4, $node)) {

                if (preg_match('/([\'"]?)' . strtolower($start) . '\1/', strtolower($node[2]['base_expr']))
                && preg_match('/([\'"]?)' . strtolower($end) . '\1/', strtolower($node[4]['base_expr']))) {
                    $found[] = $node;
                    break;
                }
            }
        }

        return $found;
    }
}