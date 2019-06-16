<?php
header('Access-Control-Allow-Origin: *');
//incluye la carga automatica de dependencias 
(file_exists('./vendor/autoload.php')) ? require_once './vendor/autoload.php' : die('Dependencias no Cargadas!');

use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;

//instancia del controlador de rutas
$router = new RouteCollector();

$baseUrl = function () {
    //establecer la ruta glopal base del proyecto
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $baseDir = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

    $host = array_key_exists('HTTP_HOST', $_SERVER) ? $_SERVER['HTTP_HOST'] : gethostbyaddr($_SERVER["REMOTE_ADDR"]);
    return $protocol . $host . $baseDir;
};

define('BASE_URL', $baseUrl());

$url = isset($_GET['url']) ? $_GET['url'] : '/';

$router->controller('/', App\Controllers\IndexController::class);
$router->controller('/hoteles', App\Controllers\AdminController::class);

//generar vistas de aplicacion
try {
    $dispatcher = new Dispatcher($router->getData());
    echo $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $url);
} catch (Phroute\Phroute\Exception\HttpRouteNotFoundException $errorExp) {
    include_once './template/errors/404.php';
} catch (Phroute\Phroute\Exception\HttpMethodNotAllowedException $errorExp) {
    include_once './template/errors/405.php';
}
