<?php
// Mengaktifkan error reporting untuk debugging (matikan pada produksi)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Mendapatkan nilai dari URL
define('PROTOCOL'	, ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http"));
define('HOST'		, $_SERVER['HTTP_HOST']);
define('URINAME' 	, str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']));
define('BASE_PATH'	, __DIR__);
define('DEFAULT_CONTROLLER', 'welcome');

//definisi Path Aplikasi
define('APP_FOLDER'	, BASE_PATH.DIRECTORY_SEPARATOR.'apps');

//echo APP_FOLDER;exit;
include "config/database.php";
include "config/MY_helper.php";
include "config/MY_Controller.php";
include "config/routes.php";



exit;
// Memulai sesi
session_start();

// Fungsi autoload untuk memuat controller secara otomatis
function autoload_controllers($class_name) {
    $file = __DIR__ . '/controllers/' . $class_name . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
}

// Mendaftarkan autoloader
spl_autoload_register('autoload_controllers');

// Mendapatkan URL dari request
$url = isset($_GET['url']) ? $_GET['url'] : 'home';  // Default ke 'home'

// Memproses URL
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);


$controlername = uri_segment() == '' ? $controlername = DEFAULT_CONTROLLER : uri_segment(); 
echo $controlername;
print_r($url); exit;
// Nama controller (dengan suffix 'Controller')
$controller_name = ucfirst(strtolower($url[0])) . 'Controller';

// Nama method (default ke 'index')
$method_name = isset($url[1]) ? $url[1] : 'index';

// Mengecek apakah file controller ada
if (file_exists('controllers/' . $controller_name . '.php')) {
    // Memuat controller
    $controller = new $controller_name;

    // Mengecek apakah method di controller ada
    if (method_exists($controller, $method_name)) {
        // Memanggil method dengan parameter jika ada
        call_user_func_array([$controller, $method_name], array_slice($url, 2));
    } else {
        echo "Method '$method_name' tidak ditemukan di controller '$controller_name'.";
    }
} else {
    echo "Controller '$controller_name' tidak ditemukan.";
}
