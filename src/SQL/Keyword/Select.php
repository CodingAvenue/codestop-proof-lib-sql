<?php

namespace CodingAvenue\Proof\SQL\Keyword;

use CodingAvenue\Proof\SQL\Attribute\Select_;

class Select
{
    public function __construct(array $parsed)
    {
        $this->parsed = $parsed;
    }

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
