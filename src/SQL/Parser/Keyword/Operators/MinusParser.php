<?php

namespace CodingAvenue\Proof\SQL\Parser\Keyword\Operators;

use CodingAvenue\Proof\SQL\Operators\Minus_;

class MinusParser extends ParserOperator
{
    public function parse()
    {       
        $node = $this->attributes[0];

        if ($node['expr_type'] === 'operator' && strtolower($node['base_expr']) == '-') {
            $types = $this->getTypes();

            $minus = new Minus_();
            $right = array(
                'type' => $types[$this->attributes[1]['expr_type']],
                'value' => preg_replace('/(^[\"\']|[\"\']$)/', '', $this->attributes[1]['base_expr'])
            );
            
            $minus->setRight($right);

            array_splice($this->attributes, 0, 2);

            return $minus;
        }
            
        return null;
    }
}