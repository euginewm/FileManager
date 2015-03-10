<?php

namespace interfaces;


interface iChatRoom extends iCrud {
  public function attachUser();

  public function attachMessage();

  public function getRoomList();

  public function getRoomUsers($room_id);

  public function getRoomMessages($room_id);

  public function gotoRoom($room_id);

  public function filterActiveMessages($messages_list);
}
