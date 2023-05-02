<?php

namespace App\Controller;

use App\Core\Controller;

class LogoutController extends Controller
{
    public function logout()
    {
        // Déconnexion de l'utilisateur
        session_start();
        session_destroy();

        // Redirection vers la page d'accueil
        header('Location: ' . BASE_URL . '/');
        exit;
    }
}
