<?php
session_name("ProCampo-Rural-Shop");
session_start();
//session_regenerate_id();

//require_once ("config/gravatar/grafunc.php");
//require_once ("config/database/connect.php");
//require_once ("config/functions/functions.php");

require_once 'config/vendor/autoload.php';

// The names of the .php files are the same as the names of classes 
spl_autoload_register(function($class)
{
	require_once 'config/classes/' . $class . '.php';
});

Utils::showErrors();

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => 'ff',
        'db' => 'procampo'
    ),
    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800 // one month in seconds
    ),
    'session' => array(
        'session_name' => 'procampo',
        'token_form' => 'token',
        'token_register' => 'token_regis',
        'token_address' => 'token_add'
    )
);

// accessing $files associative array
// example: $files['header'];
$files = array(
	"css" => "config/resources/css/bootstrap.min.css",
	"css-modern" => "config/resources/css/modern-business.css",
	//"css-creative" => "config/resources/css/creative.css",
	//"css-theme" => "config/resources/css/bootstrap-theme.css",
	"js" => "config/resources/js/bootstrap.min.js",
	"js-query" => "config/resources/js/jquery.js",
	//"js-query-easing" => "config/resources/js/jquery.easing.min.js",
	//"js-fittext" => "config/resources/js/jquery.fittext.js",
	//"js-wow" => "config/resources/js/wow.min.js",
	//"js-creative" => "config/resources/js/creative.js",
	"font-awesome" => "config/resources/font-awesome/css/font-awesome.min.css",
	//"img1" => "config/resources/img/portfolio/1.jpg",
	//"img2" => "config/resources/img/portfolio/2.jpg",
	//"img3" => "config/resources/img/portfolio/3.jpg",
	//"img4" => "config/resources/img/portfolio/4.jpg",
	//"img5" => "config/resources/img/portfolio/5.jpg",
	//"img6" => "config/resources/img/portfolio/6.jpg",
	"header" => "config/hf/header.php",
	"footer" => "config/hf/footer.php",
);

if(Validation::wasClicked('submit_login'))
{
    // Anti-CSRF protection
    if(Token::check(Validation::get('token'), 'token_form'))
    {
	    $email = Validation::escapeValue('inputEmail');
	    $password = Validation::escapeValue('inputPassword');

        //$user = Database::getInstance();
        $valid = new Validation;
        $user = new User;
        
        //$user->insert('users', array('email' => $email, 'password' => $password));

        //$user->select('users', array('email', '=', $email));

        $pass = $valid->hashValue($password);
        if($user->login($email, $pass))
        {
            //echo 'YES';
            Redirect::to('profile.php');
        }
        else if($user->loginAdmin($email, $pass))
        {
            Redirect::to('admin.php');
        }
        else
        {
            echo 'mensagem com message twitter bootstrap';
            //echo Session::flash('acount', 'Por favor active a sua conta de utilizador !');
        }
        
        //echo $email . ' ' . $pass;

        //$user->update('users', 8, array('nickname' => 'qwedfg', 'active' => '1'));

        //$user->delete('users', '3');
        
        /*
           $user->selectMultiple('users', array(
           'query1' => array('email', '=', $email),
           'query2' => array('password', '=', $pass),
           'query3' => array('active', '=', '1')
           ));

           if(!empty($user))
           {
           echo 'YES!';
           //print_r($user);
           //echo '<br>'.$user[0]['id'];
           foreach($user as $u)
           {
           echo '<br>id: '.$u['id'].'<br>';
           echo 'email: '.$u['email'].'<br>';
           echo 'password: '.$u['password'].'<br>';
           echo 'nickname: '.$u['nickname'].'<br>';
           echo 'active: '.$u['active'].'<br>';
           }
           }
           else
           {
           echo "Por favor active a sua conta !<br>";
           }
         */
    }
}

/*
require_once("config/lang/pt.php");
require_once("config/lang/es.php");
require_once("config/lang/fr.php");
require_once("config/lang/us.php");
require_once("config/lang/uk.php");
require_once("config/lang/br.php");
*/

