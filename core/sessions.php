<?php

function sessionStore($key, $value)
{
  $_SESSION[$key] = $value;
}
function issetSession($key)
{
  return isset($_SESSION[$key]) ?? '';
}
function removeSession($key)
{
  unset($_SESSION[$key]);
}