<?php

namespace CodingAvenue\Proof\SQL\Operators;

class Is extends Operators
{
    private $left;
    private $right;

    public function __construct(array $left, array $right)
    {
        $this->left = $left;
        $this->right = $right;
    }

    public function getRight()
    {
        return $this->right;
    }

    public function getLeft()
    {
        return $this->left;
    }

    public function getSubNodes(): array
    {
        return array($this->left, $this->right);
    }

    public function getType(): string
    {
        return "IS";
    }
}