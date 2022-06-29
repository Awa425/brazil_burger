<?php

namespace App\Entity;

use DateTime;
use App\Entity\Personne;
use App\Controller\EmailValider;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Mime\Email;
use App\Repository\UserRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "type", type: "string")]
#[ORM\DiscriminatorMap(["client" => "Client", "gestionnaire" => "Gestionnaire"])]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(
    collectionOperations: [
        'get',
        'post',
        'VALIDMAIL' => [
            'method' => 'PATCH',
            'path' => 'user/valide/{token}',
            'deserialize' => false,
            'controller' => EmailValider::class
        ]
    ]
)]

class User extends Personne implements UserInterface, PasswordAuthenticatedUserInterface
{

    #[Assert\Email(message: "Le mail '{{ value }}' est invalide.")]
    #[ORM\Column(type: 'string', length: 180, unique: true)]
    #[Groups(["all"])]
    protected $email;

    #[ORM\Column(type: 'json')]
    protected $roles = [];

    #[ORM\Column(type: 'string')]
    protected $password;

    #[ORM\Column(type: 'boolean')]
    private $isEnable;

    #[ORM\Column(type: 'datetime')]
    private $expireAt;

    #[ORM\Column(type: 'string', length: 255)]
    private $token;

    public function __construct()
    {
        $this->generateToken();
        $this->isEnable = false;
        $table = get_called_class();
        $table = explode("\\", $table);
        $table = strtoupper($table[2]);
        $this->roles[] = "ROLE_" . $table;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_VISITEUR';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function generateToken()
    {
        $this->expireAt = new \DateTime('+1 day');
        $this->token = rtrim(strtr(base64_encode(random_bytes(128)), '+/', '-_'), '=');
    }

    public function isIsEnable(): ?bool
    {
        return $this->isEnable;
    }

    public function setIsEnable(bool $isEnable): self
    {
        $this->isEnable = $isEnable;

        return $this;
    }

    public function getExpireAt(): ?\DateTimeInterface
    {
        return $this->expireAt;
    }

    public function setExpireAt(\DateTimeInterface $expireAt): self
    {
        $this->expireAt = $expireAt;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }
}
