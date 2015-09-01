<?php
require_once 'init.php';

if(Validation::wasClicked('submit_new_product'))
{
    // Anti-CSRF protection
    if(Token::check(Validation::get('token'), 'token_form'))
    {
        $validFile = new Files;
        $valid = new Validation;
        $data = Database::getInstance();

        $validFile->validateName('userfile');
        $validFile->validateType('image/jpeg', 'userfile');
        $validFile->validateSize('userfile');

        if(!empty($validFile->errors()))
        {
            foreach($validFile->errors() as $error)
            {
                echo "<br><div class=\"container\"><div class=\"row\">" . $error . "<br></div></div>";
            }
            die();
        }

        $ref = Validation::escapeValue('ref');
        $name_of_product = Validation::escapeValue('name');
        $price_of_product = Validation::escapeValue('price');
        $descr_of_product = Validation::escapeValue('descr');
        $category_of_product = Validation::escapeValue('category');
        $shipping_of_product = Validation::escapeValue('envio');
        $quantity_of_product = Validation::escapeValue('quantity');
        
        $valid->checkBounds($ref, 'Referência do produto', 3, 15);
        $valid->checkBounds($name_of_product,'Nome do produto', 3, 40);
        $valid->checkBounds($descr_of_product,'Descrição', 20, 90);
        //$valid->checkBounds($price_of_product,'price_of_product', 4, 9);
        //$valid->isNumber($price_of_product);
        //$valid->checkBounds($category_of_product,'category', 6, 20);

        if(!empty($valid->errors()))
        {
            foreach($valid->errors() as $erro)
            {
                echo "<br><div class=\"container\"><div class=\"row\">" . $erro . "<br></div></div>";
            }
            die();
        }

        // no errors
        if(Files::uploadFile('userfile', 'uploads/'))
        {
            $path = Files::getFilePath();
            $res = $data->insert('products', array('image_path' => $path,
                                                   'ref_of_product' => $ref,
                                                   'name_of_product' => $name_of_product,
                                                   'price_of_product' => $price_of_product,
                                                   'description' => $descr_of_product,
                                                   'category_of_product' => $category_of_product,
                                                   'shipping' => $shipping_of_product,
                                                   'quantity' => $quantity_of_product));
            if($res)
            {
                echo("<h2>Foi inserido com sucesso um novo produto na tabela !</h2>");
            }
        }
    }
}
