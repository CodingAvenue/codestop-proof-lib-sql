<?php

namespace CodingAvenue\Proof\SQL\Operators;

abstract class Operators
{
    abstract function getType(): string;

    abstract function getSubNodes(): array;
}