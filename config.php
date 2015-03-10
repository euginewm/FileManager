<?php

$config = [
  'db' => [
    'server' => '127.0.0.1',
    'database' => 'filebase',
    'login' => 'root',
    'password' => 'root',
  ],
];

define ('PATH', __DIR__);

define('MAX_FILES_PER_USER', 20);
define('MAX_UPLOAD_FILE_SIZE', 1); // MB
define('UPLOAD_FILES_DIR', '/uploadFiles');

$month_list = [
  'January',
  'February',
  'March',
  'April',
  'May',
  'June',
  'July',
  'August',
  'September',
  'October',
  'November',
  'December',
];
