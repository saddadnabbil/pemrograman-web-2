<?php

// mengaktifkan error reportikng(matikan saat produksi)
error_reporting(E_ALL);
ini_set('display error', 1);
define('PROTOCOL', ((isset($_SERVER['HTTPS'])) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http');
define('HOST', $_SERVER['HTTP_HOST']);
define('BASE_PATH', __DIR__);
define('APP_FOLDER', BASE_PATH . DIRECTORY_SEPARATOR . 'apps');

include "config/database.php";
include "config/MY_Helper.php";
include "config/My_Controller.php";
