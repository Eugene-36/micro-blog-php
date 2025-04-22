<?php

//DB SETTINGS

define('DB_HOST', 'db');
define('DB_NAME', 'microblog');
define('DB_USER', 'root');
define('DB_PASS', 'zerosql');


define('ROOT', dirname(__FILE__) . '/');
define('HOST', 'https://' . $_SERVER['HTTP_HOST'] . '/');

// Макс размер файла для загрузки
define('MAX_UPLOAD_FILE_SIZE', 10 * 1024 * 1024);

$allowed_file_types = [
  'image/jpeg',
  'image/png',
  'image/gif'
];
$allowed_extension = [
'jpg','jpeg','png','gif'
];


session_start();