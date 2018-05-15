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
            return $this->normalize($whereKeyword);
        } else {
            $whereAttribute = new Where_($whereKeyword);

            foreach ($attributes as $attributeName => $attributeValue) {
                if (!in_array($attributeName, $whereAttribute->knownAttributes())) {
                    throw new \Exception("Unknown attribute '{$attributeName}'.");
                }
            }

            return $this->normalize($whereAttribute->find($attributes));
        }
    }

    /**
     * Normalize the parsed WHERE claused to make it easier for authors to test.
     * A parsed WHERE clause like `WHERE foo = bar` usually is a 3 element array.
     * But from the authors perspective this is just a single filter, and they may want to know how many filters are there on the query.
     * This method just enclose the 3 element array into a single element array.
     */
    private function normalize(array $part): array
    {
        if ((count($part) % 3) == 0) {
            $normalize = [];

            while (count($part) > 0) {
                $column = array_shift($part);
                $operator = array_shift($part);
                $value = array_shift($part);

                $normalize[] = [$column, $operator, $value];
            }
        } else {
            // For now we only support a WHERE clause that is parsed into 3 element array.
            throw new \Exception("Invalid WHERE parts found.");
        }

        return $normalize
    }
}
