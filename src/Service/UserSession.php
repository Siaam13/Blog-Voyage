<?php 

namespace App\Service;

use App\Entity\User;
use App\Service\Enum\UserRole;

class UserSession {

    const SESSION_KEY = 'user';

    public function __construct()
    {
        // Si la session n'est pas encore démarrée...
        if (session_status() == PHP_SESSION_NONE) {

            // ... on la démarre !
            session_start();
        }
    }

    public function register(User $user)
    {
        $_SESSION[self::SESSION_KEY] = $user;
    }

    public function getUser()
    {
        return $_SESSION[self::SESSION_KEY] ?? null;
    }

    public function isAdmin(): bool 
    {
        // Si l'utilisateur n'est pas connecté
        if (!isset($_SESSION[self::SESSION_KEY])) {
            return false;
        }


        // Est-ce que le rôle de l'utilisateur connecté est le rôle ADMIN ?
        return $_SESSION[self::SESSION_KEY]->getRole() == UserRole::ADMIN;
    }
}
