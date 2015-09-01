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
 *  \brief     generate, check tokens for ANTI-CSRF website form
 *  \details   All the operations related to generate and check tokens for ANTI-CSRF website form
 *  \author    Filipe Marques
 *  \version   2.0.0
 *  \copyright &copy; 2014 2015 Filipe Marques GNU Lesser General Public License version 3
 */

class Token
{
    //! generate is a public static member function for generate a token and set him in session active
    /*! \param token_key is the key name of the array GLOBALS in init.php
    */
    public static function generate($token_key)
    {
        return Session::put(Config::get('session/'.$token_key), md5(uniqid()));
    }

    //! check is a public static member function for check a token key with a token value
    /*! \param token_value is the value name of the array GLOBALS in 'session' in init.php
     *  \param token_key is the key name of the array GLOBALS in 'session' in init.php
     *  \return true if the value of token exists, otherwise false
    */
    public static function check($token_value, $token_key)
    {
        $tokenName = Config::get('session/'.$token_key);
        if(Session::exists($tokenName) && $token_value === Session::get($tokenName))
        {
            Session::delete($tokenName);
            return true;
        }
        return false;
    }
}
