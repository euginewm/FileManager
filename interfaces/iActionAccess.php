<?php

namespace interfaces;


interface iActionAccess {
  public function access($AccessName, $params = []);
}
