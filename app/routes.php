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

    'category' => [
        'path' => '/category',
        'controller' => 'CategoryController',
        'method' => 'index'
    ],
  
    
    'signup' => [
        'path' => '/signup',
        'controller' => 'UserController',
        'method' => 'signup'
    ],

    'login' => [
        'path' => '/login',
        'controller' => 'AuthController',
        'method' => 'login'
    ],

    'my-account' => [
        'path' => '/my-account',
        'controller' => 'UserController',
        'method' => 'myAccount'
    ],

    'update' => [
        'path' => '/my-account/update',
        'controller' => 'UserController',
        'method' => 'update'
    ],


    'admin_dashboard' => [
        'path' => '/admin',
        'controller' => 'Admin\\AdminDashboardController',
        'method' => 'dashboard'
    ],
    'admin_article_new' => [
        'path' => '/admin/article/new',
        'controller' => 'Admin\\AdminArticleController',
        'method' => 'new'
    ],
    'admin_article_update' => [
        'path' => '/admin/article/update',
        'controller' => 'Admin\\AdminArticleController',
        'method' => 'update' 
    ],

    'admin_article_delete' => [
        'path' => '/admin/article/delete',
        'controller' => 'Admin\\AdminArticleController',
        'method' => 'delete'
    ],

    'admin_manage_articles' => [
        'path' => '/admin/articles',
        'controller' => 'Admin\\AdminArticleController',
        'method' => 'indexEdit'
    ],

    // 'admin_article_index' => [
    //     'path' => '/admin/article',
    //     'controller' => 'Admin\\AdminArticleController',
    //     'method' => 'indexEdit'
    // ],

    'logout' => [
        'path' => '/logout',
        'controller' => 'AuthController',
        'method' => 'logout'
    ],

   
    
    // 'category-search' => [
    //     'path' => '/category/search',
    //     'controller' => 'CategoryController',
    //     'method' => 'searchArticlesByCategory',
    // ],
    

    
    

];

return $routes;