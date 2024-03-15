<?php

  include 'app.php';

  $app = new App();

  $app->init();
  $app->handle($_REQUEST['path']);

?>