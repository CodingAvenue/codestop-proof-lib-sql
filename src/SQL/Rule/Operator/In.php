<?php

namespace CodingAvenue\Proof\SQL\Rule\Operator;

use CodingAvenue\Proof\SQL\Rule\Rule;
use CodingAvenue\Proof\SQL\Rule\RuleInterface;

class In extends Rule implements RuleInterface
{
    const CLASS_ = 'CodingAvenue\Proof\SQL\Operators\In';

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
                        ? in_array(strtolower($filter['value'][0]), array_map(function($ele) {
                            return strtolower($ele['value']);
                        }, $node->getRight()))
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
