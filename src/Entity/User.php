<?php 

// Déclaration du namespace
namespace App\Entity;

use DateTimeImmutable;
use App\Service\Enum\UserRole; // Ajout de l'importation de la classe UserRole


// Import de classe

//Declaration de la classe User
class User {

    // Propriétés
    private int $id;
    private string $username;
    private string $firstname;
    private string $lastname;
    private string $email;
    private string $country;
    private string $address;
    private string $postal_code;

    private string $password;
    private DateTimeImmutable $created_at;

    private UserRole $role;

    // Constructeur
    public function __construct(array $data = [])
{
    $this->id = 0; // Valeur par défaut pour l'id
    $this->username = '';
    $this->firstname = '';
    $this->lastname = '';
    $this->email = '';
    $this->country = '';
    $this->address = '';
    $this->postal_code = '';
    $this->password = '';
    $this->created_at = new DateTimeImmutable();

    foreach ($data as $propertyName => $value) {
        $setter = 'set' . ucfirst($propertyName);
        if (method_exists($this, $setter)) {
            $this->$setter($value);
        }
    }
}   
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;
        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function getPostalCode(): string
    {
        return $this->postal_code;
    }

    public function setPostalCode(string $postal_code): self
    {
        $this->postal_code = $postal_code;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(string|DateTimeImmutable $created_at): self
    {
        if (is_string($created_at)) {
            $created_at = new DateTimeImmutable($created_at);
        }
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * Get the value of role
     */
    public function getRole(): UserRole
    {
        return $this->role;
    }

    /**
     * Set the value of role
     */
    public function setRole(string|UserRole $role): self
    {
        if (is_string($role)) {
            $role = UserRole::from($role);
        }

        $this->role = $role;

        return $this;
    }

}
