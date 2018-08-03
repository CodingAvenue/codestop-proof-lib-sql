<?php

namespace CodingAvenue\Proof\SQL\Operators;

class Plus_ extends Operators
{
    private $left;
    private $right;

    public function setLeft($left)
    {
        $this->left = $left;
    }

    public function setRight($right)
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
        return array();
    }

    public function getType(): string
    {
        return "+";
    }
}