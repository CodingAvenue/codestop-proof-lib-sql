<?php

namespace CodingAvenue\Proof\SQL\Parser\Keyword\Operators;

use CodingAvenue\Proof\SQL\Operators\Or_;

class OrParser extends ParserOperator
{
    public function parse()
    {       
        $node = $this->attributes[0];

        if ($node['expr_type'] === 'operator' && strtolower($node['base_expr']) == 'or') {
            array_splice($this->attributes, 0, 1);

            return new Or_();
        }
            
        return null;
    }
}