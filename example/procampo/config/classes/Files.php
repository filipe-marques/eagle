<?php

class Files
{
    private static $filePath = '';
    private $errors = array();
    
    public static function uploadFile($filevar, $uploaddir)
    {
        $imagem_code_name = rand().'_'. rand().'_'.rand().'_'.rand().'_'.rand();
        self::$filePath = $uploaddir . basename($imagem_code_name);
        if(move_uploaded_file($_FILES[$filevar]['tmp_name'], self::$filePath))
            return true;
        return false;
    }
    
    public static function getFilePath()
    {
        return self::$filePath;
    }

    public function validateType($typefile, $filevar)
    { 
        $imagem_type = $_FILES[$filevar]['type'];
        if($imagem_type !== $typefile)
            $this->addErrors("Erro: Por favor insira uma imagem do tipo {$typefile} !");
    }

    public function validateSize($filevar)
    {
        $imagem_size = $_FILES[$filevar]['size'];
        $imagem_sizin = round($imagem_size / 1000);
        if($imagem_sizin > 350)
            $this->addErrors("Erro: Por favor insira uma imagem mais pequena !");
    }

    public function validateName($filevar)
    {
        $imagem_nome = htmlspecialchars(trim($_FILES[$filevar]['name']), ENT_QUOTES);
        if(empty($imagem_nome))
            $this->addErrors("Erro: Por favor insira uma imagem !");
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
