<?php

session_start();

$errors = [];

foreach ($_POST as $key => $value) {
  $$key = reciveInput($value);
}


