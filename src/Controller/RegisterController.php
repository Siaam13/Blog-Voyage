<?php

namespace App\Controller;

use App\Model\UserModel;
use App\Core\Controller;

class RegisterController extends Controller
{
    // public function displayRegisterForm()
    // {
    //     $this->render('register');
    // }

    public function processRegister()
    {
        // Récupérer les données du formulaire
        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $country = $_POST['country'];
        $address = $_POST['address'];
        $postal_code = $_POST['postal_code'];
        $password = $_POST['password'];

        // Valider les données (exemple basique)
        // ...

        // Créer et enregistrer l'utilisateur
        $userModel = new UserModel();
        $userModel->createUser($username, $firstname, $lastname, $email, $country, $address, $postal_code, $password);

        // Rediriger vers la page de connexion
        header('Location: ' . BASE_URL . '/login');
        exit;
    }
}
