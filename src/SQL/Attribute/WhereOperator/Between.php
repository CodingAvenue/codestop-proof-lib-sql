<?php

namespace CodingAvenue\Proof\SQL\Attribute\WhereOperator;

class Between
{
    public function __construct(array $nodes)
    {
        $this->nodes = $nodes;
    }

    public function find(array $filters)
    {
        if ($filters['operator'][0] == 'between') {
            // Let's find the "<" operator first.

            $ctr = 0;
            $found = [];
            while ($ctr < count($this->nodes)) {
                $node = $this->nodes[$ctr];

                if ($node['expr_type'] == 'operator' && strtolower($node['base_expr']) == 'between') {
                    $column = $this->nodes[$ctr - 1];
                    $between = $this->nodes[$ctr];
                    $start = $this->nodes[$ctr + 1];
                    $and = $this->nodes[$ctr + 2];
                    $end = $this->nodes[$ctr + 3];

                    $found[] = array($column, $between, $start, $and ,$end);
                }

                $ctr++;
            }

            return $found;
        }
    }
}