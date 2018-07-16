<?php

namespace CodingAvenue\Proof\SQL\WhereNodes;

use CodingAvenue\Proof\SelectorParser\Parser;
use CodingAvenue\Proof\SelectorParser\Transformer\ArrayTransformer;

class WhereNodes
{
    public function __construct(array $nodes)
    {
        $this->nodes = $nodes;
    }

    public function find(string $rawSelector)
    {
        $selector = $this->parseSelector($rawSelector);


        if (isset($selector['attribute'])) {
            $node = NodeFactory::getNode($selector['attribute']['type'][0]);

            $node = $node->filter($selector['attribute'], $this->nodes);

            return new self($node);
        }
    }

    public function parseSelector(string $selector): array
    {
        $parser = new Parser($selector);
        $stream = $parser->parse();

        $transformer = new ArrayTransformer($stream);
        return $transformer->transform();
    }

    public function count()
    {
        return count($this->nodes);
    }
}