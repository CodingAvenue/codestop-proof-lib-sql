<?php

namespace CodingAvenue\Proof\SQL\Parser\Keyword\Operators;

use CodingAvenue\Proof\SQL\Operators\And_;

class AndParser extends ParserOperator
{
    public function parse()
    {       
        $node = $this->attributes[0];

        if ($node['expr_type'] === 'operator' && strtolower($node['base_expr']) == 'and') {
            array_splice($this->attributes, 0, 1);

            return new And_();
        }
            
        return null;
    }
}