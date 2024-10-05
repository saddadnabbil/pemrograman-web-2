<?php

//buat fungsi untuk mengambil controller dari URL

function uri_segment($idx = 0)
{
	$str = str_replace(URINAME, "", $_SERVER['REQUEST_URI']);
	$pos = strpos($str, '?');

	//var_dump($_SERVER['REQUEST_URI']); echo $str; exit; ///native/myapi/test
	if ($pos !== false) $str = substr($str, 0, $pos);

	$segments = explode('/', $str);
	//var_dump($segments);exit;
	//exit; ///native/myapi/test
	if (isset($segments[$idx])) return $segments[$idx];
	else return '';
}


function getController()
{
	//ambil urisegment utk controller
	$controlername = uri_segment(2) == '' ? $controlername = DEFAULT_CONTROLLER : uri_segment(2);
	//echo uri_segment(2).'<br>'; echo $controlername; exit;
	$c1 = APP_FOLDER . "\controllers" . DIRECTORY_SEPARATOR . "$controlername.php";
	$c2 = APP_FOLDER . "\controllers" . DIRECTORY_SEPARATOR . uri_segment(2) . DIRECTORY_SEPARATOR . uri_segment(3) . ".php";
	$c3 = APP_FOLDER . "\modules" . DIRECTORY_SEPARATOR . uri_segment(2) . DIRECTORY_SEPARATOR . "controllers" . DIRECTORY_SEPARATOR . uri_segment(3) . ".php";
	//echo $c1.'<br>'.  $c2.'<br>'.  $c3.'<br>'; exit;

	//cek method di dalam controller
	if (file_exists($c1)) {
		$method = uri_segment(3) == '' ? 'index' : uri_segment(3);
		$params = uri_segment(4);
		//echo $method.'<br>'.$params;exit;
		InController($c1, $controlername, $method, $params);
	} elseif (file_exists($c2)) {
		$method = uri_segment(4) == '' ? 'index' : uri_segment(4);
		$params = uri_segment(5);
		//echo $method.'<br>'.$params;exit;
		InController($c2, uri_segment(3), $method, $params);
	} elseif (file_exists($c3)) {
		$method = uri_segment(2) == '' ? 'index' : uri_segment(2);
		$params = uri_segment(3);
		InController($c3, uri_segment(1), $method, $params);
	} else {
		echo "File Controller " . $controlername . ".php Not Found!";
		//include APP_FOLDER .DIRECTORY_SEPARATOR."views/notfound.php";
		//include APP_FOLDER .DIRECTORY_SEPARATOR."error.php";
		exit;
	}
}

function InController($path, $controlername, $method, $params)
{
	require_once $path;
	$controller = new $controlername();
	if (method_exists($controller, $method)) {
		$controller->$method($params);
	} else {
		// Fungsi home() tidak ada
		echo "Function/Method $method In Controller " . $controlername . ".php Not Found.";
		exit;
	}
}

getController();
