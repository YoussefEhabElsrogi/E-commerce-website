<?php

require_once './../connection/config.php';
require_once './../core/funtions.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  redirectPage('products.php');
} else {

  $id = $_GET['id'];

  $delete = "DELETE FROM `products` WHERE id = $id";

  $result = mysqli_query($conn, $delete);

  redirectPage('products.php');

}
