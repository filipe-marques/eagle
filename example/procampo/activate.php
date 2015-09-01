<?php

require_once 'init.php';

if(isset($_GET))
{

    $dbh = new PDO('mysql:host=localhost;dbname=procampo', 'root', 'ff');

    //$user = Database::getInstance()->get('users', array('email', '=', $email));

    $stmt = $dbh->prepare("SELECT * FROM users WHERE email = ?");
    if ($stmt->execute(array($_GET['r'])))
    {
        while ($row = $stmt->fetch())
        {
            //print_r($row);
            //echo $row[id];
            $user_up = Database::getInstance()->update('users', $row[id], array('active' => '1'));
        }
        if($user_up)
        {
            Redirect::to('index.php');
            //echo 'Yup';
        }
    }
    
}
else
{
    Redirect::to('index.php');
}
