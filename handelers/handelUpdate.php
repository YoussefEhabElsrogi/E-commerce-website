<?php

session_start();

require_once './../connection/config.php';
require_once './../inc/funtions.php';
require_once './../inc/validation.php';
require_once './../inc/sessions.php';

$errors = [];

if (postMethod() && issetPostInput('update')) {

  $id = $_POST['id'];

  foreach ($_POST as $key => $value) {
    $$key = reciveInput($value);
  }

  // Validate the 'name' field
  if (requiredInput($name)) {
    $errors[] = 'The name field is required';
  } elseif (minInput($name, 6)) {
    $errors[] = 'The name must be at least 6 characters long';
  } elseif (maxInput($name, 15)) {
    $errors[] = 'The name must not exceed 15 characters';
  }

  // Validate the 'price' filed
  if (requiredInput($price)) {
    $errors[] = 'The price filed is required';
  }

  // Validate the 'image' field
  $file = $_FILES['image'];
  $name_image = $file['name'];
  $size_image = $file['size'];
  $error = $file['error'];
  $tmp_name = $file['tmp_name'];

  if (!requiredInput($name_image)) {
    $ext = pathinfo($name_image);
    $originalName = $ext['filename'];
    $originalExtension = $ext['extension'];
    $allowedExtensions = ['gif', 'png', 'jpg', 'webp', 'jpeg'];
    if (checkItemInArray($originalExtension, $allowedExtensions)) {
      if ($error == UPLOAD_ERR_OK) {
        $newName = uniqid('', true) . '.' . $originalExtension;
        $destination = '../upload/' . $newName;
        if (!move_uploaded_file($tmp_name, $destination)) {
          $errors[] = 'Failed to move the uploaded file';
        }
      } else {
        $errors[] = 'There was an error uploading your file';
      }

    } else {
      $errors[] = 'The file type is not allowed';
    }

  } else {
    $errors[] = 'Please choose an image';
  }


  if (requiredInput($errors)) {

    $update = "UPDATE `products` SET `name` = $name ,`price` = $price , $image = '$newName' WHERE id = $id ";

    mysqli_query($conn, $update);

    mysqli_close($conn);

    sessionStore('success', 'Your data is updated');

    redirectPage('./../products.php');

  } else {
    sessionStore('errors', $errors);
    redirectPage('./../update.php');
  }

} else {
  redirectPage('./../index.php');
}