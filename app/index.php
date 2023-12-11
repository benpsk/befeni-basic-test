<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\InstructionLoader;
use App\Calculator;
use App\Validator;

try {
    $validate = new Validator();
    $filename = $validate->file($validate->input($argv));

    $input = InstructionLoader::loadFromFile($filename);
    $instructions = $validate->instruction($input);

    $calculator = new Calculator();
    $result = $calculator->processInstructions($instructions);
    echo $result . PHP_EOL;
} catch (Throwable $th) {
    die($th->getMessage() . PHP_EOL);
}
