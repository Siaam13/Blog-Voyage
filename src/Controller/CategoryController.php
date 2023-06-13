<?php

namespace App\Controller;

use App\Model\CategoryModel;
use App\Model\ArticleModel;

class CategoryController {
    public function index()
    {
        // Instanciation de la classe de modèle CategoryModel
        $categoryModel = new CategoryModel();

        // Récupération de toutes les catégories
        $categories = $categoryModel->getAllCategories();

        // Affichage : inclure le template
        $template = 'category';
        include TEMPLATE_DIR . '/base.phtml';
    }

    

    // public function searchArticlesByCategory($request, $response)
    // {
    //     $categoryModel = new CategoryModel();
    //     $articleModel = new ArticleModel();
    
    //     // Récupérer l'ID de la catégorie depuis la requête
    //     $categoryId = $request->getParam('categoryId');
    
    //     // Récupérer le terme de recherche depuis la requête
    //     $searchTerm = $request->getBodyParam('search');
    
    //     // Récupérer les articles correspondants à la catégorie et au terme de recherche
    //     $articles = $articleModel->searchArticlesByCategory($categoryId, $searchTerm);
    
    //     // Retourner les articles au format JSON
    //     return $response->withJson($articles);
    // }
    


}
    
