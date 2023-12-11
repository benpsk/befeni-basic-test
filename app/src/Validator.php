<?php

namespace App;

use Exception;

class Validator
{
    /**
     * @throws Exception
     */
    public function input(array $argv): string
    {
        if (!isset($argv[1])) {
            throw new Exception("Error: Please provide an instruction file!");
        }
        return $argv[1];
    }

    /**
     * @throws Exception
     */
    public function file(string $filename): string
    {
        $fileType = pathinfo($filename, PATHINFO_EXTENSION);
        if ($fileType !== 'txt') {
            throw new Exception("Error: File type must be .txt");
        }
        if (!file_exists($filename)) {
            throw new Exception("Error: file not exists: $filename");
        }
        return $filename;
    }

    /**
     * @throws Exception
     */
    public function instruction(array $input): array
    {
        $instructions = [];
        foreach ($input as $instruction) {
            $instruction = explode(' ', $instruction);
            $operator = $instruction[0];
            $value = $instruction[1];
            $this->validateOperator($operator);
            $this->validateValue($value);
            $instructions[] = ['operator' => $operator, 'value' => (float)$value];
        }
        $this->validateApplyOnce($instructions);
        $this->validateApplyLast($instructions);
        return $instructions;
    }

    /**
     * @throws Exception
     */
    protected function validateOperator(string $operator): void
    {
        $operators = get_class_methods(Operator::class);
        if (!in_array($operator, $operators)) {
            throw new Exception("Error: Invalid operator: $operator");
        }
    }

    /**
     * @throws Exception
     */
    protected function validateValue(string $value): void
    {
        if (!is_numeric($value)) {
            throw new Exception("Error: Invalid value: $value");
        }
    }

    /**
     * @throws Exception
     */
    protected function validateApplyOnce(array $instructions): void
    {
        $apply = array_filter($instructions, function ($instruction) {
            return $instruction['operator'] === 'apply';
        });
        if (count($apply) !== 1) {
            throw new Exception("Error: the apply operator must be used once");
        }
    }

    /**
     * @throws Exception
     */
    protected function validateApplyLast(array $instructions): void
    {
        $last = count($instructions) - 1;
        if ($instructions[$last]['operator'] !== 'apply') {
            throw new Exception("Error: the apply operator must be used last");
        }
    }
}
