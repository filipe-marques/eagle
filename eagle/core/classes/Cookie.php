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
 *  \brief     create, checking existence, getting and deleting cookies
 *  \details   All the operations related to create, checking existence, getting and deleting cookies
 *  \author    Filipe Marques
 *  \version   2.0.0
 *  \copyright &copy; 2014 2015 Filipe Marques GNU Lesser General Public License version 3
 */

class Cookie
{
    //! exists is a public static member function for check if a cookie exists
    /*!  \param key is the name of the key
     *  \return true if the cookie exists, otherwise false
    */
    public static function exists($key)
    {
        return (isset($_COOKIE[$key])) ? true : false;
    }

    //! get is a public static member function for getting the value of a cookie key
    /*! \param key is the name of the key
     *  \return the value of cookie key
    */
    public static function get($name)
    {
        return $_COOKIE[$name];
    }

    //! put is a public static member function for creating a cookie
    /*! \param key is the name of the cookie
     *  \param value is the value of the cookie
     *  \param expiry is the expiry of the cookie in seconds
     *  \return true if was created sucessfully, otherwise false
    */
    public static function put($key, $value, $expiry)
    {
        if(setcookie($key, $value, time() + $expiry, '/'))
            return true;
        return false;
    }

    //! delete is a public static member function for deleting a cookie
    /*! \param key is the name of the cookie
    */
    public static function delete($key)
    {
        self::put($key, '', time() - 1);
    }
}

