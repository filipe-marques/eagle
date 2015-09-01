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
 *  \brief     uploading files, get file path, validate files (name, syze, type)
 *  \details   All the operations related to uploading files, get file path, validate files (name, syze, type)
 *  \author    Filipe Marques
 *  \version   2.0.0
 *  \copyright &copy; 2014 2015 Filipe Marques GNU Lesser General Public License version 3
 */

class Files
{
    private static $filePath = '';
    private $errors = array();
    
    //! check is a public static member function for check a token key with a token value
    /*! \param token_value is the value name of the array GLOBALS in 'session' in init.php
     *  \param token_key is the key name of the array GLOBALS in 'session' in init.php
     *  \return true if the value of token exists, otherwise false
    */
    public static function uploadFile($filevar, $uploaddir)
    {
        $imagem_code_name = rand().'_'. rand().'_'.rand().'_'.rand().'_'.rand();
        self::$filePath = $uploaddir . basename($imagem_code_name);
        if(move_uploaded_file($_FILES[$filevar]['tmp_name'], self::$filePath))
            return true;
        return false;
    }
    
    //! getFilePath is a public static member function for getting the file path after being uploaded
    /*!  \return path of the file uploaded
    */
    public static function getFilePath()
    {
        return self::$filePath;
    }

    //! validateType is a public member function for validate a type of a file
    //! \n You can change the message, in the source file
    /*! \param key_file is the key name of the array FILES
     *  \param typefile the type chosen of file 'image/jpeg' or 'image/png'
     *  \return if exists error add a message to errors array
    */
    public function validateType($typefile, $filevar)
    { 
        $imagem_type = $_FILES[$filevar]['type'];
        if($imagem_type !== $typefile)
            $this->addErrors("Erro: Por favor insira uma imagem do tipo {$typefile} !");
    }

    //! validateSize is a public member function for validate a file name
    //! \n You can change the message, in the source file
    /*! \param key_file is the key name of the array FILES
     *  \return if exists error add a message to errors array
    */
    public function validateSize($filevar)
    {
        $imagem_size = $_FILES[$filevar]['size'];
        $imagem_sizin = round($imagem_size / 1000);
        if($imagem_sizin > 350)
            $this->addErrors("Erro: Por favor insira uma imagem mais pequena !");
    }

    //! validateName is a public member function for validate a file name
    //! \n You can change the message, in the source file
    /*! \param key_file is the key name of the array FILES
     *  \return if exists error add a message to errors array
    */
    public function validateName($key_file)
    {
        $imagem_nome = htmlspecialchars(trim($_FILES[$filevar]['name']), ENT_QUOTES);
        if(empty($imagem_nome))
            $this->addErrors("Erro: Por favor insira uma imagem !");
    }

    private function addErrors($error)
    {
        $this->errors[] = $error;
    }

    //! errors is a public member function for getting the error messages of errors array
    /*!  \return the errors private array to use in a generator foreach
    */
    public function errors()
    {
        return $this->errors;
    }
}
