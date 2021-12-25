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


// session_start();
// echo '<p style="color: red; font-size: 1.2rem;">'. @$_SESSION['message'].'</p>';
// unset($_SESSION['message']);
$app = new \app\Web();
?>