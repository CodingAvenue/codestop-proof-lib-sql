<?php

namespace CodingAvenue\Proof\SQL\Filter\Keyword;

use CodingAvenue\Proof\SQL\Rule\RuleFactory;
use CodingAvenue\Proof\SQL\Filter\Filter;
use CodingAvenue\Proof\SQL\Filter\FilterInterface;

class Where extends Filter implements FilterInterface
{
    public function getRuleClass()
    {
        if (count($this->attributes) > 0) {
            return $this->findRuleClass();
        } else {
            return RuleFactory::createRule('where', $this->getRuleFilter());
        }
    }   

    public function getRuleFilter()
    {   
        return $this->attributes;
    }

    public function findRuleClass()
    {
        $operator = isset($this->attributes['operator'][0]) ? $this->attributes['operator'][0] : null;
        if (is_null($operator)) {
            throw new \Exception("Requires an operator attribute");
        }

        $attributes = $this->attributes;
        unset($attributes['operator']);

        $operatorRuleNames = $this->getOperatorRuleNames();

        if (!isset($operatorRuleNames[$operator])) {
            throw new \Exception("No Rule class to handle this operator {$operator}");
        }

        return RuleFactory::createRule($operatorRuleNames[$operator], $attributes);
    }

    public function getOperatorRuleNames()
    {
        return array(
            '=' => 'equals',
            '>' => 'greater',
            '>=' => 'greater-equal',
            '<' => 'less',
            '<=' => 'less-equal',
            'in' => 'in',
            'is' => 'is',
            'is-not' => 'is-not',
            'like'  => 'like',
            'and' => 'and',
            'or'  => 'or',
            'between' => 'between',
            '+' => 'plus',
            '-' => 'minus'
        );
    }
}
