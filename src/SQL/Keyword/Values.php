<?php

namespace CodingAvenue\Proof\SQL\Keyword;

use CodingAvenue\Proof\SQL\Attribute\Values_;

class Values
{
    public function __construct(array $parsed)
    {
        $this->parsed = $parsed;
    }

    public function filter(array $attributes = array() )
    {
        $valuesKeyword = isset($this->parsed['VALUES']) ? $this->parsed['VALUES'] : [];

        if (empty($valuesKeyword)) {
            return [];
        } elseif (empty($attributes)) {
            return $valuesKeyword;
        } else {
            $filtered = [];
            $valuesAttribute = new Values_($valuesKeyword);

            foreach ($attributes as $attributeName => $attributeValue) {
                if (in_array($attributeName, $valuesAttribute->knownAttributes())) {
                    foreach ($attributeValue as $value) {
                        $found = $valuesAttribute->find($value);

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
