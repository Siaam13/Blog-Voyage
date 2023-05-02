<?php

namespace App\Model;


use App\Core\AbstractModel;
use PDO;

class UserModel extends AbstractModel
{
    
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

    public function getUserByEmail(string $email): ?array
{

    // var_dump('getUserByEmail called');
    $stmt = $this->db->getOneResult('SELECT * FROM users WHERE email = :email LIMIT 1');
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        return null;
    }

    return $user;
}

public function getUserByUsername(string $username)
{
    $sql = 'SELECT * FROM users WHERE username = ? LIMIT 1';
    $values = [$username];
    $result = $this->db->prepareAndExecute($sql, $values)->fetch();

    return $result;
}


}
