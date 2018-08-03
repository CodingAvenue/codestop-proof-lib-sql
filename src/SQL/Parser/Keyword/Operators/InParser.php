<?php

namespace CodingAvenue\Proof\SQL\Parser\Keyword\Operators;

use CodingAvenue\Proof\SQL\Operators\In;

class InParser extends ParserOperator
{
    public function parse()
    {
        // Check if the number of elements inside $attribute is more than 3.
        if (count($this->attributes) >= 3) {
            $node = $this->attributes[1];
            $attributes = $this->attributes;

            $types = $this->getTypes();
            if ($node['expr_type'] === 'operator' && strtolower($node['base_expr']) == "in") {
                $left = array(
                    'type'  => $types[$this->attributes[0]['expr_type']],
                    'value' => $this->attributes[0]['base_expr']
                );

                $right = array();

                foreach ($this->attributes[2]['sub_tree'] as $inList) {
                    $right[] = array(
                        'type' => $types[$inList['expr_type']],
                        'value' => preg_replace('/(^[\"\']|[\"\']$)/', '', $inList['base_expr'])
                    );
                }

                array_splice($this->attributes, 0, 3);

                return new In($left, $right);
            }
        } 
            
        return null;
    }
}