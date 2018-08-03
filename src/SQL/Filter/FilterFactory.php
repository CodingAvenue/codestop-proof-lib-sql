<?php

namespace CodingAvenue\Proof\SQL\Filter;

/**
 * Factory class for SQL Filter classes
 * maps a filter name to a filter class, if exists
 * Returns the instance of the filter class
 * Throws an error if no filter found
 */

class FilterFactory
{
    public static function createFilter(string $name, array $attributes = array())
    {   
        $filters = self::getFilters();

        $filter = isset($filters[$name]) ? $filters[$name] : null;

        if (is_null($filter)) {
            throw new \Exception ("No Filter class found to handle {$name}");
        }

        return new $filter($name, $attributes);
    }   

    public static function getFilters()
    {   
        return array(
            'SELECT' => '\CodingAvenue\Proof\SQL\Filter\Keyword\Select',
            'FROM' => '\CodingAvenue\Proof\SQL\Filter\Keyword\From',
            'WHERE' => '\CodingAvenue\Proof\SQL\Filter\Keyword\Where',
            'WHERE-OPERATOR' => '\CodingAvenue\Proof\SQL\Filter\Keyword\WhereOperator',
            'DELETE' => '\CodingAvenue\Proof\SQL\Filter\Keyword\Delete',
            'VALUES' => '\CodingAvenue\Proof\SQL\Filter\Keyword\Values',
            'INSERT' => '\CodingAvenue\Proof\SQL\Filter\Keyword\Insert',
            'CREATE' => '\CodingAvenue\Proof\SQL\Filter\Keyword\Create',
            'TABLE'  => '\CodingAvenue\Proof\SQL\Filter\Keyword\Table',
            'UPDATE' => '\CodingAvenue\Proof\SQL\Filter\Keyword\Update',
            'SET'    => '\CodingAvenue\Proof\SQL\Filter\Keyword\Set',
            'SET-OPERATOR' => '\CodingAvenue\Proof\SQL\Filter\Keyword\SetOperator'
        );
    }   
}
