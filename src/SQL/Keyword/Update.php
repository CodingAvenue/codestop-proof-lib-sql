<?php

namespace CodingAvenue\Proof\SQL\Keyword;

use CodingAvenue\Proof\SQL\Attribute\Update_;

/**
 * Update Keyword class Filters the UPDATE SQL keyword from the parsed SQL string.
 */
class Update
{
    /** @var Array $parsed the parsed SQL stirng */
    private $parsed;

    public function __construct(array $parsed)
    {
        $this->parsed = $parsed;
    }

    /**
     * Filters the parsed SQL string by finding a UPDATE clause of the SQL query.
     * Can be filtered more by passing an attribute to the method.
     * See CodingAvenue\Proof\SQL\Attribute\Select_ for supported attributes.
     * 
     * @param Array $attributes use to add additional filter to the parsed SQL string
     * @return Array the remaining parsed SQL string after the filter has been applied.
     */
    public function filter(array $attributes = array() )
    {
        $updateKeyword = isset($this->parsed['UPDATE']) ? $this->parsed['UPDATE'] : [];

        if (empty($updateKeyword)) {
            return [];
        } elseif (empty($attributes)) {
            return $updateKeyword;
        } else {
            $filtered = [];
            $updateAttribute = new Update_($updateKeyword);

            // Loop through the passed attributes
            foreach ($attributes as $attributeName => $attributeValue) {
                // Check if the key is on the known attributes list of the keyword
                if (in_array($attributeName, $updateAttribute->knownAttributes())) {
                    foreach ($attributeValue as $value) {
                        $found = $updateAttribute->find($value);

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
