<?php

require_once './../connection/config.php';
require_once './../core/funtions.php';

$id = $_GET['id'];

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  redirectPage('card.php');
} else {

  $delete = "DELETE FROM `carts` WHERE id = '$id'";

  $result = mysqli_query($conn, $delete);

  redirectPage('card.php');
}