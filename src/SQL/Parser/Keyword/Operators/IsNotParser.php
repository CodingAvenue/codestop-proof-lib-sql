<?php

namespace CodingAvenue\Proof\SQL\Parser\Keyword\Operators;

use CodingAvenue\Proof\SQL\Operators\IsNot;

class IsNotParser extends ParserOperator
{
    public function parse()
    {
        // Check if the number of elements inside $attribute is more than 3.
        if (count($this->attributes) >= 3) {
            $node = $this->attributes[1];
            $not = $this->attributes[2];
            $attributes = $this->attributes;

            $types = $this->getTypes();
            if ($node['expr_type'] === 'operator' && strtolower($node['base_expr']) == "is"
                && $not['expr_type'] === 'operator' && strtolower($not['base_expr']) == "not") {
                $left = array(
                    'type'  => $types[$this->attributes[0]['expr_type']],
                    'value' => $this->attributes[0]['base_expr']
                );

                $right = array(
                    'type' => $types[$this->attributes[3]['expr_type']],
                    'value' => preg_replace('/(^[\"\']|[\"\']$)/', '', $this->attributes[3]['base_expr'])
                );

                array_splice($this->attributes, 0, 4);

                return new IsNot($left, $right);
            }
        } 
            
        return null;
    }
}