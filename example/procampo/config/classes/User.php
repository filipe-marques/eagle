<?php

class User
{
    private $db = NULL, $query;
    
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    
    public function login($email, $password)
    {
        $query = $this->db->selectMultiple('users', array(
            'query1' => array('email', '=', $email),
            'query2' => array('password', '=', $password),
            'query3' => array('active', '=', '1')
        ));

        if($query)
        {
            //echo 'YES!';
            //print_r($user);
            //echo '<br>'.$user[0]['id'];

            foreach($query as $u)
            {
                Session::put('id', $u['id']);
                Session::put('email', $u['email']);
                Session::put('nickname', $u['nickname']);

                /*
                echo '<br>id: '.$u['id'].'<br>';
                echo 'email: '.$u['email'].'<br>';
                echo 'password: '.$u['password'].'<br>';
                echo 'nickname: '.$u['nickname'].'<br>';
                echo 'active: '.$u['active'].'<br>';
                 */
            }
            return true;
        }
        return false;
    }

    public function loginAdmin($email, $password)
    {
        $query = $this->db->selectMultiple('manager', array(
            'query1' => array('email', '=', $email),
            'query2' => array('password', '=', $password),
            'query3' => array('active', '=', '1')
        ));

        if($query)
        {
            //echo 'YES!';
            //print_r($user);
            //echo '<br>'.$user[0]['id'];

            foreach($query as $u)
            {
                Session::put('id', $u['id']);
                Session::put('email', $u['email']);
                Session::put('nickname', $u['nickname']);

                /*
                echo '<br>id: '.$u['id'].'<br>';
                echo 'email: '.$u['email'].'<br>';
                echo 'password: '.$u['password'].'<br>';
                echo 'nickname: '.$u['nickname'].'<br>';
                echo 'active: '.$u['active'].'<br>';
                 */
            }
            return true;
        }
        return false;
    }

    public static function logout()
    {
        if(Session::exists('id'))
        {
            Session::delete('id');
            Session::delete('email');
            Session::delete('nickname');
            session_destroy();
            Redirect::to('index.php');
        }
    }

    public function activateAccount($email)
    {
    }

    public function createUser($email, $pass, $name)
    {
        $now = date("Y-m-d");
        $this->query = $this->db->insert('users', array('email' => $email,
                                                        'password' => $pass,
                                                        'nickname' => $name,
                                                        'active' => '1',
                                                        'sinceregisted' => $now));
        return $this->query;
    }

    public function changePassword()
    {
    }

    public function changeAddress()
    {
    }

    public function deleteAccount()
    {
    }
}
