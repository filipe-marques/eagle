<?php
/*
 * Eagle PHP Framework - Discrete PHP Framework for easy and fast development
 * Copyright (C) 2014 2015 Filipe Marques <eagle.software3@gmail.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

/*! 
 *  \brief     validating data in forms, urls and in get variables in urls and hash data
 *  \details   All the operations related to validating data in forms, urls and in get variables in urls and hash data
 *  \author    Filipe Marques
 *  \version   2.0.0
 *  \copyright &copy; 2014 2015 Filipe Marques GNU Lesser General Public License version 3
 */

class Validation
{
    private $has = 'ripemd160', $hass = 'CRYPT_SHA512', $errors = array();
    
    //! escapeValue is a public member function for escape, validate values and sanitize data
    /*! \param index is the index name of POST or GET arrays
     *  \return the validated and sanitized value
    */
    public static function escapeValue($index)
    {
        // specialize with array $_POST[$index] or $_GET[$index] instead of general $_POST or $_GET
        if(isset($_POST[$index]))
            return htmlspecialchars(trim($_POST[$index]), ENT_QUOTES);
        else if(isset($_GET[$index]))
            return htmlspecialchars(trim($_GET[$index]), ENT_QUOTES);
    }

    //! hashValue is a public member function for hash a value
    /*! \param hashp is a validated value
     *  \return the value encrypted
    */
    public function hashValue($hashp)
    {
        $hashpass = hash($this->has, $hashp);
        return crypt($hashpass, $this->hass);
    }
    
    //! spamout is a public member function for check if a given email is valid
    //! \n You can change the messages of error reporting of fields in the form
    /*! \param email is a validated value
     *  \return if give error add it to private addErrors function
    */
    public function spamout($email)
    {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            $this->addErrors("Erro: O email: {$email} - não é válido !");
    }
    
    //! equalPassword is a public member function for check if passwords are equal
    //! \n You can change the messages of error reporting of fields in the form
    /*! \param password1 is a validated value
     *  \param password is a validated value
     *  \return if give error add it to private addErrors function
    */
    public function equalPassword($password1, $password)
    {
        if($password !== $password1)
            $this->addErrors("Erro: As passwords não coincidem !");
    }

    //! checkBounds is a public member function for checking the bounds of a field in a given range
    //! \n You can change the messages of error reporting of fields in the form
    /*! \param variable the name of variable
     *  \param identifier the name of the form label relating to the variable
     *  \param min the minimum of caraters in the table field 
     *  \param max the maxmimum of caraters in the table field
     *  \return if give error add it to private addErrors function
    */
    public function checkBounds($variable, $identifier, $min, $max)
    {
        if(strlen($variable) < $min)
            $this->addErrors("Erro: {$identifier} - por favor insira mais de {$min} caracteres !");
        if(strlen($variable) > $max)
            $this->addErrors("Erro: {$identifier} - por favor insira menos de {$max} caracteres !");
    }

    //! isNumber is a public member function for checking if a value is a number
    //! \n You can change the messages of error reporting of fields in the form
    /*! \param item is a variable
     *  \return if give error add it to private addErrors function
    */
    public function isNumber($item)
    {
        if(!is_numeric($item))
            $this->addErrors("{$item} não é numérico !");
    }

    //! active is a public static member function for checking if the POST or GET, one or another are active / isset
    /*! \param item is a index name of POST or GET
     *  \return true if is POST is active or GET is active, otherwise false
    */
    public static function active($item)
    {
        if(isset($_POST[$item]))
            return true;
        else if(isset($_GET[$item]))
            return true;
        return false;
    }
    
    //! get is a public static member function for checking if the POST or GET, one or another are active / isset
    /*! \param item is a index name of POST or GET
     *  \return the value of POST or GET arrays
    */
    public static function get($index)
    {
        if(isset($_POST[$index]))
            return $_POST[$index];
        else if(isset($_GET[$index]))
            return $_GET[$index];
        return '';
    }

    //! wasClicked is a public static member function for checking if the POST is active / isset in a form
    /*! \param index is a index name of the button in the form
     *  \return true if is POST is active, otherwise false
    */
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

    //! errors is a public member function for showing through a foreach generator the information contained in the private error array
    /*! \return the private array errors for be showed in the generator foreach
    */
    public function errors()
    {
        return $this->errors;
    }
}
