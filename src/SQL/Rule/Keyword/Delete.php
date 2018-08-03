<?php

namespace CodingAvenue\Proof\SQL\Rule\Keyword;

use CodingAvenue\Proof\SQL\Rule\Rule;
use CodingAvenue\Proof\SQL\Rule\RuleInterface;

class Delete extends Rule implements RuleInterface
{
    const CLASS_ = 'CodingAvenue\Proof\SQL\Nodes\Delete';

    public function getRule(): callable
    {   
        $class = self::CLASS_;

        return function($node) use ($class) {
            return (
                $node instanceof $class
            );
        };
    }   

    public function allowedOptionalFilter()
    {   
        return array();
    }   
}
