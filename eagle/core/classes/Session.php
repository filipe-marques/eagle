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
 *  \brief     create, check existence, delete, getting and flash messages
 *  \details   All the operations related to create, check existence, delete, getting and flash messages
 *  \author    Filipe Marques
 *  \version   2.0.0
 *  \copyright &copy; 2014 2015 Filipe Marques GNU Lesser General Public License version 3
 */

class Session
{
    //! put is a public static member function for create a session variable
    /*! \param key the name of the key of the SESSION array
     *  \param value the value of that key of the SESSION array
    */
    public static function put($key, $value)
    {
        return $_SESSION[$key] = $value;
    }

    //! exists is a public static member function for check if a session index exists
    /*! \param key the name of the session key 
     *  \return true if the session key exists, otherwise false
    */
    public static function exists($key)
    {
        return (isset($_SESSION[$key])) ? true : false;
    }

    //! delete is a public static member function for delete a session index 
    /*! \param key the name of the session key
    */
    public static function delete($key)
    {
        if(self::exists($key))
            unset($_SESSION[$key]);
    }

    //! get is a public static member function for getting the value of a given SESSION key
    /*! \param key the name of the session key
     *  \return the value of SESSION key
    */
    public static function get($key)
    {
        return $_SESSION[$key];
    }

    //! flash is a public static member function for displaying a flash message
    /*! \param key the name of the session key you want
     *  \param message the message you want to sent
    */
    public static function flash($key, $message = '')
    {
        if(self::exists($key))
        {
            // next time it won't execute this part, because don't exist
            $session = self::get($key);
            self::delete($key);
            return $session;
        }
        else
            self::put($key, $message);
    }
}
