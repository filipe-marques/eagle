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
 *  \brief     insert, select or selectMultiple, update and delete records in tables of the database
 *  \details   All the operations related to insert, select or selectMultiple, update and delete records in tables of the database
 *  \author    Filipe Marques
 *  \version   2.0.0
 *  \copyright &copy; 2014 2015 Filipe Marques GNU Lesser General Public License version 3
 */

class Database
{
    private $db, $query;
    private static $instance = null;
    
    private function __construct()
    {
        try
        {
            $this->db = new PDO('mysql:host='.Config::get('mysql/host').';dbname='.Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
            //echo("Connected !<br>");
        }
        catch (PDOException $e)
        {
            echo("Error!: " . $e->getMessage() . "<br/>");
            die();
        }
    }
    
    //! getInstance is a public static member function for creating a single instance of the object Database
    /*!  \return the created object of Database
    */
    public static function getInstance()
    {
        if(!isset(self::$instance))
            self::$instance = new Database();
        return self::$instance;
    }

    //! insert is a public member function for insert a new row in a table
    /*! \param table the name of the table
     *  \param params a array with the keys, that are the fields of table and the values are values to be inserted
     *  \return true if the transaction was sucessfull, otherwise false
    */
    public function insert($table, $params = array())
    {
        $keys = array_keys($params);
        $values = array_values($params);
        $sql = "INSERT INTO {$table}(`" . implode('`,`', $keys) ."`) VALUES ('" . implode("','", $values) . "')";
        $this->db->beginTransaction();
        $this->query = $this->db->exec($sql);
        //echo $sql;        
        if($this->query)
        {
            $this->db->commit();
            return true;
        }
        else
        {
            $this->db->rollBack();
            return false;
        }
    }

    //! select is a public member function for select a table with a given condition
    /*! \param table the name of the table
     *  \param where is the array with the condition
     *  \return the resulting row as an associative array 'key' => value
    */
    public function select($table, $where = array())
    {
        $sql = "";
        $operators = array('=','>','<','>=','<=');
        if(count($where) === 3)
        {
            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];
            if(in_array($operator, $operators))
            {
                $sql = "SELECT * FROM `{$table}` WHERE `{$field}` {$operator} '{$value}'";
                //echo $sql;
                $this->db->beginTransaction();
                $this->query = $this->db->prepare($sql);
                $this->query->execute();
                $this->db->commit();
                return $rows = $this->query->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    }

    //! selectMultiple is a public member function for select a table with multiple given conditions
    /*! \param table the name of the table
     *  \param where is the array with the condition and you can put multiple arrays with querys
     *  \return the resulting row as an associative array 'key' => value
    */
    public function selectMultiple($table, $where = array())
    {
        //echo count($where);
        $sql = "";
        $con = "";
        $operators = array('=','>','<','>=','<=');
        $f = 0;
        foreach($where as $w)
        {
            // extract the values of array row $w
            $er = array_values($w);
            if(count($er) === 3)
            {
                //echo count($er);
                $field = $er[0];
                $operator = $er[1];
                $value = $er[2];

                if(in_array($operator, $operators))
                {
                    if($f === 0)
                        $sql = " `{$field}` {$operator} '{$value}'";
                    else
                        $sql = " AND `{$field}` {$operator} '{$value}'";
                }
                ++$f;
                $con .= $sql;
            }
        }
        $sql1 = "SELECT * FROM `{$table}` WHERE";
        $result = $sql1.$con;
        //echo $result;
        $this->db->beginTransaction();
        $this->query = $this->db->prepare($result);
        $this->query->execute();
        $this->db->commit();
        return $rows = $this->query->fetchAll(PDO::FETCH_ASSOC);
    }

    //! delete is a public member function for deleting a row in a table with given condition and id
    /*! \param table the name of the table
     *  \param id the of id the table row to be updated
     *  \param fields a array with the keys, that are the fields of table and the values are values to be compared
     *  \return true if the transaction was sucessfull, otherwise false
    */
    public function update($table, $id, $fields = array())
    {
        $set = '';
        $d = 1;
        foreach($fields as $name => $value)
        {
            // preventing sql injection
            // concatenate
            $set .= "`{$name}` = '{$value}'";
            if($d < count($fields))
                // concatenate
                $set .= ', ';
            ++$d;
        }
        $sql = "UPDATE `{$table}` SET {$set} WHERE `id`={$id}";
        //echo $sql;
        $this->db->beginTransaction();
        $this->query = $this->db->exec($sql);        
        if($this->query)
        {
            $this->db->commit();
            return true;
        }
        else
        {
            $this->db->rollBack();
            return false;
        }
    }

    //! delete is a public member function for deleting a row in a table with given condition
    /*! \param table the name of the table
     *  \param where a array with the keys, that are the fields of table and the values are values to be compared
     *  \return true if the transaction was sucessfull, otherwise false
    */
    public function delete($table, $where = array())
    {
        $operators = array('=','>','<','>=','<=');
        if(count($where) === 3)
        {
            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];
        }
        if(in_array($operator, $operators))
        {
            $sql = "DELETE FROM `{$table}` WHERE `{$field}` {$operator} '{$value}'";
            //echo $sql;
            $this->db->beginTransaction();
            $this->query = $this->db->exec($sql);
            if($this->query)
            {
                $this->db->commit();
                return true;
            }
            else
            {
                $this->db->rollBack();
                return false;
            }
        }
    }
}
