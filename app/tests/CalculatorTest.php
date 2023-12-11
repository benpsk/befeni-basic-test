<?php

use App\Calculator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    protected Calculator $calculator;
    protected function setUp(): void
    {
        $this->calculator = new Calculator();
    }
    public static function additionProvider(): array
    {
        return [
            [
                'data' => [
                    ['operator' => 'apply', 'value' => 3]
                ],
                'expected' => 3
            ],
            [
                'data' => [
                    ['operator' => 'add', 'value' => 5],
                    ['operator' => 'subtract', 'value' => 3],
                    ['operator' => 'multiply', 'value' => 2],
                    ['operator' => 'apply', 'value' => 2]
                ],
                'expected' => 12
            ],
            [
                'data' => [
                    ['operator' => 'add', 'value' => 5.5],
                    ['operator' => 'subtract', 'value' => 3.5],
                    ['operator' => 'multiply', 'value' => 2.0],
                    ['operator' => 'apply', 'value' => 10.1]
                ],
                'expected' => 70.7
            ],
            [
                'data' => [
                    ['operator' => 'add', 'value' => 5.5],
                    ['operator' => 'subtract', 'value' => 3.5],
                    ['operator' => 'multiply', 'value' => 2.0],
                    ['operator' => 'apply', 'value' => 0]
                ],
                'expected' => 0
            ],
            ];
    }
    #[DataProvider('additionProvider')]
    public function test_calculator($data, $expected)
    {
        $result = $this->calculator->processInstructions($data);
        $this->assertEquals($expected, $result);
    }
}