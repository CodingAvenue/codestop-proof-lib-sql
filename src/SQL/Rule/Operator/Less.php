<?php

namespace CodingAvenue\Proof\SQL\Rule\Operator;

use CodingAvenue\Proof\SQL\Rule\Rule;
use CodingAvenue\Proof\SQL\Rule\RuleInterface;

class Less extends Rule implements RuleInterface
{
    const CLASS_ = 'CodingAvenue\Proof\SQL\Operators\Less';

    public function getRule(): callable
    {   
        $filter = $this->filter;
        $class = self::CLASS_;

        return function($node) use ($filter, $class) {
            return (
                $node instanceof $class
                && (
                    isset($filter['column'])
                        ? $filter['column'][0] == $node->getLeft()['value']
                        : true
                )
                && (
                    isset($filter['value'])
                        ? strtolower($filter['value'][0]) == strtolower($node->getRight()['value'])
                        : true
                )
            );
        };
    }   

    public function allowedOptionalFilter()
    {   
        return array('column', 'value');
    }   
}
