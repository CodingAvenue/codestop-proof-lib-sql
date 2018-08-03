<?php

namespace CodingAvenue\Proof\SQL\Operators;

class And_ extends Operators
{
    private $left;
    private $right;

    public function setLeft(Operators $left)
    {
        $this->left = $left;
    }

    public function setRight(Operators $right)
    {
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
        return "AND";
    }
}