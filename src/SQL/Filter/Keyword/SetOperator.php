<?php

namespace CodingAvenue\Proof\SQL\Filter\Keyword;

use CodingAvenue\Proof\SQL\Rule\RuleFactory;
use CodingAvenue\Proof\SQL\Filter\Filter;
use CodingAvenue\Proof\SQL\Filter\FilterInterface;

class SetOperator extends Set implements FilterInterface
{
    public function getRuleClass()
    {
        return $this->findRuleClass();
    }   
}
