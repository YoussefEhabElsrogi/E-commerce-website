<?php

function getRequestType()
{
  return $_SERVER['REQUEST_METHOD'];
}
function postMethod()
{
  if (getRequestType() === 'POST') {
    return true;
  }
  return false;
}
function issetPostInput($input)
{
  return isset($_POST[$input]);
}
function reciveInput($input)
{
  return htmlspecialchars(htmlentities(stripcslashes(trim($input))));
}
function redirectPage(string $path)
{
  header("Location: $path");
  exit;
}
function checkItemInArray($input, array $array): bool
{
  return in_array($input, $array);
}
function checkEmail($email)
{
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return true;
  }
  return false;
}
function hashPassword($password)
{
  return password_hash($password, PASSWORD_DEFAULT);
}
function passwordVerified($password, $hashedPassword)
{
  return password_verify($password, $hashedPassword);
}
function issetValue($value)
{
  return isset($value);
}
function deleteImage($pathImage)
{
  unlink($pathImage);
}
