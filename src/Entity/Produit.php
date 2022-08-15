<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints\Cascade;

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
#[ApiResource(
    collectionOperations: [
        "get" => [
            'normalization_context' => ['groups' => ['produits:read']],
        ],
        "post"
    ]
)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['commande:writes',"burger:read",'commande:write',"menu:read" ,"catalogue:read",'tailleBoisson:read','burgerSubresource:read','burgerMenu:read','boisson:read','produits:read','lire:commande','itemCommande:read','zone:read'])]
    protected $id;

    // #[Groups(["simple","all"])]
    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    #[Groups(["burger:read",'fritte:write' ,"catalogue:read", "menu:read","tailleBoisson:read","tailleSubressource:read",'burgerSubresource:read','burgerMenu:read','ligneCommande:write',
        'boisson:write','boisson:read', 'commande:read','produits:read','itemCommande:read','commande:write','clentsSubressource:read','commande:writes','zone:read'])]
    protected $nom;

    #[ORM\Column(type: 'float', nullable: true)]
    #[Groups(["burger:read",'fritte:write' ,"menu:read" ,"catalogue:read",'burgerSubresource:read','burgerMenu:read','boisson:read','produits:read','tailleBoisson:read','commande:writes'])]
    protected $prix;

    // #[SerializedName('image')]
    #[Groups(['boisson:write','fritte:write','commande:read'])]
    protected $pathFile;

    #[ORM\Column(type: 'boolean', nullable: true)]
    #[Groups(["burger:read", "menu:read",'produits:read'])]
    protected $etat = true;

    #[ORM\Column(type: 'blob', nullable: true)]
    #[Groups(["burger:read" ,"catalogue:read",'commande:write' ,'itemCommande:read','menu:read','tailleBoisson:read','tailleSubressource:read','burgerSubresource:read','burgerMenu:read','boisson:write','boisson:read','produits:read','itemCommande:read','commande:writes'])]
    private $image;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    #[Groups(["burger:read", 'menu:read', "catalogue:read",'burgerMenu:read','produits:read'])]
    protected $type;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: LigneCommande::class)]
    private $ligneCommandes;

    public function __construct()
    {
        $this->ligneCommandes = new ArrayCollection();
    }

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
        return (is_resource($this->image)) ? utf8_encode(base64_encode(stream_get_contents( ($this->image) ) ) ) : $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }



 

    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return Collection<int, LigneCommande>
     */
    public function getLigneCommandes(): Collection
    {
        return $this->ligneCommandes;
    }

    public function addLigneCommande(LigneCommande $ligneCommande): self
    {
        if (!$this->ligneCommandes->contains($ligneCommande)) {
            $this->ligneCommandes[] = $ligneCommande;
            $ligneCommande->setProduit($this);
        }

        return $this;
    }

    public function removeLigneCommande(LigneCommande $ligneCommande): self
    {
        if ($this->ligneCommandes->removeElement($ligneCommande)) {
            // set the owning side to null (unless already changed)
            if ($ligneCommande->getProduit() === $this) {
                $ligneCommande->setProduit(null);
            }
        }

        return $this;
    }
}
