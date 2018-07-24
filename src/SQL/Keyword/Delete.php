<?php

namespace CodingAvenue\Proof\SQL\Keyword;

/**
 * Delete Keyword class Filters the DELETE SQL keyword from the parsed SQL string.
 */
class Delete
{
    /** @var Array $parsed the parsed SQL stirng */
    private $parsed;

    public function __construct(array $parsed)
    {
        $this->parsed = $parsed;
    }

    /**
     * Filters the parsed SQL string by finding a DELETE clause of the SQL query.
     * Can be filtered more by passing an attribute to the method.
     * See CodingAvenue\Proof\SQL\Attribute\Select_ for supported attributes.
     * 
     * @param Array $attributes use to add additional filter to the parsed SQL string
     * @return Array the remaining parsed SQL string after the filter has been applied.
     */
    public function filter(array $attributes = array() )
    {
        $deleteKeyword = isset($this->parsed['DELETE']) ? $this->parsed['DELETE'] : [];

        if (empty($deleteKeyword)) {
            return [];
        } else {
            return $deleteKeyword;
        }
    }
}
