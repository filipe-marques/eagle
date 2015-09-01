<?php

class Validation
{
    private $has = 'ripemd160', $hass = 'CRYPT_SHA512', $errors = array();
    
    public static function escapeValue($index)
    {
        // specialize with array $_POST[$index] or $_GET[$index] instead of general $_POST or $_GET
        if(isset($_POST[$index]))
            return htmlspecialchars(trim($_POST[$index]), ENT_QUOTES);
        else if(isset($_GET[$index]))
            return htmlspecialchars(trim($_GET[$index]), ENT_QUOTES);
    }

    public function hashValue($hashp)
    {
        $hashpass = hash($this->has, $hashp);
        return crypt($hashpass, $this->hass);
    }
    
    public function spamout($email)
    {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            $this->addErrors("Erro: O email: {$email} - não é válido !");
    }
    
    public function equalPassword($password1, $password)
    {
        if($password !== $password1)
            $this->addErrors("Erro: As passwords não coincidem !");
    }

    public function checkBounds($variable, $identifier, $min, $max)
    {
        if(strlen($variable) < $min)
            $this->addErrors("Erro: {$identifier} - por favor insira mais de {$min} caracteres !");
        if(strlen($variable) > $max)
            $this->addErrors("Erro: {$identifier} - por favor insira menos de {$max} caracteres !");
    }

    public function isNumber($item)
    {
        if(!is_numeric($item))
            $this->addErrors("{$item} não é numérico !");
    }

    public static function active($item)
    {
        if(isset($_POST[$item]))
            return true;
        else if(isset($_GET[$item]))
            return true;
        return false;
    }
    
    public static function get($index)
    {
        if(isset($_POST[$index]))
            return $_POST[$index];
        else if(isset($_GET[$index]))
            return $_GET[$index];
        return '';
    }

    public static function wasClicked($index)
    {
        if(isset($_POST[$index]))
            return true;
        return false;
    }

    private function addErrors($error)
    {
        $this->errors[] = $error;
    }

    public function errors()
    {
        return $this->errors;
    }
}
