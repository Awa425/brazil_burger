<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "descrim", type: "string")]
#[ORM\DiscriminatorMap(
    [
        "burger" => "Burger",
        "menu" => "Menu",
        "fritte" => "Fritte",
        "boisson" => "Boisson",
    ]
)]
#[ORM\Entity(repositoryClass: ProduitRepository::class)]
#[ApiResource()]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    // #[Groups(["simple", "all"])]
    protected $id;

    // #[Groups(["simple","all"])]
    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    protected $nom;


    // #[ORM\Column(type: 'string', length: 50, nullable: true)]
    // protected $type;

    #[Groups(["simple", "all"])]
    #[ORM\Column(type: 'float', nullable: true)]
    protected $prix;

    // #[Groups(["simple", "all"])]
    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    protected $image;

    #[ORM\Column(type: 'boolean', nullable: true)]
    protected $etat = true;

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





    // public function getType(): ?string
    // {
    //     return $this->type;
    // }

    // public function setType(?string $type): self
    // {
    //     $this->type = $type;

    //     return $this;
    // }

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

    public function isEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }
}
