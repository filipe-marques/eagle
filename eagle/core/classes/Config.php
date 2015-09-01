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
 *  \brief     reading the 'config' array in 'init.php' and extract, given the key, the value
 *  \details   All the operations related to reading the 'config' array in 'init.php' and extract, given the key, the value
 *  \author    Filipe Marques
 *  \version   2.0.0
 *  \copyright &copy; 2014 2015 Filipe Marques GNU Lesser General Public License version 3
 */

class Config
{
    //! get is a public static member function for extract values from keys in array GLOBALS 'config' in 'init.php'
    /*! \param path is the name of the key or keys 'key/key' of the array GLOBALS in 'init.php'
     *  \return false if path is not valid
    */
    public static function get($path = null)
    {
        if($path)
        {
            $config = $GLOBALS['config'];
            $path = explode('/', $path);
            foreach($path as $b)
            {
                if(isset($config[$b]))
                    $config = $config[$b];
            }
            return $config;
        }
        return false;
    }
}
