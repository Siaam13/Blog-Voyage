<?php

// ContactController.php
namespace App\Controller;

class ContactController {

    public function showForm()
    {
        // Affichage du formulaire
        $template = 'contact';
        include '../templates/base.phtml';
    }

    public function sendForm()
    {

         // Initialisation d'un tableau pour la réponse
         $response = [];

         // Récupération des données du formulaire
         $email = trim($_POST['email']);
         $subject = trim($_POST['subject']);
         $content = trim($_POST['content']);
 
         // Validation des données
         if (!$email) {
            $errors['email'] = 'Le champ "email" est obligatoire';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Le format du mail est invalide';
        }

        if (!$subject) {
            $errors['subject'] = 'Le champ "sujet" est obligatoire';
        }

        if (strlen($content) < 10 || strlen($content) > 600 ) {
            $errors['content'] = 'Le champ "message" doit comporter entre 10 et 600 caractères';
        } 


        // Envoi du mail si pas d'erreurs
        if (empty($errors)) {

            // @TODO envoi du mail

            $response['success'] = 'Votre email a bien été envoyé';
        }
        else {
            $response['errors'] = $errors;
        }
 
 
         // Réponse au client
         echo json_encode($response);
    }

}