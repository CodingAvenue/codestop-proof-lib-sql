<?php

namespace CodingAvenue\Proof\SQL\Attribute;

use CodingAvenue\Proof\SQL\Attribute\WhereOperator\OperatorFactory;
use CodingAvenue\Proof\SQL\WhereNodes\WhereNodes;

class Where_
{
    public function __construct(array $nodes)
    {
        $this->nodes = $nodes;
    }

    /**
     * $attributes param is an array with key columns, operator and
     */
    public function find(array $filter)
    {
        //$less = new Less($this->nodes);
        //$less->find($attributes);

        $operatorClass = OperatorFactory::getOperator($filter['operator'][0]);

        $operator = new $operatorClass($this->nodes);
        $filterNodes = $operator->find($filter);
        return new WhereNodes($filterNodes);
    }

    public function knownAttributes()
    {
        return array('operator');
    }
}