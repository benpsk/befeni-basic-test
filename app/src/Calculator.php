<?php
namespace App;

class Calculator
{
    private float $result = 0.0;
    protected Operator $operator;
    public function __construct()
    {
        $this->operator = new Operator();
    }
    public function processInstructions(array $instructions): float
    {
        $fn = $instructions[0]['operator'];
        foreach ($instructions as $key => $instruction) {
            if ($key === 0) {
                $this->result = $instruction['value'];
                continue;
            }
            $this->result = $this->operator->$fn($this->result, $instruction['value']);
            $fn = $instruction['operator'];

        }
        return $this->result;
    }
}
