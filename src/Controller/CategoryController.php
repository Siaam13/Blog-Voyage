<?php


namespace App\Controller;

use App\Model\CategoryModel;

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
}
