<?php

namespace CodingAvenue\Proof\SQL\Rule\Keyword;

use CodingAvenue\Proof\SQL\Rule\Rule;
use CodingAvenue\Proof\SQL\Rule\RuleInterface;

class Table extends Rule implements RuleInterface
{
    const CLASS_ = 'CodingAvenue\Proof\SQL\Nodes\Table';

    public function getRule(): callable
    {   
        $filter = $this->filter;
        $class = self::CLASS_;

        return function($node) use ($filter, $class) {
            return (
                $node instanceof $class
                && (
                    isset($filter['table'])
                        ? $node->getTableName() == $filter['table'][0]
                        : true
                )
                && (
                    isset($filter['primaryKey'])
                        ? $node->hasPrimaryKeyColumn() && $node->getPrimaryKeyColumn() == $filter['primaryKey'][0]
                        : true
                )
                && (
                    isset($filter['column'])
                        ? $node->hasColumnDef(
                            array(
                                'column' => $filter['column'][0],
                                'type' => isset($filter['type']) ? $filter['type'][0] : null,
                                'length' => isset($filter['length']) ? $filter['length'][0] : null
                            )
                        )
                        : true
                            
                )
            );
        };
    }   

    public function allowedOptionalFilter()
    {   
        return array('table', 'primaryKey', 'column', 'type', 'length');
    }   
}
