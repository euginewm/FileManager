<?php

/**
 * Заготовка, на данный момент не используется
 * права доступа реализованы классом ActionAccess
 */

namespace classes;


use interfaces\iIUserAdmin;

class UserAdmin extends User implements iIUserAdmin {

  public function ChangeStatus() {
    // TODO: Implement ChangeStatus() method.
  }
}
