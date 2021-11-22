<?php
class HomeController
{
    public function index($status, $pdo, $event, $user, $loader, $twig)
    {
        if ($status === true) {
            echo $twig->render('home.html' , array(
                'text' => 'todo', 
                'request' => '/Todo/index',
                'Logout' => 'Logout',
                'method' => '/Login/Logout'
            )); 
        } else {
            echo $twig->render('home.html' , array(
            'text' => 'sign in', 
            'request' => '/Login/login'
        )); 
        }
    }
}
?>