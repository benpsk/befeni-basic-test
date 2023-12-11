<?php

namespace App;

use Exception;

class InstructionLoader
{
    /**
     * @throws Exception
     */
    public static function loadFromFile($filename): array
    {
        $fileContent = file_get_contents($filename); // need to use chunk to read large file
        if ($fileContent === false) {
            throw new Exception("Error reading file: $filename");
        }
        $instructions = explode("\n", $fileContent);
        return array_filter($instructions, 'trim');
    }
}
