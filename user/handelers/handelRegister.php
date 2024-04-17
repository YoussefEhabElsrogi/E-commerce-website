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

  // Validate the 'name' field
  if (requiredInput($name)) {
    $errors[] = 'The name field is required';
  } elseif (minInput($name, 6)) {
    $errors[] = 'The name must be at least 6 characters long';
  } elseif (maxInput($name, 15)) {
    $errors[] = 'The name must not exceed 15 characters';
  }

  // Validate the 'email' field
  if (requiredInput($email)) {
    $errors[] = 'The email field is required';
  } elseif (checkEmail($email)) {
    $errors[] = 'Please enter a valid email address';
  }

  // Validate the 'password' and 'confirm password' fields
  if (requiredInput($password)) {
    $errors[] = 'password field are required';
  } elseif (minInput($password, 8)) {
    $errors[] = 'The password must be at least 8 characters long';
  } elseif (maxInput($password, 20)) {
    $errors[] = 'The password must not exceed 20 characters';
  }
  // Check for existing user
  $query = "SELECT * FROM `users` WHERE `email` = '$email'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $errors[] = 'User already exists';
  }

  // If no errors, proceed with user registration
  if (requiredInput($errors)) {

    $hashPassword = hashPassword($password);

    $insert = "INSERT INTO  `users` (name,email,password) VALUES ('$name' , '$email' , '$hashPassword')";

    $result = mysqli_query($conn, $insert);

    redirectPage('./../login.php');

  } else {
    sessionStore('errors', $errors);
    redirectPage('./../register.php');
  }


} else {
  redirectPage('./../register.php');
}


