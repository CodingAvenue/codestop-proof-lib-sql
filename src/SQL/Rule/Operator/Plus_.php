<?php

namespace CodingAvenue\Proof\SQL\Rule\Operator;

use CodingAvenue\Proof\SQL\Rule\Rule;
use CodingAvenue\Proof\SQL\Rule\RuleInterface;

class Plus_ extends Rule implements RuleInterface
{
    const CLASS_ = 'CodingAvenue\Proof\SQL\Operators\Plus_';

    public function getRule(): callable
    {   
        $filter = $this->filter;
        $class = self::CLASS_;

        return function($node) use ($filter, $class) {
            return (
                $node instanceof $class
                && (
                    isset($filter['left'])
                        ? $filter['left'][0] == $node->getLeft()['value']
                        : true
                )
                && (
                    isset($filter['right'])
                        ? strtolower($filter['right'][0]) == strtolower($node->getRight()['value'])
                        : true
                )
            );
        };
    }   

    public function allowedOptionalFilter()
    {   
        return array('left', 'right');
    }   
}
