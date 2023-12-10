<?php

namespace App\Forms;

class FormValidation{

    /**
     * Validates the minimum length of a string.
     *
     * @param string  $value
     * @param int     $length
     *
     * @return bool
     */
    public function minLengthValidation(string $value, int $length): bool
    {
        if(strlen($value) < $length){
            return false;
        }else{
            return true;
        }
    }

    /**
     * Validates the maximum length of a string.
     *
     * @param string  $value
     * @param int     $length
     *
     * @return bool
     */
    public function maxLengthValidation(string $value, int $length): bool
    {
        if(strlen($value) > $length){
            return false;
        }else{
            return true;
        }
    }

    /**
     * Validates the minimum and the maximum length of a string.
     *
     * @param string  $value
     * @param int     $min
     * @param int     $max
     *
     * @return bool
     */
    public function lengthValidation(string $value, int $min, int $max): bool
    {
        if(strlen($value) < $min || strlen($value) > $max){
            return false;
        }else{
            return true;
        }
    }

    /**
     * Validates that the string is in email format.
     *
     * @param string  $mail
     *
     * @return bool
     */
    public function mailValidation(string $mail): bool
    {
        if(filter_var($mail, FILTER_VALIDATE_EMAIL) == false){
            return false;
        }else{
            return true;
        }
    }

}