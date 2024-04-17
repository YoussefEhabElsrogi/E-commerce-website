<?php
// Including necessary files
require_once './../connection/config.php';
require_once './../core/funtions.php';

// Checking if 'id' parameter is set and is numeric
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  redirectPage('products.php'); // Redirecting to 'products.php' if 'id' parameter is invalid
} else {
  $id = $_GET['id']; // Getting the value of 'id' parameter

  // Selecting the image path associated with the product
  $select = "SELECT `image` FROM `products` WHERE `id` = $id LIMIT 1"; // SQL query to select the image path
  $result = mysqli_query($conn, $select); // Executing the select query

  if (mysqli_num_rows($result) > 0) {

    // Checking if the query returned any rows

    $row = mysqli_fetch_array($result); // Fetching the row

    $rowImage = $row['image'];

    // Deleting the image file from the server

    deleteImage("./../upload/$rowImage"); // Calling the function to delete the image file

  }

  // Deleting the product from the database
  $delete = "DELETE FROM `products` WHERE id = $id"; // SQL query to delete the product
  $result = mysqli_query($conn, $delete); // Executing the delete query

  redirectPage('products.php');
}
