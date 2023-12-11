<?php

use App\Validator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    protected Validator $validator;
    protected function setUp(): void
    {
        $this->validator = new Validator();
    }

    /**
     * @throws Exception
     */
    public function test_validate_input_should_success()
    {
        $argv = ['script.php', 'instruction.txt', 'abc.txt'];
        $result = $this->validator->input($argv);
        $this->assertEquals($argv[1], $result);
    }

    /**
     * @throws Exception
     */
    public function test_not_exist_file_should_success()
    {
        $filename = 'test.txt';
        $this->expectExceptionMessage("Error: file not exists: $filename");
        $this->validator->file($filename);
    }

    /**
     * @throws Exception
     */
    public function test_correct_instruction_should_success()
    {
        $input = ['add 5', 'subtract 3', 'multiply 2', 'apply 10'];
        $result = $this->validator->instruction($input);
        $expected = [
            ['operator' => 'add', 'value' => 5.0],
            ['operator' => 'subtract', 'value' => 3.0],
            ['operator' => 'multiply', 'value' => 2.0],
            ['operator' => 'apply', 'value' => 10.0]
        ];
        $this->assertEquals($expected, $result);
    }

    public static function invalidInstructions(): array
    {
        return [
            [
                'data' => ['add 5', 'hello 3', 'multiply 2', 'apply 10'],
                'error' => "Error: Invalid operator: hello"
            ],
            [
                'data' => ['add 5', 'apply 3', 'multiply 2', 'apply 10'],
                'error' => "Error: the apply operator must be used once"
            ],
            [
                'data' => ['add 5', 'apply 3', 'multiply 2', 'add 10'],
                'error' => "Error: the apply operator must be used last"
            ],
            [
                'data' => ['add value', 'apply 3', 'multiply 2', 'add 10'],
                'error' => "Error: Invalid value: value"
            ],
        ];
    }
    /**
     * @throws Exception
     */
    #[DataProvider('invalidInstructions')]
    public function test_invalid_instruction_should_fail($data, $error)
    {
        $this->expectExceptionMessage($error);
        $this->validator->instruction($data);
    }

    /**
     * @throws Exception
     */
    public function test_no_instruction_file_provide_should_fail()
    {
        $argv = ['script.php'];
        $this->expectExceptionMessage("Error: Please provide an instruction file!");
        $this->validator->input($argv);
    }

    /**
     * @throws Exception
     */
    public function test_only_success_txt_file()
    {
        $filename = 'test.csv';
        $this->expectExceptionMessage("Error: File type must be .txt");
        $this->validator->file($filename);
    }
}
