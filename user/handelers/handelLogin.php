<?php
// Start session and include necessary files
session_start();
require_once './../../connection/config.php';
require_once './../../core/funtions.php';
require_once './../../core/validation.php';
require_once './../../core/sessions.php';

// Initialize errors array
$errors = [];

// Check if the form was submitted
if (postMethod()) {
  // Sanitize and retrieve input data
  foreach ($_POST as $key => $value) {
    $$key = reciveInput($value);
  }

  // Validate the 'email' field
  if (requiredInput($email)) {
    $errors[] = 'The email field is required';
  } elseif (checkEmail($email)) {
    $errors[] = 'Please enter a valid email address';
  }

  // Validate the 'password' field
  if (requiredInput($password)) {
    $errors[] = 'The password field is required';
  }

  $select = "SELECT * FROM `users` WHERE `email` = '$email'";

  $result = mysqli_query($conn, $select);

  if (!mysqli_num_rows($result) > 0) {
    $errors[] = 'Incorrect password or email';
  }

  if (requiredInput($errors)) {

    if (mysqli_num_rows($result) > 0) {

      $user = mysqli_fetch_assoc($result);

      $hashPassword = $user['password'];

      if (passwordVerified($password, $hashPassword)) {

        sessionStore('user_id', $user['id']);

      }

    }
    redirectPage('./../index.php');

  } else {
    sessionStore('errors', $errors);
    redirectPage('./../login.php');
  }

}