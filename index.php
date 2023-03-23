<?php
  require("php/pizzas.php");

  $db = new database();
  $pizzas = new pizzas($db);
  $pizzas_list = $pizzas->pizza_list();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/main.js"></script>

    <title> MCO_Test - Joaquin Inthamoussu </title>
  </head>

  <body>
    <div class="container main-c">
      <div class="container-title"><h1 class="w"> Joaquin Pizza's </h1></div>

      <div class="container-p">
        <div class="pizzas">
          <?php foreach ($pizzas_list as $pizza): ?>
            <div id="p-<?= $pizza['id'] ?>" class="pizza"> 
              <button class="small-c-btn" type="submit" onclick="removePizza(<?= $pizza['id'] ?>);">
                <img src="images/trash.png" alt="buttonpng" width="30" height="30"/>
              </button>
              <img src="images/pizza.png" alt="Pizza" width="168" height="168" onClick="parent.location='pizza_info.php?id=<?= $pizza['id'] ?>'">
              <label class="name center w" onClick="parent.location='pizza_info.php?id=<?= $pizza['id'] ?>'"><?= $pizza['name'] ?></label>
              <label class="right w"><span id="selling_price"><?= number_format($pizzas->cost($pizza['id']), 2) ?></span> €</label>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="add-pizza">
          <button class="small-add-btn" type="submit" onClick="parent.location='pizza_info.php'" >
            <img src="images/add.png" alt="buttonpng" width="50" height="50"/>
          </button>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>