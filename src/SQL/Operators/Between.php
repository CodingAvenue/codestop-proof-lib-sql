<?php

namespace CodingAvenue\Proof\SQL\Operators;

class Between extends Operators
{
    private $left;
    private $start;
    private $end;

    public function __construct(array $left, array $start, array $end)
    {
        $this->left = $left;
        $this->start = $start;
        $this->end = $end;
    }

    public function getLeft()
    {
        return $this->left;
    }

    public function getStart()
    {
        return $this->start;
    }

    public function getEnd()
    {
        return $this->end;
    }

    public function getSubNodes(): array
    {
        return array($this->left, $this->start, $this->end);
    }

    public function getType(): string
    {
        return "BETWEEN";
    }
}