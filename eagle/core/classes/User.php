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
 *  \brief     creation, login, changing passwords of users
 *  \details   All the operations related to the creation, login, changing passwords of users
 *  \author    Filipe Marques
 *  \version   2.0.0
 *  \copyright &copy; 2014 2015 Filipe Marques GNU Lesser General Public License version 3
 */

class User
{
    private $db = NULL;
    private $query;
    
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    
    //! login is a public member function for doing the login
    //! \n You have to edit with table name and fields of that table you want in this class.
    /*! \param email is a validated value
     *  \param password is a validated value
     *  \return true if the login is successfull, otherwise false
    */
    public function login($email, $password)
    {
        $query = $this->db->selectMultiple('users', array(
            'query1' => array('email', '=', $email),
            'query2' => array('password', '=', $password),
            'query3' => array('active', '=', '1')
        ));

        if($query)
        {
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

    //! loginAdmin is a public member function for doing the login of the administrator of website
    //! \n You have to edit with table name and fields of that table you want in this class.
    /*! \param email is a validated value
     *  \param password is a validated value
     *  \return true if the login is successfull, otherwise false
    */
    public function loginAdmin($email, $password)
    {
        $query = $this->db->selectMultiple('manager', array(
            'query1' => array('email', '=', $email),
            'query2' => array('password', '=', $password),
            'query3' => array('active', '=', '1')
        ));

        if($query)
        {
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

    //! logout is a public static member function for doing the logout and then redirect to index.php
    //! \n You have to edit with the names of session you want in this class.
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

    //! custom function, that you can expand
    public function activateAccount($email)
    {
    }

    //! createUser is a public member function for creating a user and registering in table of a database 
    //! \n You have to edit with table name and fields of that table you want in this class.
    /*! \param email is a validated value
     *  \param pass is a validated value
     *  \param name is a validated value, that in this case the nickname
     *  \return the result of the query: true or false
    */
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
    
    //! changePassword is a public member function for changing the password
    //! \n You have to edit with table name and fields of that table you want in this class.
    /*! \param oldpassword is a validated value
     *  \param newpassword is a validated value
     *  \return the result of the query: true or false
    */
    public function changePassword($oldpassword, $newpassword)
    {
    }

    //! custom function, that you can expand
    public function changeAddress()
    {
    }

    //! custom function, that you can expand
    public function deleteAccount()
    {
    }
}
