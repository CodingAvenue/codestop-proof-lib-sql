<?php

namespace CodingAvenue\Proof\SQL\Parser\Keyword\Operators;

use CodingAvenue\Proof\SQL\Operators\Less;

class LessParser extends ParserOperator
{
    public function parse()
    {
        // Check if the number of elements inside $attribute is more than 3.
        if (count($this->attributes) >= 3) {
            $node = $this->attributes[1];
            $attributes = $this->attributes;

            $types = $this->getTypes();
            if ($node['expr_type'] === 'operator' && $node['base_expr'] == "<") {
                $left = array(
                    'type'  => $types[$this->attributes[0]['expr_type']],
                    'value' => $this->attributes[0]['base_expr']
                );

                $right = array(
                    'type' => $types[$this->attributes[2]['expr_type']],
                    'value' => preg_replace('/(^[\"\']|[\"\']$)/', '', $this->attributes[2]['base_expr'])
                );

                array_splice($this->attributes, 0, 3);

                return new Less($left, $right);
            }
        } 
            
        return null;
    }
}