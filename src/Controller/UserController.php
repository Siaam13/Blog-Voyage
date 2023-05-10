<?php

namespace App\Controller;

use App\Entity\User;
use App\Model\UserModel;
use App\Service\UserSession;
use App\Service\Enum\UserRole;

class UserController {

    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function signup()
{
    // Si le formulaire est soumis
    if (!empty($_POST)) {

        // 1. Récupération des données du formulaire
        $username = strip_tags(trim($_POST['username']));
        $firstname = strip_tags(trim($_POST['firstname']));
        $lastname = strip_tags(trim($_POST['lastname']));
        $email = strip_tags(trim($_POST['email']));
        $country = strip_tags(trim($_POST['country']));
        $address = strip_tags(trim($_POST['address']));
        $postal_code = strip_tags(trim($_POST['postal_code']));
        $password = $_POST['password'];
        $password_confirm = $_POST['password-confirm'];

        // 2. Validation du formulaire
        $errors = $this->validateForm(
            $username,
            $firstname,
            $lastname,
            $email,
            $country,
            $address,
            $postal_code,
            $password,
            $password_confirm
        );

        // Si il n'y a pas d'erreur... 
        if(empty($errors)) {

            // Vérifier si l'utilisateur existe déjà avec cet email ou ce nom d'utilisateur
            $user = $this->userModel->getUserByUsername($username);
            if ($user) {
                $errors['username'] = 'Ce nom d\'utilisateur existe déjà';
            }

            $user = $this->userModel->getUserByEmail($email);
            if ($user) {
                $errors['email'] = 'Un compte existe déjà avec cet email';
            }

            // Si l'utilisateur n'existe pas encore
            if (empty($errors)) {
                $hash = password_hash($password, PASSWORD_DEFAULT);

                // Créer l'objet utilisateur
                $user = new User([
                    'username' => $username,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'email' => $email,
                    'country' => $country,
                    'address' => $address,
                    'postal_code' => $postal_code,
                    'password' => $hash,
                    'role' => UserRole::USER
                ]);

                // Ajout du nouvel utilisateur dans la base de données
                $this->userModel->createUser($user);

                // Ajout d'un message flash en session
                $_SESSION['flash'] = 'Votre compte a été créé avec succès.';

                // Redirection vers l'index.php mais sans les données du formulaire
                header('Location: ' . constructUrl('home'));
                exit;
            }

        }

    }

    // Affichage du template
    $template = 'register';
    include TEMPLATE_DIR .'/base.phtml';
}

private function validateForm(
    string $username,
    string $firstname,
    string $lastname,
    string $email,
    string $country,
    string $address,
    string $postal_code,
    string $password,
    string $passwordConfirm
)
{
    // On initialise un tableau, on stockera les messages d'erreur dedans
    $errors = [];

    // Si le champ "username" n'est pas rempli...
    if(!$username) {
        $errors['username'] = 'Veuillez remplir le champ "Nom d\'utilisateur"';
    } elseif ($this->userModel->getUserByUsername($username)) {
        $errors['username'] = 'Un compte existe déjà avec ce nom d\'utilisateur';
    }

    // Si le champ "firstname" n'est pas rempli...
    if(!$firstname) {
        $errors['firstname'] = 'Veuillez remplir le champ "Prénom"';
    }
    
    // Si le champ "lastname" n'est pas rempli...
    if(!$lastname) {
        $errors['lastname'] = 'Veuillez remplir le champ "Nom"';
    }

        // Validation de l'email
        if(!$email) {
            $errors['email'] = 'Veuillez remplir le champ "Email"';
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'Veuillez remplir un email valide';
        } elseif($this->userModel->getUserByEmail($email)) {
            $errors['email'] = 'Un compte existe déjà avec cet email';
        }
    
        // Validation du champ "country"
        if(!$country) {
            $errors['country'] = 'Veuillez remplir le champ "Pays"';
        }
        
        // Validation du champ "address"
        if(!$address) {
            $errors['address'] = 'Veuillez remplir le champ "Adresse"';
        }
        
        // Validation du champ "postal_code"
        if(!$postal_code) {
            $errors['postal_code'] = 'Veuillez remplir le champ "Code postal"';
        }
    
        // Validation du champ "password"
        if(strlen($password) < 8) {
            $errors['password'] = 'Le mot de passe doit comporter au moins 8 caractères';
        } elseif ($password != $passwordConfirm) {
            $errors['password-confirm'] = 'La confirmation ne correspond pas';
        }
    
        // On retourne le tableau d'erreurs
        return $errors;
    }

    public function myAccount()
    {
        // Vérifier que l'utilisateur est connecté
        $userSession = new UserSession();
        if (!$userSession->getUser()) {
            header('Location: ' . constructUrl('login'));
            exit;
        }
    
        // Récupérer l'utilisateur depuis la session
        $user = $userSession->getUser();
    
        // Affichage du template
        $template = 'my-account';
        include TEMPLATE_DIR .'/base.phtml';
    }
    
    

public function update()
{
    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['user'])) {
        header('Location: ' . constructUrl('login'));
        exit;
    }

    // Récupération des données de l'utilisateur connecté
    $userId = $_SESSION['user']->getId();
    $user = $this->userModel->getUserById($userId);

    // Si le formulaire est soumis
    if (!empty($_POST)) {

        // 1. Récupération des données du formulaire
        $username = strip_tags(trim($_POST['username']));
        $firstname = strip_tags(trim($_POST['firstname']));
        $lastname = strip_tags(trim($_POST['lastname']));
        $email = strip_tags(trim($_POST['email']));
        $country = strip_tags(trim($_POST['country']));
        $address = strip_tags(trim($_POST['address']));
        $postal_code = strip_tags(trim($_POST['postal_code']));
        $password = isset($_POST['password']) ? $_POST['password'] : null;
        $passwordConfirm = isset($_POST['password-confirm']) ? $_POST['password-confirm'] : null;


        // 2. Validation du formulaire
        $errors = $this->validateForm(
            $username,
            $firstname,
            $lastname,
            $email,
            $country,
            $address,
            $postal_code,
            $password,
            $passwordConfirm
        );

        // Si il n'y a pas d'erreur... 
        if(empty($errors)) {

            // Vérifier si l'utilisateur existe déjà avec cet email ou ce nom d'utilisateur
            $userByUsername = $this->userModel->getUserByUsername($username);
            if ($userByUsername && $userByUsername->getId() != $userId) {
                $errors['username'] = 'Ce nom d\'utilisateur existe déjà';
            }

            $userByEmail = $this->userModel->getUserByEmail($email);
            if ($userByEmail && $userByEmail->getId() != $userId) {
                $errors['email'] = 'Un compte existe déjà avec cet email';
            }

            // Si l'utilisateur n'existe pas encore
            if (empty($errors)) {
                // Mettre à jour l'objet utilisateur
                $user
                    ->setUsername($username)
                    ->setFirstname($firstname)
                    ->setLastname($lastname)
                    ->setEmail($email)
                    ->setCountry($country)
                    ->setAddress($address)
                    ->setPostalCode($postal_code);

                // Mettre à jour le mot de passe s'il a été renseigné
                if (!empty($password)) {
                    $user->setPassword($password);
                }

                // Mettre à jour l'utilisateur dans la base de données
                $this->userModel->updateUser($user);

                // Ajout d'un message flash en session
                $_SESSION['flash'] = 'Vos informations ont été mises à jour.';

                // Redirection vers la page "Mon compte"
                header('Location: ' . constructUrl('my-account'));
                exit;
            }

        }

    }

    // Affichage du template
    $template = 'my-account';
    include TEMPLATE_DIR . '/base.phtml';
}

}