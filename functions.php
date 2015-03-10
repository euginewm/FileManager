<?php

define ('PHP_FILE_EXTENSION', '.php');

spl_autoload_register(function ($name) {
  $name = str_replace('\\', '/', $name);
  if (file_exists(PATH . '/' . $name . PHP_FILE_EXTENSION)) {
    include PATH . '/' . $name . PHP_FILE_EXTENSION;
  }
});

function genCSRFProtection() {
  if (!isset($_SESSION['secret'])) {
    $_SESSION['secret'] = md5(uniqid(rand(), true));
  }
  $gen = md5(uniqid(rand(), true));
  $token = hash_hmac('md5', $gen, $_SESSION['secret']);
  $form = $gen;

  $output = <<<OUTPUT
<input type="hidden" name="form" value="$form" />
<input type="hidden" name="csrf" value="$token" />
OUTPUT;

  return $output;
}

function _hash($data) {
  return sha1($data);
}
