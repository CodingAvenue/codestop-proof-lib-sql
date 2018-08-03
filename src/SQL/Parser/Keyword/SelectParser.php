<?php

namespace CodingAvenue\Proof\SQL\Parser\Keyword;

use CodingAvenue\Proof\SQL\Nodes\Select;

class SelectParser
{
    public function parse(array $attributes = array())
    {
        $columns = array();
        foreach ($attributes as $attribute) {
            $columns[] = $attribute['base_expr'];
        }

        return new Select($columns);
    }
}