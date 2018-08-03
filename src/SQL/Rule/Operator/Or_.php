<?php

namespace CodingAvenue\Proof\SQL\Rule\Operator;

use CodingAvenue\Proof\SQL\Rule\Rule;
use CodingAvenue\Proof\SQL\Rule\RuleInterface;

class Or_ extends Rule implements RuleInterface
{
    const CLASS_ = 'CodingAvenue\Proof\SQL\Operators\Or_';

    public function getRule(): callable
    {   
        $filter = $this->filter;
        $class = self::CLASS_;

        return function($node) use ($filter, $class) {
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
