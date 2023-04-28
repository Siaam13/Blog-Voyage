<?php

$routes = [
   
    'home' => [
        'path' => '/',
        'controller' => 'HomeController',
        'method' => 'index'
    ],
    'article' => [
        'path' => '/article',
        'controller' => 'ArticleController',
        'method' => 'index'
    ],
    'contact' => [
        'path' => '/contact',
        'controller' => 'ContactController',
        'method' => 'showForm'
    ],
    'ajax-send-contact-form' => [
        'path' => '/ajax-contact',
        'controller' => 'ContactController',
        'method' => 'sendForm'
    ],
    // 'register' => [
    //     'path' => '/register',
    //     'controller' => 'AuthController',
    //     'method' => 'register'

    // ],

    'register' => [
        'path' => '/register',
        'controller' => 'AuthController',
        'method' => 'displayRegisterForm'
    ],
    'process-register' => [
        'path' => '/process-register',
        'controller' => 'RegisterController',
        'method' => 'processRegister'
    ],

    'login' => [
        'path' => '/login',
        'controller' => 'AuthController',
        'method' => 'login'
    ],
    

];

return $routes;