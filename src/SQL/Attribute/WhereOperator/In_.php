<?php

namespace CodingAvenue\Proof\SQL\Attribute\WhereOperator;

class In_
{
    public function __construct(array $nodes)
    {
        $this->nodes = $nodes;
    }

    public function find(array $filters)
    {
        if ($filters['operator'][0] == 'in') {
            // Let's find the "<" operator first.

            $ctr = 0;
            $found = [];
            while ($ctr < count($this->nodes)) {
                $node = $this->nodes[$ctr];

                if ($node['expr_type'] == 'operator' && $node['base_expr'] == 'IN') {
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