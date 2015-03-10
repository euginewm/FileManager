<?php

use classes\DependenciesContainer;

$SysMessage = DependenciesContainer::init('SysMessage');

?>

<?php foreach ($SysMessage->get() as $item): ?>
  <div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Error:</span>

    <div><?php print $item; ?></div>
  </div>
<?php endforeach; ?>
<?php $SysMessage->clear(); ?>

