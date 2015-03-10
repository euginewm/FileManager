<?php

namespace classes;


use interfaces\iSysMessage;

class SysMessage implements iSysMessage {

  private static $messages = [];

  public function set($message) {
    self::$messages[] = $message;
  }

  public function get() {
    return self::$messages;
  }

  public function clear() {
    self::$messages = [];
  }
}
