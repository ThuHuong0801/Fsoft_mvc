<?php

/**
 * Twig
 */
require_once dirname(__DIR__) . '/vendor/Twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();

/**
 * Autoloader
 */
spl_autoload_register(callback: 'autoloader');
function autoloader($class)
{
    require_once '../' . str_replace('\\','/', $class) . '.php';
}
/**
 * controller
 */
// $controller = new \App\Controllers\UserController();

$router = new \Core\Router();
$router->register('get','/users/detail/1', [App\Controllers\UserController::class, 'detailOne']);
$router->register('get','/users/{name}/{id}', [App\Controllers\UserController::class, 'detailByName']);
$router->register('get','/users/detail/{id}', [App\Controllers\UserController::class, 'detailByID']);
$router->register('get','/posts/index', [App\Controllers\PostsController::class]);
// echo $_SERVER['REQUEST_URI'] . '<br>';
// echo "<pre>";
// print_r($router->getRoute());
// echo "</pre>";
$route = $router->getRoute();
// var_dump($route);
$controller = new $route['controller'][0];
$action = $route['action'];

call_user_func_array([$controller, $action], $route['params']);