<?php
/**
 * @var $view_content string with rendered content
 * @var $page_title string page title
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Chat <?php print $page_title; ?></title>

  <!-- Bootstrap -->
  <link href="/theme/css/bootstrap.min.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
<div class="wrapper">
  <div class="content-main">

    <h1><?php print $page_title; ?></h1>

    <?php print $view_content; ?>


  </div>
  <div class="content-secondary">
    <?php include PATH . '/theme/sys-message.php'; ?>
  </div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/theme/js/bootstrap.min.js"></script>
<script src="/theme/js/jquery.rest.min.js"></script>
<script src="/theme/js/chat.js"></script>
</body>
</html>
