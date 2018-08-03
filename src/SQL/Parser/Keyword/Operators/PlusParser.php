<?php

namespace CodingAvenue\Proof\SQL\Parser\Keyword\Operators;

use CodingAvenue\Proof\SQL\Operators\Plus_;

class PlusParser extends ParserOperator
{
    public function parse()
    {       
        $node = $this->attributes[0];

        if ($node['expr_type'] === 'operator' && strtolower($node['base_expr']) == '+') {
            $types = $this->getTypes();

            $plus = new Plus_();
            $right = array(
                'type' => $types[$this->attributes[1]['expr_type']],
                'value' => preg_replace('/(^[\"\']|[\"\']$)/', '', $this->attributes[1]['base_expr'])
            );
            
            $plus->setRight($right);

            array_splice($this->attributes, 0, 2);

            return $plus;
        }
            
        return null;
    }
}