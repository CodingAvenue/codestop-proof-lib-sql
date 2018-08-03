<?php

namespace CodingAvenue\Proof\SQL\Rule\Keyword;

use CodingAvenue\Proof\SQL\Rule\Rule;
use CodingAvenue\Proof\SQL\Rule\RuleInterface;

class Insert extends Rule implements RuleInterface
{
    const CLASS_ = 'CodingAvenue\Proof\SQL\Nodes\Insert';

    public function getRule(): callable
    {   
        $filter = $this->filter;
        $class = self::CLASS_;

        return function($node) use ($filter, $class) {
            return (
                $node instanceof $class
                && (
                    isset($filter['table'])
                        ? $node->hasTable($filter['table'][0])
                        : true
                )
                && (
                    isset($filter['column'])
                        ? $node->hasColumn($filter['column'][0])
                        : true
                )
            );
        };
    }   

    public function allowedOptionalFilter()
    {   
        return array('table', 'column');
    }   
}
