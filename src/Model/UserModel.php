<?php

namespace App\Model;

use App\Core\AbstractModel;

class UserModel extends AbstractModel
{
    /**
     * Insert a new user into the database
     */
    public function createUser(string $username, string $firstname, string $lastname, string $email, string $country, string $address, string $postal_code, string $password): void
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = 'INSERT INTO users (username, firstname, lastname, email, country, address, postal_code, password) VALUES (:username, :firstname, :lastname, :email, :country, :address, :postal_code, :password)';

        $this->db->prepareAndExecute($sql, [
            'username' => $username,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'country' => $country,
            'address' => $address,
            'postal_code' => $postal_code,
            'password' => $hashedPassword,
        ]);
    }
}
