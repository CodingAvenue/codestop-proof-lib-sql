<?php

namespace CodingAvenue\Proof\SQL\Rule\Keyword;

use CodingAvenue\Proof\SQL\Rule\Rule;
use CodingAvenue\Proof\SQL\Rule\RuleInterface;

class Update extends Rule implements RuleInterface
{
    const CLASS_ = 'CodingAvenue\Proof\SQL\Nodes\Update';

    public function getRule(): callable
    {   
        $filter = $this->filter;
        $class = self::CLASS_;

        return function($node) use ($filter, $class) {
            return (
                $node instanceof $class
                && (
                    isset($filter['table'])
                        ? $node->getTable() == $filter['table'][0]
                        : true
                )
            );
        };
    }   

    public function allowedOptionalFilter()
    {   
        return array('table');
    }   
}
