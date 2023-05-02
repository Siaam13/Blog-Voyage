<?php
// AuthController.php
namespace App\Controller;
use App\Model\UserModel;

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

    public function processLogin()
    {
        // Vérifier si le formulaire a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            // Récupérer les données du formulaire
            $username = $_POST['username'];
            $password = $_POST['password'];
    
            // Valider les données (exemple basique)
            // ...
    
            // Vérifier l'identifiant et le mot de passe dans la base de données
            $userModel = new UserModel();
            $user = $userModel->getUserByUsername($username);
            if (!$user || !password_verify($password, $user['password'])) {
                // Afficher un message d'erreur si l'utilisateur n'existe pas ou si le mot de passe est incorrect
                $flashMessage = "Le nom d'utilisateur ou le mot de passe est incorrect.";
                $template = 'login';
                include '../templates/base.phtml';
                exit;
            }
    
            // Stocker les informations sur l'utilisateur connecté dans les sessions
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'firstname' => $user['firstname'],
                'lastname' => $user['lastname']
            ];
    
            // Rediriger l'utilisateur vers la page d'accueil
            header('Location: ' . constructUrl('home'));
            exit;
    
        } else {
            // Si la méthode HTTP n'est pas POST, afficher la page de connexion
            $template = 'login';
            include '../templates/base.phtml';
            exit;
        }
    }

}