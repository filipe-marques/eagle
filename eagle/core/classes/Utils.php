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
 *  \brief     public static functions most needed
 *  \details   Utility public static functions most needed
 *  \author    Filipe Marques
 *  \version   2.0.0
 *  \copyright &copy; 2014 2015 Filipe Marques GNU Lesser General Public License version 3
 */

class Utils
{
    /*! showErrors is a public static member function for show errors
    *   \n DEVELOPMENT PURPOSES - DO NOT USE THIS IN PRODUCTION ENVIRONMENT
    */
    public static function showErrors()
    {
        error_reporting(E_ALL);
        ini_set('display_errors', true);
        ini_set('html_errors', false);
    }

    //! login is a public static member function for echo the name of the current page
    public static function me()
    {
        echo($_SERVER['PHP_SELF']);
    }
}
