<?php
	require_once("db.php");

	class pizzas {
		private $db;
		private $table_p = "pizza";
    private $table_p_i = "pizza_ingredients";

    public function __construct($db) {
      $this->db = $db;
    }

    public function pizza_list() {
      return $this->db->select($this->table_p);
    }

    public function pizza_name($id) {
      return $this->db->select($this->table_p, rows: 'name', where: 'id='.$id)->fetch_row()[0];
    }

    public function set_pizza_name($id, $name) {
      if ($id == 0) {
        if ($this->db->insert($this->table_p, params: [ 'name' => $name ])) {
          $id = $this->db->last($this->table_p, 'id');
        }
      }
      else {
        $this->db->update($this->table_p, params: [ 'name' => $name ], id: 'id='.$id);
      }
      return $id;
    }

    public function delete($id) {
      $this->db->delete($this->table_p, 'id='.$id);
    }

    public function cost($id) {
      $sql = "SELECT SUM(cost_price) AS total_price FROM $this->table_p_i JOIN ingredients ON $this->table_p_i.ingredient_id = ingredients.id WHERE $this->table_p_i.pizza_id = $id;";
      $total = $this->db->query($sql)->fetch_row()[0];
      
      return $total * 1.5;
    }
	
    public function ingredients($id) {
      return $this->db->select($this->table_p_i, rows: 'ingredient_id', where: 'pizza_id='.$id, order: 'position');
    }

    public function add_ingredient($pizza_id, $ingredient_id) {
      $position = $this->db->select($this->table_p_i, where: 'pizza_id='.$pizza_id)->num_rows + 1;
      $this->db->insert($this->table_p_i, [ 'pizza_id' => $pizza_id, 'ingredient_id' => $ingredient_id, 'position' => $position ]);
    }

    public function remove_ingredient($pizza_id, $ingredient_id) {
      $this->db->delete($this->table_p_i, 'pizza_id='.$pizza_id.' and ingredient_id='.$ingredient_id);
    }

    public function move_ingredient($pizza_id, $ingredient_id, $position) {
      $all_ingridients = $this->db->select($this->table_p_i, where: 'pizza_id='.$pizza_id, order: 'position');

      $array_before = [];
      $array_after = [];

      foreach ($all_ingridients as $ingredient) {
        if ($ingredient['ingredient_id'] == $ingredient_id) {
          $current_ingredient = $ingredient;
        } else if(count($array_before) < $position-1) {
          array_push($array_before, $ingredient);
        } else {
          array_push($array_after, $ingredient);
        }
      }

      print_r($array_before);
      print_r($current_ingredient);
      print_r($position);
      print_r($array_after);

      $array_final = array_merge($array_before, array($current_ingredient), $array_after);
      $current_position = 1;

      foreach ($array_final as $item) {
        if($item['position'] != $current_position) {
          $this->db->update($this->table_p_i, ['position'=>$current_position], 'pizza_id='.$pizza_id.' and ingredient_id='.$item['ingredient_id']);
        }
        $current_position++;
      }
    }
	}
?>