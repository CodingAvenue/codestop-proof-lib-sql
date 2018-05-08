<?php

namespace CodingAvenue\Proof\SQL\Keyword;

use CodingAvenue\Proof\SQL\Attribute\From_;

class From
{
    public function __construct(array $parsed)
    {
        $this->parsed = $parsed;
    }

    public function filter(array $attributes = array() )
    {
        $fromKeyword = isset($this->parsed['FROM']) ? $this->parsed['FROM'] : [];

        if (empty($fromKeyword)) {
            return [];
        } elseif (empty($attributes)) {
            return $fromKeyword;
        } else {
            $filtered = [];
            $fromAttribute = new From_($fromKeyword);

            foreach ($attributes as $attributeName => $attributeValue) {
                if (in_array($attributeName, $fromAttribute->knownAttributes())) {
                    foreach ($attributeValue as $value) {
                        $found = $fromAttribute->find($value);

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
