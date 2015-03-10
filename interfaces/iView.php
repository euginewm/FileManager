<?php

namespace interfaces;


interface iView {
  public function render($tpl);

  public function renderJSON($data);
}
