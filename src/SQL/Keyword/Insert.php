<?php

namespace CodingAvenue\Proof\SQL\Keyword;

use CodingAvenue\Proof\SQL\Attribute\Insert_;

class Insert
{
    public function __construct(array $parsed)
    {
        $this->parsed = $parsed;
    }

    public function filter(array $attributes = array() )
    {
        $insertKeyword = isset($this->parsed['INSERT']) ? $this->parsed['INSERT'] : [];

        if (empty($insertKeyword)) {
            return [];
        } elseif (empty($attributes)) {
            return $insertKeyword;
        } else {
            $filtered = [];
            $insertAttribute = new Insert_($insertKeyword);

            foreach ($attributes as $attributeName => $attributeValue) {
                if (in_array($attributeName, $insertAttribute->knownAttributes())) {
                    foreach ($attributeValue as $value) {
                        $found = $insertAttribute->find($value);

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
