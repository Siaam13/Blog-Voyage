<?php

namespace App\Controller;

use App\Model\ArticleModel;
use App\Model\CommentModel;
use App\Service\UserSession;
    
    class ArticleController {
    
        public function index()
        {
            // Validation du paramètre id de l'URL
            if (!array_key_exists('id', $_GET) || !$_GET['id'] || !ctype_digit($_GET['id'])) {
                http_response_code(404);
                echo 'Article introuvable';
                exit; // Fin de l'exécution du script PHP
            }
        
            // Récupération du paramètre id de l'URL
            $idArticle = (int) $_GET['id'];
        
            $errors = [];
        
            // Instanciation des classes de modèles
            $articleModel = new ArticleModel();
            $commentModel = new CommentModel();
        
            // Traitement du formulaire d'ajout de commentaire
            if (!empty($_POST)) {
                // Vérification de la session utilisateur
                $userSession = new UserSession();
                $currentUser = $userSession->getUser();
                if (!$currentUser) {
                    // Utilisateur non connecté, redirection vers la page de connexion
                    header('Location: ' . constructUrl('login'));
                    exit;
                }
        
                // 1. Récupération des données du formulaire
                $username = $currentUser->getUsername();
                $content = $_POST['content'];
        
                // 2. Validation des données
                $errors = $this->validateCommentForm($username, $content);
        
                // 3. Traitements des données
                if (empty($errors)) {
                    // Insertion des données
                    $commentModel->addComment($username, $content, $idArticle, $currentUser->getId());
        
                    // Message flash
                    $_SESSION['flashbag'] = 'Votre commentaire a bien été ajouté';
        
                    // Redirection vers la page Article
                    header('Location: ' . constructUrl('article', ['id' => $idArticle]));
                    exit;
                }
            }
        
            // Récupération de l'article à afficher
            $article = $articleModel->getOneArticle($idArticle);
        
            // Vérification de l'existence de l'article
            if (!$article) {
                http_response_code(404);
                echo 'Article introuvable (id ' . $idArticle . ')';
                exit; // Fin de l'exécution du script PHP
            }
        
            // Sélection des commentaires associés à l'article pour les afficher
            $comments = $commentModel->getCommentsByArticleId($idArticle);
        
            // Récupérer le message flash le cas échéant
            if (array_key_exists('flashbag', $_SESSION) && $_SESSION['flashbag']) {
                $flashMessage = $_SESSION['flashbag'];
                $_SESSION['flashbag'] = null;
            }

            // Vérification de l'état de connexion de l'utilisateur
            $isLoggedIn = (new UserSession())->getUser() !== null;

        
            // Affichage : inclure le template
            $template = 'article';
            include TEMPLATE_DIR . '/base.phtml';
        }

        private function validateCommentForm(string $username, string $content)
        {
            $errors = [];

            if (!$username) {
                $errors['username'] = 'Le champ "pseudo" est obligatoire';
            }

            if (strlen($content) < 10) {
                $errors['content'] = 'Le commentaire doit comporter au moins 10 caractères';
            }

            return $errors;
        }


    }