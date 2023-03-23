<?php
  require("../php/pizzas.php");

  $db = new database();
  $pizzas = new pizzas($db);

  $pizza_id = $_GET['id'];
  $name = $_GET['name'];
  $pizza_id = $pizzas->set_pizza_name($pizza_id, $name);

  echo $pizza_id;
?>