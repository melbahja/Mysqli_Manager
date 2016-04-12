<?php
/**
* @author Mohamed Elbahja <Mohamed@elbahja.me>
* @copyright 2016 
* @version 1.0
* @package MySQLi_Manager 
*/

if (!class_exists('mysqli_manger')):

class mysqli_manger {

	private $db_connect, $select, $insert, $update, $delete, $insert_id, $insert_ids, $result;
	public $charset = 'utf8';
	public $num_rows = 0;

    function __construct() {
    	$this->reset();
    	unset($this->num_rows);
    	return;
    }

	/* Get DB conn */
  public function conn() {
      $this->db_connect = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
		if ($this->db_connect->connect_error) {
		     die("Failed connect to MySQL");
		     return;
		}
	  return $this->db_connect;
  }
   
   	/** 
    *  escape data
    */
   public function escape($data) {
   	  return $this->db_connect->real_escape_string($data);
   }
    /* charset query */
    protected function charset() {
	$this->db_connect->query("SET NAMES '$this->charset'");
        $this->db_connect->query("SET CHARACTER SET $this->charset");
    }

   public function select($select, $from, $where = '') {
      $this->result = null;
      $this->charset();
		if($this->select = $this->db_connect->query("SELECT {$select} FROM {$from} {$where}")) {
		   $this->result = $this->select->fetch_assoc();
		   $this->num_rows = $this->select->num_rows;
		   $this->select->close();
		   unset($select, $from, $where);
		}   
	  return $this->result;	
    }

   public function loopselect($select, $from, $where = '') {
	    $this->result = null;
	    $this->charset();
            $this->result = $this->db_connect->query("SELECT {$select} FROM {$from} {$where}");
   	   unset($select, $from, $where);
	  return $this->result;	
   	
   }

  public function insert($into, $array) {
        $return = FALSE;
        $data = array();
		foreach ($array as $key => $value) {
			$data[] = $this->escape($key)."='".$this->escape($value)."'";
		}
	   $data = implode(', ', $data);
	   $this->charset();
		  if ($this->insert = $this->db_connect->query("INSERT INTO {$into} SET {$data}") ) {
		  	$this->insert_id = $this->db_connect->insert_id;
		  	unset($into, $array, $data);
		  	$return = TRUE;
		  }
	return $return;  
   }

    public function multi_insert($into, $array) {
        $ids = array();
        foreach($array as $val) {
	          if(!is_array($val)) {
	             unset($into, $array);
	              return FALSE;
	          }   
        }
        foreach ($array as $key => $values) {
          if($this->insert($into, $values) === FALSE) $key = FALSE;
          $ids[$key] = $this->insert_id();	
        }
        $this->insert_ids = $ids;
		unset($into, $array, $ids);
		if (empty(array_filter($this->insert_ids))) return FALSE; 
		return TRUE; 		
    }

  public function update($table, $array, $where = '') {
	$return = FALSE;
        $data = array();
		foreach ($array as $key => $value) {
			$data[] = $this->escape($key)."='".$this->escape($value)."'";
		}
	   $data = implode(', ', $data);
	   $this->charset();
		  if ($this->update = $this->db_connect->query("UPDATE {$table} SET {$data} {$where}") ) {
		  	unset($table, $array, $where, $data);
		  	$return = TRUE;
		  }
	return $return;	   
   }

  public function delete($from, $where = '') {
	$return = FALSE;
	     if ($this->delete = $this->db_connect->query("DELETE FROM {$from} {$where}")) {
		 	unset($from, $where);
		 	$return = TRUE;
	     }
       return $return;
  }

	public function query($query) {
		return $this->db_connect->query($query);
	}

	public function insert_id() {
		return $this->insert_id;
	}

	public function insert_ids() {
		return $this->insert_ids;
	}

	protected function reset(){
		unset($this->conn()->affected_rows, $this->conn()->connect_errno, $this->conn()->connect_error, $this->conn()->error_list, $this->conn()->field_count, $this->conn()->insert_id, $this->conn()->warning_count);
	}

	public function close() { 
		$this->reset();
		unset($this->db_connect, $this->select, $this->num_rows, $this->insert, $this->update, $this->delete, $this->insert_id, $this->charset, $this->insert_ids, $this->result);
               $this->conn()->close();
	}

	private function __clone() { }
}

endif;
