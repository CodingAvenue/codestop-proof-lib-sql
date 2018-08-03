<?php

namespace CodingAvenue\Proof\SQL;

use CodingAvenue\Proof\SelectorParser\Parser;
use CodingAvenue\Proof\SelectorParser\Transformer\ArrayTransformer;
use CodingAvenue\Proof\SQL\Filter\FilterFactory;

class Nodes
{
    private $nodes;

    public function __construct(array $nodes = array())
    {
        $this->nodes = $nodes;
    }

    public function find(string $selector)
    {
        $parsedSelector = $this->parseSelector($selector);

        $filter = FilterFactory::createFilter($parsedSelector['keyword'], isset($parsedSelector['attribute']) ? $parsedSelector['attribute'] : array());
        $filteredNodes = $filter->applyFilter($this->nodes);

        return new self($filteredNodes);   
    }

    public function count()
    {
        return count($this->nodes);
    }

    /**
     * Parse the selector stirng so it can be properly applied as filter on the parsed
     * SQL string.
     * 
     * @param String $selector the selector string to be parsed
     * @return Array the parsed selector string in an array with two keys
     * 'keyword' and 'attribute'.
     */
    public function parseSelector(string $selector): array
    {
        $parser = new Parser($selector);
        $stream = $parser->parse();

        $transformer = new ArrayTransformer($stream);
        return $transformer->transform();
    }
}