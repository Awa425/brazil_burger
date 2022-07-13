<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

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
    #[Groups(["burger:read"])]
    protected $id;

    // #[Groups(["simple","all"])]
    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    #[Groups(["burger:read"])]
    protected $nom;

    #[ORM\Column(type: 'float', nullable: true)]
    #[Groups(["burger:read"])]
    protected $prix;

    #[SerializedName('image')]
    protected $pathFile;

    #[ORM\Column(type: 'boolean', nullable: true)]
    #[Groups(["burger:read"])]
    protected $etat = true;

    #[ORM\Column(type: 'blob', nullable: true)]
    #[Groups(["burger:read"])]
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

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

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

    /**
     * Get the value of pathFile
     */ 
    public function getPathFile()
    {
        return $this->pathFile;
    }

    /**
     * Set the value of pathFile
     *
     * @return  self
     */ 
    public function setPathFile($pathFile)
    {
        $this->pathFile = $pathFile;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

 
}
