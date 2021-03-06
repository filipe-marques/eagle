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
 *  \brief     redirecting to other pages
 *  \details   All the operations related to redirecting to other pages
 *  \author    Filipe Marques
 *  \version   2.0.0
 *  \copyright &copy; 2014 2015 Filipe Marques GNU Lesser General Public License version 3
 */
 
class Redirect
{
    //! to is a public static member function for redirecting to other pages
    /*! \param location the name of the page 'index.php' or a number corresponding to errors '404'
    */
    public static function to($location = null)
    {
        if($location)
        {
            if(is_numeric($location))
            {
                switch($location)
                {
                    case 404:
                        header("HTTP/1.0 404 Not Found");
                        include_once("includes/errors/404.php");
                        exit();
                        break;
                }
            }
            header("Location: " . $location);
            exit();
        }
    }
}
