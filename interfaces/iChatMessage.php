<?php

namespace interfaces;

interface iChatMessage extends iCrud {
  public function getMessageOwnerId($message_id);
}
