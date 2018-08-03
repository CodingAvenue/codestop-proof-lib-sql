<?php

namespace CodingAvenue\Proof\SQL\Rule\Operator;

use CodingAvenue\Proof\SQL\Rule\Rule;
use CodingAvenue\Proof\SQL\Rule\RuleInterface;

class Between extends Rule implements RuleInterface
{
    const CLASS_ = 'CodingAvenue\Proof\SQL\Operators\Between';

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
                    isset($filter['start'])
                        ? strtolower($filter['start'][0]) == strtolower($node->getStart()['value'])
                        : true
                )
                && (
                    isset($filter['end'])
                        ? strtolower($filter['end'][0] == strtolower($node->getEnd()['value']))
                        : true
                )
            );
        };
    }   

    public function allowedOptionalFilter()
    {   
        return array('column', 'start', 'end');
    }   
}
