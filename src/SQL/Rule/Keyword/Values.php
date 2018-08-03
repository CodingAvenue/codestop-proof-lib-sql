<?php

namespace CodingAvenue\Proof\SQL\Rule\Keyword;

use CodingAvenue\Proof\SQL\Rule\Rule;
use CodingAvenue\Proof\SQL\Rule\RuleInterface;

class Values extends Rule implements RuleInterface
{
    const CLASS_ = 'CodingAvenue\Proof\SQL\Nodes\Values';

    public function getRule(): callable
    {   
        $class = self::CLASS_;
        $filter = $this->filter;

        return function($node) use ($filter, $class) {
            return (
                $node instanceof $class
                && (
                    isset($filter['data'])
                        ? $node->hasData($filter['data'][0])
                        : true
                )
            );
        };
    }   

    public function allowedOptionalFilter()
    {   
        return array('data');
    }   
}
