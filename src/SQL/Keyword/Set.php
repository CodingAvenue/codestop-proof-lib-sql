<?php

namespace CodingAvenue\Proof\SQL\Keyword;

use CodingAvenue\Proof\SQL\Attribute\Set_;

/**
 * Set Keyword class Filters the SET SQL keyword from the parsed SQL string.
 */
class Set
{
    /** @var Array $parsed the parsed SQL stirng */
    private $parsed;

    public function __construct(array $parsed)
    {
        $this->parsed = $parsed;
    }

    /**
     * Filters the parsed SQL string by finding a SET clause of the SQL query.
     * Can be filtered more by passing an attribute to the method.
     * See CodingAvenue\Proof\SQL\Attribute\Select_ for supported attributes.
     * 
     * @param Array $attributes use to add additional filter to the parsed SQL string
     * @return Array the remaining parsed SQL string after the filter has been applied.
     */
    public function filter(array $attributes = array() )
    {
        $setKeyword = isset($this->parsed['SET']) ? $this->parsed['SET'] : [];

        if (empty($setKeyword)) {
            return [];
        } elseif (empty($attributes)) {
            return $setKeyword;
        } else {
            $filtered = [];
            $setAttribute = new Set_($setKeyword);

            // Loop through the passed attributes
            $column = null;
            $value = null;
            foreach ($attributes as $attributeName => $attributeValue) {
                // Check if the key is on the known attributes list of the keyword
                if (in_array($attributeName, $setAttribute->knownAttributes())) {
                    if ($attributeName == 'column') {
                        $column = $attributeValue[0];
                    } else {
                        $value = $attributeValue[0];
                    }
                } else {
                    throw new \Exception("Unknown attribute '{$attributeName}'.");
                }
            }

            $found = $setAttribute->find($column, $value);

            if (!empty($found)) {
                $filtered[] = $found;
            }

            return $filtered;
        }
    }
}
