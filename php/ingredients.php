<?php
	require_once("db.php");

	class ingredients {
		private $db;
		private $table_i = "ingredients";

		public function __construct($db) {
			$this->db = $db;
		}

    public function get($id) {
      return $this->db->select($this->table_i, where: 'id='.$id)->fetch_object();
    }

    public function delete($id) {
      return $this->db->delete($this->table_i, where: 'id='.$id);
    }

		public function add($name, $price) {
			$this->db->insert($this->table_i, [ 'name' => $name, 'cost_price' => $price ]);
			return $this->db->last($this->table_i, 'id');
		}
	}
?>