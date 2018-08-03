<?php

namespace CodingAvenue\Proof\SQL\Traverser;

class Visitor
{
    public function __construct(callable $filterCallback)
    {
        $this->filterCallback = $filterCallback;
        $this->foundNodes = [];
    }

    public function enter($node)
    {
        $filterCallback = $this->filterCallback;

        if ($filterCallback($node)) {
            $this->foundNodes[] = $node;
            return $node;
        }

        return null;
    }

    public function getFoundNodes()
    {
        return $this->foundNodes;
    }
}