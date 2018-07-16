<?php

namespace CodingAvenue\Proof\SQL\Attribute\WhereOperator;

class IsNot
{
    public function __construct(array $nodes)
    {
        $this->nodes = $nodes;
    }

    public function find(array $filters)
    {
        if ($filters['operator'][0] == 'is-not') {
            // Let's find the "<" operator first.

            $ctr = 0;
            $found = [];
            while ($ctr < count($this->nodes)) {
                $node = $this->nodes[$ctr];
                $notNode = $this->nodes[$ctr + 1];

                if ($node['expr_type'] == 'operator' && $node['base_expr'] == 'IS' && $notNode['expr_type'] == 'operator' && $notNode['base_expr'] == 'NOT') {
                    $column = $this->nodes[$ctr - 1];
                    $isOperator = $this->nodes[$ctr];
                    $notOperator = $this->nodes[$ctr + 1];
                    $value = $this->nodes[$ctr + 2];

                    $found[] = array($column, $isOperator, $notOperator, $value);
                }

                $ctr++;
            }

            return $found;
        }
    }
}