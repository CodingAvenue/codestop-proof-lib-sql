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
                        ? $node->hasPrimaryKey() && $node->getPrimaryKeyColumn() == $filter['primaryKey'][0]
                        : true
                )
                && (
                    isset($filter['column'])
                        ? $node->hasColumnDef(
                            array(
                                'column' => $filter['column'][0],
                                'type' => isset($filter['type']) ? $filter['type'][0] : null,
                                'length' => isset($filter['length']) ? $filter['length'][0] : null,
                                'default' => isset($filter['default']) ? $filter['default'][0]: null
                            )
                        )
                        : true
                            
                )
                && (
                    isset($filter['reference'])
                        ? $node->hasReferenceDef(
                            array(
                                'name' => $filter['reference'][0],
                                'column' => isset($filter['constraintColumn']) ? $filter['constraintColumn'][0] : null,
                                'table-ref' => isset($filter['constraintTableRef']) ? $filter['constraintTableRef'][0] : null,
                                'table-column-ref' => isset($filter['constraintTableColumnRef']) ? $filter['constraintTableColumnRef'][0] : null,
                                'delete-rule' => isset($filter['constraintDeleteRule']) ? $filter['constraintDeleteRule'][0] : null,
                                'update-rule' => isset($filter['constraintUpdateRule']) ? $filter['constraintUpdateRule'][0] : null
                            )
                        )
                        : true
                )
            );
        };
    }   

    public function allowedOptionalFilter()
    {   
        return array('table', 'primaryKey', 'column', 'type', 'length', 'nullable', 'unique', 'default', 'reference', 'constraintColumn', 'constraintTableRef', 'constraintTableColumnRef', 'constraintDeleteRule', 'constraintUpdateRule');
    }   
}
