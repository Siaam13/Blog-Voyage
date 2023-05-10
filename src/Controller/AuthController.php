<?php

namespace App\Controller;

use App\Model\UserModel;
use App\Service\UserSession;

class AuthController {

    public function login()
    {
        $error = null;

        // Si le formulaire est soumis...
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Récupération des données du formulaire
            $username = $_POST['username'];
            $password = $_POST['password'];

            // 1. Est-ce que les identifiants sont corrects ?
            $user = $this->checkCredentials($username, $password);

            if (!$user) {
                $error = 'Nom d\'utilisateur ou mot de passe incorrect.';
            }

            // Identifiants corrects
            else {

                // 2. Enregistrer l'utilisateur en session
               $userSession = new UserSession();
               $userSession->register($user);

                // Message flash de succès
                $_SESSION['flash'] = 'Content de te revoir ' . $user->getUsername();

                // Redirection vers la page d'accueil
                header('Location: ' . constructUrl('home'));
                exit;
            }
        }

        // Affichage du template
        $template = 'login';
        include TEMPLATE_DIR . '/base.phtml';
    }

    public function checkCredentials(string $username, string $password)
    {
        $userModel = new UserModel();
        $user = $userModel->getUserByUsername($username);

        if (!$user) {
            return false;
        }

        if (!password_verify($password, $user->getPassword())) {
            return false;
        }

        return $user;
    }

    public function logout()
    {
        // On efface les données enregistrées en session
        unset($_SESSION['user']);

        // Message flash
        $_SESSION['flash'] = 'Bye bye';

        // redirection
        header('Location: ' . constructUrl('home'));
        exit;
    }
}