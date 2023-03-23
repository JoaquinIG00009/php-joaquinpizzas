<?php
	class database {
	  private $servername ='localhost';
	  private $username='root';
	  private $password='';
	  private $dbname='pizza_db';
	  private $result=array();
	  private $mysqli;

	  public function __construct() {
	  	$this->mysqli = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
	  }

	  public function insert($table, $params=array()) {
		  $table_columns = implode(',', array_keys($params));
		  $table_value = implode("','", $params);

		  $sql = "INSERT INTO $table($table_columns) VALUES ('$table_value')";

		  return $this->mysqli->query($sql);
	  }

	  public function last($table, $field) {
		  $sql = "SELECT $field FROM `$table` ORDER BY $field DESC";

		  return $this->mysqli->query($sql)->fetch_row()[0];
	  }

	  public function update($table, $params=array(), $id) {
	    $args = array();

	    foreach ($params as $key => $value) {
	        $args[] = "$key = '$value'"; 
	    }

	    $sql = "UPDATE  $table SET " . implode(',', $args);
	    $sql .= " WHERE $id";

	    return $this->mysqli->query($sql);
	  }

	  public function delete($table, $id) {
	    $sql = "DELETE FROM $table";
	    $sql .= " WHERE $id ";
	    return $this->mysqli->query($sql);
	  }

	  public function select($table, $rows="*", $where = null, $order=null) {
	    if ($where != null) {
			if($order == null) {
				$sql = "SELECT $rows FROM `$table` WHERE $where";
			} else {
				$sql = "SELECT $rows FROM `$table` WHERE $where ORDER BY $order";
			}
	    } else {
	        $sql = "SELECT $rows FROM `$table`;";
	    }
	    return $this->mysqli->query($sql);
	  }

	  public function query($sql) {
		return $this->mysqli->query($sql);
	  }

	  public function __destruct() {
	    $this->mysqli->close();
	  }
	}
?>