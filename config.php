<?php
// Always provide a TRAILING SLASH (/) AFTER A PATH
define('LIBS', 'libs/');
define('TEMP', '/');
define('URL', 'http://'.$_SERVER['HTTP_HOST'].TEMP);
define('ROOT', $_SERVER['DOCUMENT_ROOT'].TEMP);
define('CACHE', ROOT.'cache/');
define('UPLOAD', URL.'uploads/');
define('VIDEOS', UPLOAD.'videos/');
define('IMAGES', UPLOAD.'images/');
define('NUMPP', 20);

define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'datuna');
define('DB_USER', 'test');
define('DB_PASS', 'test');

// The sitewide hashkey, do not change this because its used for passwords!
// This is for other hash keys... Not sure yet
define('HASH_GENERAL_KEY', 'MixitUp200');

// This is for database passwords only
define('HASH_PASSWORD_KEY', 'catsFLYhigh2000miles');


