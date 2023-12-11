<?php

namespace App;

class Operator {
    public function add($result, $value): float {
        return $result + $value;
    }
    public function subtract($result, $value): float {
        return $result - $value;
    }
    public function multiply($result, $value): float {
        return $result * $value;
    }
    public function divide($result, $value): float {
        return $value == 0 ? $value : $result / $value;
    }
    public function apply($result, $value): float {
        return $result == 0.0 ? $value : $result;
    }
}