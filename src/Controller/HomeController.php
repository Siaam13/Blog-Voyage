<?php 

namespace App\Controller;
require_once '../src/Service/UserSession.php';


// Import de classes
use App\Model\ArticleModel;

class HomeController {
    
    public function index() 
    {
        // Sélection des 3 derniers articles
        $articleModel = new ArticleModel();
        $articles = $articleModel->getAllArticles();

        // Affichage : inclusion du template
        $template = 'home';
        include TEMPLATE_DIR .'/base.phtml';
    }
}