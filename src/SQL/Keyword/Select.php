<?php

namespace CodingAvenue\Proof\SQL\Keyword;

use CodingAvenue\Proof\SQL\Attribute\Select_;

/**
 * Select Keyword class Filters the SELECT SQL keyword from the parsed SQL string.
 */
class Select
{
    /** @var Array $parsed the parsed SQL stirng */
    private $parsed;

    public function __construct(array $parsed)
    {
        $this->parsed = $parsed;
    }

    /**
     * Filters the parsed SQL string by finding a SELECT clause of the SQL query.
     * Can be filtered more by passing an attribute to the method.
     * See CodingAvenue\Proof\SQL\Attribute\Select_ for supported attributes.
     * 
     * @param Array $attributes use to add additional filter to the parsed SQL string
     * @return Array the remaining parsed SQL string after the filter has been applied.
     */
    public function filter(array $attributes = array() )
    {
        $selectKeyword = isset($this->parsed['SELECT']) ? $this->parsed['SELECT'] : [];

        if (empty($selectKeyword)) {
            return [];
        } elseif (empty($attributes)) {
            return $selectKeyword;
        } else {
            $filtered = [];
            $selectAttribute = new Select_($selectKeyword);

            // Loop through the passed attributes
            foreach ($attributes as $attributeName => $attributeValue) {
                // Check if the key is on the known attributes list of the keyword
                if (in_array($attributeName, $selectAttribute->knownAttributes())) {
                    foreach ($attributeValue as $value) {
                        $found = $selectAttribute->find($value);

                        if (empty($found)) {
                            break;
                        } else {
                            $filtered[] = $found;
                        }
                    }
                } else {
                    throw new \Exception("Unknown attribute '{$attributeName}'.");
                }
            }

            return $filtered;
        }
    }
}
