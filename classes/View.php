<?php

namespace classes;


use interfaces\iView;

class View implements iView {

  public function render($tpl, $variables = []) {
    ob_start();
    extract($variables);
    include PATH . '/theme/' . $tpl . '.php';
    $output = ob_get_contents();
    ob_clean();
    return $output;
  }

  public function renderJSON($data) {
    return json_encode($data);
  }
}
