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
 *  \brief     make hashs, unique salts
 *  \details   All the operations related to make hashs, unique salts 
 *  \author    Filipe Marques
 *  \version   2.0.0
 *  \copyright &copy; 2014 2015 Filipe Marques GNU Lesser General Public License version 3
 */

class Hash
{
    //! make is a public static member function to make hashs for a given string
    /*! \param string a variable containning a string
     *  \param sal can be empty or not
     *  \return the hash result
    */
    public static function make($string, $sal = '')
    {
        return hash('sha256', $string . $sal);
    }

    //! salt is a public static member function for salt for a given length
    /*! \param length the length of the salt
     *  \return the result of salt
    */
    public static function salt($length)
    {
        return mcrypt_create_iv($length);
    }

    //! unique is a public static member function for make uniqid's
    /*! \return the result of make function
    */
    public static function unique()
    {
        return self::make(uniqid());
    }
}
