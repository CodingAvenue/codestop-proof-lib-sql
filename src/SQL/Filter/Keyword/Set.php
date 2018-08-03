<?php

namespace CodingAvenue\Proof\SQL\Filter\Keyword;

use CodingAvenue\Proof\SQL\Rule\RuleFactory;
use CodingAvenue\Proof\SQL\Filter\Filter;
use CodingAvenue\Proof\SQL\Filter\FilterInterface;

class Set extends Where implements FilterInterface
{
    public function getRuleClass()
    {   
        if (count($this->attributes) > 0) {
            return $this->findRuleClass();
        } else {
            return RuleFactory::createRule('set', $this->getRuleFilter());
        }    }   

    public function getRuleFilter()
    {   
        return $this->attributes;
    }   
}
