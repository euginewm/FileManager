<?php

namespace classes;

use interfaces\iRouter;

class Router implements iRouter {

  private static $IntArguments = [];
  private static $AllArguments = [];

  // TODO: implements all arguments parser

  public function getRequest() {
    // TODO: change to pattern
    $requestURI = $_SERVER['REQUEST_URI'];
    preg_match_all('/\d+/', $requestURI, $matches);
    if (!empty($matches[0])) {
      foreach ($matches[0] as $int) {
        self::$IntArguments[] = (int) $int;
        $requestURI = preg_replace("/$int/", ':int', $requestURI);
      }
    }
    return $requestURI;
  }

  public function getPost($param) {
    // TODO: check variable
    $value = !empty($_POST[$param]) ? htmlspecialchars($_POST[$param]) : null;
    return $value;
  }

  public function getRequestType() {
    return $_SERVER['REQUEST_METHOD'];
  }

  public function checkCSRFProtection() {
    if (!empty($_POST)) {
      $form = $this->getPost('form');
      if (hash_hmac('md5', $form, $_SESSION['secret']) != $this->getPost('csrf')) {
        echo "No CSRF allowed!";
        die();
      }
    }
  }

  public function gotoPath($path) {
    header("Location: $path");
  }

  public function getArgs($type) {
    switch ($type) {
      case 'int':
        return self::$IntArguments;
        break;

      default:
        return self::$AllArguments;
        break;
    }
  }

  public function getArg($type, $index) {
    switch ($type) {
      case 'int':
        return self::$IntArguments[$index];
        break;
      default:
        return self::$AllArguments[$index];
        break;

    }
  }

  public function isPost() {
    return !empty($_POST);
  }
}
