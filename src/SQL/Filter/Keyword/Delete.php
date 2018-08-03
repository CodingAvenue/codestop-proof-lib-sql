<?php

namespace CodingAvenue\Proof\SQL\Filter\Keyword;

use CodingAvenue\Proof\SQL\Rule\RuleFactory;
use CodingAvenue\Proof\SQL\Filter\Filter;
use CodingAvenue\Proof\SQL\Filter\FilterInterface;

class Delete extends Filter implements FilterInterface
{
    public function getRuleClass()
    {   
        return RuleFactory::createRule('delete', $this->getRuleFilter());
    }   

    public function getRuleFilter()
    {   
        return $this->attributes;
    }   
}
