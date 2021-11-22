<?php
require '../vendor/autoload.php';
include 'conn.php';
include 'services/Service.class.php';
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
$loader = new FilesystemLoader('../views');
$twig = new Environment($loader);
session_start();

$check = new UserService();
$status = $check -> validateLoggedIn($pdo);
$user = $check -> getUser($status, $pdo);

$url = explode("/", $_SERVER['REQUEST_URI']);
$resource = '';
$method = '';
$event = '';
if (empty($url[1])) {
    $resource = 'Home';
    $method = 'index';
} else {
    $resource = ucfirst($url[1]);
}
if (isset($url[2])) {
    $method = $url[2];
}
if (isset($url[3])) {
    $_SESSION['event'] = $url[3];
    $event = $url[3];
}

$Path = "controllers/{$resource}Controller.class.php";


if (file_exists($Path)) {
    include($Path);
    $class = "{$resource}Controller";
    $new = new $class();
    if (method_exists($new, $method)) {
        echo $new -> $method($status, $pdo, $event, $user, $loader, $twig);
    } else {
        header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
        include("notFound.php");
        echo'1';
    }
} else {
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
    include("notFound.php");
    echo'2';
}    

?>