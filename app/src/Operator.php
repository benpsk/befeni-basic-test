<?php

namespace App;

class Operator
{
    public function add(float $result, float $value): float
    {
        return $result + $value;
    }

    public function subtract(float $result, float $value): float
    {
        return $result - $value;
    }

    public function multiply(float $result, float $value): float
    {
        return $result * $value;
    }

    public function divide(float $result, float $value): float
    {
        return $value == 0 ? $value : $result / $value;
    }

    public function apply(float $result, float $value): float
    {
        return $result == 0.0 ? $value : $result;
    }
}