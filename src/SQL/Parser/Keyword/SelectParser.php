<?php

namespace CodingAvenue\Proof\SQL\Parser\Keyword;

use CodingAvenue\Proof\SQL\Nodes\Select;

class SelectParser
{
    public function parse(array $attributes = array())
    {
        $columns = array();
        $hasReserved = false;
        for ($i = 0; $i < count($attributes); $i++) {
            $attribute = $attributes[$i];

            if ($attribute['expr_type'] == 'reserved' && strtoupper($attribute['base_expr']) == 'DISTINCT') {
                $i++;
                $columns[] = [
                    'name' => $attributes[$i]['base_expr'],
                    'distinct' => 1
                ];
            } else {
                $columns[] = [
                    'name' => $attribute['base_expr']
                ];
            }
        }

        return new Select($columns);
    }
}