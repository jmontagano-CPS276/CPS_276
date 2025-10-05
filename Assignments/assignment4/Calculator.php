<?php

class Calculator {

    public function checkNum($num1, $num2) {
        if ((is_int($num1) || is_float($num1)) && (is_int($num2) || is_float($num2))) {
            return true;
        }
        return false;
    }

    public function calc($operator = null, $num1 = null, $num2 = null) {
        if (is_null($operator) || is_null($num1) || is_null($num2)) {
            return "<p>Cannot perform operation. You must have three arguments. A string for the operator (+,-,*,/) and two integers or floats for the numbers.</p>";
        }
        if ($this->checkNum($num1, $num2)) {
            switch ($operator) {
                case "/":
                    if ($num2 == 0) {
                        return "<p>The Calculation is {$num1} {$operator} {$num2}. The answer is cannot divide a number by 0.</p>";
                    } 
                    $result = $num1 / $num2;
                    break;
                case "*": $result = $num1 * $num2; break;
                case "-": $result = $num1 - $num2; break;
                case "+": $result = $num1 + $num2; break;
            }

            return "<p>The Calculation is {$num1} {$operator} {$num2}. The Answer is {$result}.</p>";

        } else {
            return "<p>Cannot perform operation. You must have three arguments. A string for the operator (+,-,*,/) and two integers or floats for the numbers.</p>";
        }
        



}
}
?>