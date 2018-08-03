<?php

namespace CodingAvenue\Proof\SQL\Filter;

interface FilterInterface
{
    public function applyFilter(array $nodes): array;
}
