<?php

namespace interfaces;


interface iRouter {
  public function getRequest();

  public function getPost($param);

  public function checkCSRFProtection();

  public function gotoPath($path);

  public function getArgs($type);

  public function getArg($type, $index);
}
