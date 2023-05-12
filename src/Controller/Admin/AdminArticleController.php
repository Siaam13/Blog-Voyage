<?php 

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Category;
use App\Core\Database;
use App\Model\ArticleModel;
use App\Model\CategoryModel;
use \Exception;


class AdminArticleController {

    private $db; 

    public function __construct()
    {
        $this->db = new Database(); // Initialisez la propriété avec le gestionnaire de base de données
    }


    public function indexEdit()
    {
        $articleModel = new ArticleModel();
        $articles = $articleModel->getAllArticles();
    
        // Affichage du template des articles avec les liens de suppression
        $template = 'manage_articles';
        include TEMPLATE_DIR . '/admin/base_admin.phtml';
    }
    

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

            if (!$title) {
                $errors['title'] = 'Le champ "titre" est obligatoire';
            }

            if (!$content) {
                $errors['content'] = 'Le champ "contenu" est obligatoire';
            }

            // Validation de l'image si un fichier a été uploadé
            if (array_key_exists('image', $_FILES) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {

                // Validation du poids du fichier
                $filesize = filesize($_FILES['image']['tmp_name']);
                if ($filesize > MAX_UPLOAD_SIZE) {
                    $errors['image'] = 'Votre fichier excède 1 Mo.';
                }

                // Validation du type de fichier
                $allowedMimeTypes = ['image/jpeg', 'image/gif', 'image/png'];
                $mimeType = mime_content_type($_FILES['image']['tmp_name']);

                if (!in_array($mimeType, $allowedMimeTypes)) {
                    $errors['image'] = 'Type de fichier non autorisé';
                }
            }

            if (empty($errors)) {

                $filename = '';

                if (array_key_exists('image', $_FILES) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE) {

                    // Nettoyer le nom du fichier
                    $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    $basename = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);

                    // Slugification du nom du fichier (on supprime caractères spéciaux, accents, majuscules, espaces, etc)
                    $basename = slugify($basename);

                    // On ajoute une chaîne aléatoire pour éviter les conflits
                    $filename = $basename .sha1(uniqid(rand(),true)) . '.' . $extension;

                    // Copier le fichier temporaire dans notre dossier "images"
                    if (!file_exists('images')) {
                        mkdir('images');
                    }

                    move_uploaded_file($_FILES['image']['tmp_name'], 'images/'.$filename);
                }

                $article = new Article([
                    'title' => $title,
                    'content' => $content,
                    'category' => $categoryModel->getCategoryById($categoryId),
                    'image' => $filename
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






    public function update()
    {
        // Validation du paramètre id de l'URL
        if (!array_key_exists('id', $_GET) || !$_GET['id'] || !ctype_digit($_GET['id'])) {
            http_response_code(404);
            echo 'Article introuvable';
            exit; // Fin de l'exécution du script PHP
        }
    
        $id = $_GET['id'];
        $articleModel = new ArticleModel();
        $article = $articleModel->getOneArticle($id);
    
        // Vérifier si l'article existe
        if (!$article) {
            throw new Exception("Cet article n'existe pas.");
        }
    
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAllCategories();
    
        // Si le formulaire est soumis
        if (!empty($_POST)) {
            // Récupérer les données du formulaire
            $title = trim(strip_tags($_POST['title']));
            $content = trim(strip_tags($_POST['content']));
            $categoryId = (int) $_POST['category'];
    
            // Valider les données
            $errors = [];
    
            if (!$title) {
                $errors['title'] = 'Le champ "titre" est obligatoire';
            }
    
            if (!$content) {
                $errors['content'] = 'Le champ "contenu" est obligatoire';
            }
    
            // Mettre à jour l'article si les données sont valides
            if (empty($errors)) {
                $article->setTitle($title);
                $article->setContent($content);
                $article->setCategory($categoryModel->getCategoryById($categoryId));
    
                $articleModel->updateArticle($article);
    
                // Ajout d'un message flash en session
                $_SESSION['flash'] = 'Article mis à jour avec succès.';
    
                // Redirection
                header('Location: ' . constructUrl('admin_manage_articles'));
                exit;
            }
        }
    
        // Affichage du template d'édition avec les données de l'article
        $template = 'article_update';
        include TEMPLATE_DIR . '/admin/base_admin.phtml';
    }


public function delete()
{
       // Validation du paramètre id de l'URL
       if (!array_key_exists('id', $_GET) || !$_GET['id'] || !ctype_digit($_GET['id'])) {
        http_response_code(404);
        echo 'Article introuvable';
        exit; // Fin de l'exécution du script PHP
    }

    $id = $_GET['id'];
    $articleModel = new ArticleModel();
    $article = $articleModel->getOneArticle($id);

    // Vérifier si l'article existe
    if (!$article) {
        throw new Exception("Cet article n'existe pas.");
    }
    

    // Supprimer l'article 
    
    $articleModel->deleteArticle($article);
   


    // Ajout d'un message flash en session
    $_SESSION['flash'] = 'Article supprimé avec succès.';

    // Redirection vers la liste des articles
    header('Location: ' . constructUrl('admin_manage_articles'));
    exit;
}


}