<?php
// AuthController.php
namespace App\Controller;

class AuthController
{
    public function displayRegisterForm()
    {
        // Affichage : inclure le template
        $template = 'register';
        include '../templates/base.phtml';
    }

    public function login()
    {
        // Affichage : inclure le template
        $template = 'login';
        include '../templates/base.phtml';
    }
}
