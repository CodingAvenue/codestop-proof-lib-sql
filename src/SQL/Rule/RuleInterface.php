<?php

namespace CodingAvenue\Proof\SQL\Rule;

interface RuleInterface
{
    public function applyRule(array $nodes);
}