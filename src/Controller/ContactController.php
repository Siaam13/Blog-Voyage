<?php

namespace App\Controller;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;


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

            // envoi du mail
            $transport = Transport::fromDsn(MAILER_DSN);
            $mailer = new Mailer($transport);
            //Démarrage de la tamporisation de sortie
            ob_start();
            //Inclusion du template d email(le code html est stocké dans le tampon de sortie)
            include "../templates/mail_contact.phtml";

            //On récupère le contenue du tampon de sortie dans la 
            $html =ob_get_clean();

            $objEmail = (new Email())
            ->from($email)
            ->to('you@example.com')
            ->subject('Nouveau message :'. $subject)
            ->text('Sending emails is fun again!')
            ->html($html);

            $mailer->send($objEmail);

            $response['success'] = 'Votre email a bien été envoyé';
        }
        else {
            $response['errors'] = $errors;
        }
 
 
         // Réponse au client
         echo json_encode($response);
    }

}