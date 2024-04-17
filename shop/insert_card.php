<?php

require_once './../connection/config.php';
require_once './../core/funtions.php';

if (postMethod() && issetPostInput('add')) {

  foreach ($_POST as $key => $value) {
    $$key = reciveInput($value);
  }

  if (isset($name) && isset($price)) {

    $insert = "INSERT INTO `carts` (name,price) VALUES ('$name' , '$price')";

    $result = mysqli_query($conn, $insert);

    redirectPage('card.php');

  } else {
    redirectPage('shop.php');
  }

}