<?php

namespace App\Model;

use App\Entity\User;
use App\Core\AbstractModel;
use PDO;

class UserModel extends AbstractModel {
    
    public function createUser(User $user): void
    {
        $hashedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);
    
        $sql = 'INSERT INTO users (username, firstname, lastname, email, country, address, postal_code, password) VALUES (:username, :firstname, :lastname, :email, :country, :address, :postal_code, :password)';
    
        $this->db->prepareAndExecute($sql, [
            'username' => $user->getUsername(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'email' => $user->getEmail(),
            'country' => $user->getCountry(),
            'address' => $user->getAddress(),
            'postal_code' => $user->getPostalCode(),
            'password' => $hashedPassword,
        ]);
    }
    public function getUserByUsername(string $username)
    {
        $sql = 'SELECT *
                FROM users
                WHERE username = :username';

        $result = $this->db->getOneResult($sql, ['username' => $username]);

        if (!$result) {
            return null;
        }

        return new User($result);
    }

    public function getUserByEmail(string $email)
    {
        $sql = 'SELECT *
                FROM users
                WHERE email = :email';

        $result = $this->db->getOneResult($sql, ['email' => $email]);

        if (!$result) {
            return null;
        }

        return new User($result);
    }

    public function getUserById(int $id): ?User
{
    $sql = 'SELECT *
            FROM users
            WHERE id = :id';

    $result = $this->db->getOneResult($sql, ['id' => $id]);

    if (!$result) {
        return null;
    }

    return new User($result);
}

public function updateUser(User $user , bool $changePassword = false): void
{
    $sql = 'UPDATE users SET username = :username, firstname = :firstname, lastname = :lastname, email = :email, country = :country, address = :address, postal_code = :postal_code';
    $parameters = [
        'id' => $user->getId(),
        'username' => $user->getUsername(),
        'firstname' => $user->getFirstname(),
        'lastname' => $user->getLastname(),
        'email' => $user->getEmail(),
        'country' => $user->getCountry(),
        'address' => $user->getAddress(),
        'postal_code' => $user->getPostalCode(),
    ];

    // Mettre à jour le mot de passe uniquement si l'utilisateur a fourni un nouveau mot de passe
    if ($changePassword) {
        $sql .= ', password = :password';
        $parameters['password'] = password_hash($user->getPassword(), PASSWORD_DEFAULT);
    }

    $sql .= ' WHERE id = :id';

    $this->db->prepareAndExecute($sql, $parameters);
}


}
