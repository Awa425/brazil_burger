<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "descrim", type: "string")]
#[ORM\DiscriminatorMap(["burger" => "Burger", "menu" => "Menu", "complement" => "Complement"])]
#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected $id;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    protected $nom;


    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    protected $type;

    #[ORM\Column(type: 'float', nullable: true)]
    protected $prix;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }





    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
