<?php 

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Category;
use App\Model\ArticleModel;
use App\Model\CategoryModel;

class AdminArticleController {

    public function new()
    {
        // Initialisations
        $errors = [];
        $title = '';
        $content = '';
        $categoryId = null;

        $categoryModel = new CategoryModel();

        if (!empty($_POST)) {

            $title = trim(strip_tags($_POST['title']));
            $content = trim(strip_tags($_POST['content']));
            $categoryId = (int) $_POST['category'];

            var_dump($categoryId);

            if (!$title) {
                $errors['title'] = 'Le champ "titre" est obligatoire';
            }

            if (!$content) {
                $errors['content'] = 'Le champ "contenu" est obligatoire';
            }

            if (empty($errors)) {

                $article = new Article([
                    'title' => $title,
                    'content' => $content,
                    'category' => $categoryModel->getCategoryById($categoryId)
                ]);

                $articleModel = new ArticleModel();
                $articleModel->addArticle($article);

                // Ajout d'un message flash en session
                $_SESSION['flash'] = 'Article créé avec succès.';

                // Redirection
                header('Location: ' . constructUrl('admin_dashboard'));
                exit;
            }
        }

        // Sélection des catégories
        $categories = $categoryModel->getAllCategories();

        // Affichage du template
        $template = 'article_new';
        include TEMPLATE_DIR . '/admin/base_admin.phtml';
    }
}