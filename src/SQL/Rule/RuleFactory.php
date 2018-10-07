<?php

namespace CodingAvenue\Proof\SQL\Rule;

class RuleFactory
{
    public static function createRule(string $name, array $filters = array())
    {
        $rules = self::getRules();

        $ruleClass = isset($rules[$name]) ? $rules[$name] : null;

        if (is_null($ruleClass)) {
            throw new \Exception("No Rule class to handle rule {$name}");
        }

        return new $ruleClass($filters);
    }

    public static function getRules()
    {
        return array(
            'select'        => '\CodingAvenue\Proof\SQL\Rule\Keyword\Select',
            'from'          => '\CodingAvenue\Proof\SQL\Rule\Keyword\From',
            'delete'        => '\CodingAvenue\Proof\SQL\Rule\Keyword\Delete',
            'insert'        => '\CodingAvenue\Proof\SQL\Rule\Keyword\Insert',
            'values'        => '\CodingAvenue\Proof\SQL\Rule\Keyword\Values',
            'create'        => '\CodingAvenue\Proof\SQL\Rule\Keyword\Create',
            'table'         => '\CodingAvenue\Proof\SQL\Rule\Keyword\Table',
            'where'         => '\CodingAvenue\Proof\SQL\Rule\Keyword\Where',
            'update'        => '\CodingAvenue\Proof\SQL\Rule\Keyword\Update',
            'set'           => '\CodingAvenue\Proof\SQL\Rule\Keyword\Set',
            'equals'        => '\CodingAvenue\Proof\SQL\Rule\Operator\Equals',
            'greater'       => '\CodingAvenue\Proof\SQL\Rule\Operator\Greater',
            'less'          => '\CodingAvenue\Proof\SQL\Rule\Operator\Less',
            'less-equal'    => '\CodingAvenue\Proof\SQL\Rule\Operator\LessEqual',
            'greater-equal' => '\CodingAvenue\Proof\SQL\Rule\Operator\GreaterEqual',
            'in'            => '\CodingAvenue\Proof\SQL\Rule\Operator\In',
            'is'            => '\CodingAvenue\Proof\SQL\Rule\Operator\Is',
            'is-not'        => '\CodingAvenue\Proof\SQL\Rule\Operator\IsNot',
            'like'          => '\CodingAvenue\Proof\SQL\Rule\Operator\Like',
            'between'       => '\CodingAvenue\Proof\SQL\Rule\Operator\Between',
            'and'           => '\CodingAvenue\Proof\SQL\Rule\Operator\And_',
            'or'            => '\CodingAvenue\Proof\SQL\Rule\Operator\Or_',
            'plus'          => '\CodingAvenue\Proof\SQL\Rule\Operator\Plus_',
            'minus'          => '\CodingAvenue\Proof\SQL\Rule\Operator\Minus_'
        );
    }
}