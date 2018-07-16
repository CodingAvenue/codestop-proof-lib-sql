<?php

namespace CodingAvenue\Proof\SQL\Attribute\WhereOperator;

class OperatorFactory
{
    public static function getOperator(string $operator)
    {
        $operators = self::operators();

        return $operators[$operator];
    }

    public static function operators()
    {
        return array(
            '<'     => '\CodingAvenue\Proof\SQL\Attribute\WhereOperator\Less',
            '>'     => '\CodingAvenue\Proof\SQL\Attribute\WhereOperator\Greater',
            '='     => '\CodingAvenue\Proof\SQL\Attribute\WhereOperator\Equals',
            '<='    => '\CodingAvenue\Proof\SQL\Attribute\WhereOperator\LessEqual',
            '>='    => '\CodingAvenue\Proof\SQL\Attribute\WhereOperator\GreaterEqual',
            'is'    => '\CodingAvenue\Proof\SQL\Attribute\WhereOperator\Is_',
            'is-not' => '\CodingAvenue\Proof\SQL\Attribute\WhereOperator\IsNot',
            'in'    => '\CodingAvenue\Proof\SQL\Attribute\WhereOperator\In_',
            'between' => '\CodingAvenue\Proof\SQL\Attribute\WhereOperator\Between'
        );
    }



    public function __construct(array $nodes)
    {
        $this->nodes = $nodes;
    }

    public function find(array $filters)
    {
        if ($filters['operator'][0] == 'is') {
            // Let's find the "<" operator first.

            $ctr = 0;
            $found = [];
            while ($ctr < count($this->nodes)) {
                $node = $this->nodes[$ctr];

                if ($node['expr_type'] == 'operator' && $node['base_expr'] == 'IS') {
                    $column = $this->nodes[$ctr - 1];
                    $operator = $this->nodes[$ctr];
                    $value = $this->nodes[$ctr + 1];

                    $found[] = array($column, $operator, $value);
                }

                $ctr++;
            }

            return $found;
        }
    }
}