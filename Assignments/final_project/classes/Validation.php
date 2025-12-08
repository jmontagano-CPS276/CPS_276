<?php
class Validation {
    private $errors = [];

    public function checkFormat($value, $type, $customErrorMsg = null) {
        $patterns = [
            'name'      => "/^[A-Za-z' -]+$/",
            'phone'     => "/^[0-9]{3}\.[0-9]{3}\.[0-9]{4}$/",
            'address'   => "/^[0-9]+[A-Za-z ]+$/",
            'city'      => "/^[A-Za-z ]+$/",
            'email'     => "/^[\w\.-]+@[\w\.-]+\.[A-Za-z]{2,}$/",
            'dob'       => "/^(0[1-9]|1[0-2])\/(0[1-9]|[12]\d|3[01])\/(19\d{2}|20\d{2}|2100)$/",
            'password'  => "/^.+$/",
            'none'      => "/.*/"
];


        $pattern = $patterns[$type] ?? '/.*/';

        if (!preg_match($pattern, $value)) {
            $errorMessage = $customErrorMsg ?? "Invalid $type format.";
            $this->errors[$type] = $errorMessage;
            return false;
        }

        return true;
    }

    public function getErrors() {
        return $this->errors;
    }

    public function hasErrors() {
        return !empty($this->errors);
    }
}
?>