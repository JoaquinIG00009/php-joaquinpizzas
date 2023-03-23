<?php
  require("../php/pizzas.php");
  require("../php/ingredients.php");

  $db = new database();
  $pizzas = new pizzas($db);
  $ingredients = new ingredients($db);

  $pizza_id = $_GET['pizza'];
  $name = $_GET['name'];
  $price = $_GET['price'];
  $ingredient_id = $ingredients->add($name, $price);
  $pizzas->add_ingredient($pizza_id, $ingredient_id);
  echo $ingredient_id;
?>