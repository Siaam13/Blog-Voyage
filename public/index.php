<?php 


// Inclusion de l'autoloader de composer
require '../vendor/autoload.php';

// Inclusion de la config
require '../app/config.php';

// Inclusion des dépendances
require_once '../src/Controller/UserController.php';
require_once '../lib/functions.php';

use App\Service\UserSession;

// Démarrage de la session
session_start();


error_reporting(E_ALL);
ini_set('display_errors', 1);


// Récupération du path de l'URL
$path = str_replace(BASE_URL, '', $_SERVER['REQUEST_URI']);
$path = str_replace('/index.php', '', $path); 
$path = explode('?', $path)[0];

if ($path == '') {
    $path = '/';
}


/**
 * Check Point Pages Admin : est-ce que je suis sur une page réservée à l'administrateur ?
 * -> ATTENTION : on suppose que toutes les routes de l'admin commencent bien par "/admin"
 */
if (strpos($path, '/admin') === 0) {
    $userSession = new UserSession();
    if (!$userSession->isAdmin()) {
        http_response_code(404);
        echo 'Page introuvable (admin interdit)';
        exit;
    }
}

////////////////
// ROUTING    //
////////////////

// @TODO créer une classe Router pour isoler le routing

// On va chercher dans le fichier routes.php le tableau de routes
$routes = require '../app/routes.php';

// On crée une constante ROUTES pour avoir accès à nos routes partout
define('ROUTES', $routes);

$className = null;
$method = null;

foreach ($routes as $route) {
    if ($path == $route['path']) {
        $className = $route['controller'];
        $method = $route['method'];
        break;
    }
}

// Si on n'a pas trouvé le path dans les routes... => erreur 404
if ($className == null) {
    http_response_code(404);
    echo 'Erreur 404 : Page introuvable';
    exit;
}

// Ici j'ai trouvé ma route et le contrôleur qui va avec ! => on inclut le controller

try {
    $className = "App\\Controller\\$className";
    $controller = new $className(); // Par exemple pour l'accueil "App\\Controller\\HomeControler"
    $controller->$method();
}
catch(Exception $exception) {
    echo $exception->getMessage();
    exit;
}

// $controller = 'App\Controller\\' . $route['controller'];
// $controllerInstance = new $controller;






        