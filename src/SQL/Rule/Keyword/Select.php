<?php

namespace CodingAvenue\Proof\SQL\Rule\Keyword;

use CodingAvenue\Proof\SQL\Rule\Rule;
use CodingAvenue\Proof\SQL\Rule\RuleInterface;

class Select extends Rule implements RuleInterface
{
    const CLASS_ = 'CodingAvenue\Proof\SQL\Nodes\Select';

    public function getRule(): callable
    {   
        $filter = $this->filter;
        $class = self::CLASS_;

        return function($node) use ($filter, $class) {
            return (
                $node instanceof $class
                && (
                    isset($filter['column'])
                        ? $node->findColumn($filter['column'][0], isset($filter['distinct']) ? $filter['distinct'][0] : null)
                        : true
                )
            );
        };
    }   

    public function allowedOptionalFilter()
    {   
        return array('columns', 'column', 'distinct');
    }   
}
