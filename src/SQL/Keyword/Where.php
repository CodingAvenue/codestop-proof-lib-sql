<?php

namespace CodingAvenue\Proof\SQL\Keyword;

use CodingAvenue\Proof\SQL\Attribute\Where_;

class Where
{
    public function __construct(array $parsed)
    {
        $this->parsed = $parsed;
    }

    public function filter(array $attributes = array() )
    {
        $whereKeyword = isset($this->parsed['WHERE']) ? $this->parsed['WHERE'] : [];

        if (empty($whereKeyword)) {
            return [];
        } elseif (empty($attributes)) {
            return $whereKeyword;
        } else {
            $whereAttribute = new Where_($whereKeyword);

            foreach ($attributes as $attributeName => $attributeValue) {
                if (!in_array($attributeName, $whereAttribute->knownAttributes())) {
                    throw new \Exception("Unknown attribute '{$attributeName}'.");
                }
            }

            return $whereAttribute->find($attributes);
        }
    }
}
