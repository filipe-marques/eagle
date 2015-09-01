<?php

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
	
	public static function getInstance()
	{
		if(!isset(self::$instance))
			self::$instance = new Database();
		return self::$instance;
	}

        //$this->error = false;
        /*
        $stmt = $dbh->prepare("INSERT INTO REGISTRY (name, value) VALUES (:name, :value)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':value', $value);

        // insert one row
        $name = 'one';
        $value = 1;
        $stmt->execute();
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
/*
    public function selectAllFrom($table)
    {
        $sql = "SELECT * FROM `{$table}`";
        //echo $sql;
        $this->db->beginTransaction();
        $this->query = $this->db->prepare($sql);
        $this->query->execute();
        $this->db->commit();
        return $rows = $this->query->fetchAll(PDO::FETCH_ASSOC);
    }
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

    //-------------------------------------------------------------------------------------------------------------------------
    
    /*
	public function querydb($queryString, $params = array())
	{
		$this->error = false;
		if($this->query = $this->db->prepare($queryString))
		{
			$z = 1;
			if(count($params))
			{
				foreach($params as $param)
				{
					$this->query->bindValue($z, $param);
					++$z;
				}
			}
			
			if($this->query->execute())
			{
				$this->result = $this->query->fetchAll(PDO::FETCH_OBJ);
				$this->count = $this->query->rowCount();
			}
			else
			{
				$this->has_error = true;
			}
		}
		return $this;
    }
	
	public function action($action, $table, $where = array())
	{
		if(count($where) === 3)
		{
			$operators = array('=','>','<','>=','<=');
			
			$field = $where[0];
			$operator = $where[1];
			$value = $where[2];
			
			if(in_array($operator, $operators))
			{
				$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
				if(!$this->querydb($sql, array($value))->error())
				{
					return $this;
					
				}
			}
		}
		return false;
	}
	
	public function get($table, $where)
	{
		return $this->action('SELECT *', $table, $where);
	}
	
	public function delete($table, $where)
	{
		return $this->action('DELETE', $table, $where);
	}
	
	public function insert($table, $fields = array())
	{
		if(count($fields))
		{
			$keys = array_keys($fields);
			$values = '';
			$x = 1;
			
			foreach($fields as $field)
			{
				$values .= '?';
				// are we at the end of ?
				if($x < count($fields))
				{
					// concatenate
					$values .= ', ';
				}
				++$x;
			}
			
			$sql = "INSERT INTO {$table} (`" . implode('`,`', $keys) ."`) VALUES ({$values})";
			
			if(!$this->querydb($sql, $fields)->error())
			{
				return true;
			}
		}
		return false;
	}
	
	public function update($table, $id, $fields = array())
	{
		$set = '';
		$d = 1;
		
		foreach($fields as $name => $value)
		{
			// preventing sql injection
				// concatenate
			$set .= "{$name} = ?";
			if($d < count($fields))
			{
				// concatenate
				$set .= ', ';
			}
			
			++$d;
		}
		
		$sql = "UPDATE {$table} SET {$set} WHERE id={$id}";
		
		if(!$this->querydb($sql, $fields)->error())
		{
			return true;
		}
		return false;
	}
	
	public function results()
	{
		return $this->result;
	}

	public function first()
	{
		return $this->results()[0];
	}
    	
	public function has_count()
	{
		return $this->count;
	}
	
	public function error()
	{
		return $this->has_error;
	}
    */
}
