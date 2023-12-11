<?php

use App\Operator;
use PHPUnit\Framework\TestCase;

class OperatorTest extends TestCase
{
    protected Operator $operator;
    protected function setUp(): void
    {
        $this->operator = new Operator();
    }

    public function test_add_positive_and_negative_numbers()
    {
        $result = $this->operator->add(-2, 3);
        $this->assertEquals(1, $result);
    }

    public function test_add_negative_and_negative_numbers()
    {
        $result = $this->operator->add(-2, -3);
        $this->assertEquals(-5, $result);
    }

    public function test_subtract_negative_and_negative_numbers()
    {
        $result = $this->operator->subtract(-3, -5);
        $this->assertEquals(2, $result);
    }
    public function test_subtract_negative_and_negative_numbers_1()
    {
        $result = $this->operator->subtract(-5, -3);
        $this->assertEquals(-2, $result);
    }
    public function test_divided_by_zero_should_return_zero()
    {
        $result = $this->operator->divide(3, 0);
        $this->assertEquals(0, $result);
    }
    public function test_divided_by_minus_should_return_minus()
    {
        $result = $this->operator->divide(4, -2);
        $this->assertEquals(-2, $result);
    }
    public function test_float_numbers()
    {
        $result = $this->operator->divide(5, -2);
        $this->assertEquals(-2.5, $result);
    }
    public function test_apply_operator()
    {
        $result = $this->operator->apply(5, 2);
        $this->assertEquals(5, $result);
    }
    public function test_zero_result_apply_operator()
    {
        $result = $this->operator->apply(0, 2);
        $this->assertEquals(2, $result);
    }
}