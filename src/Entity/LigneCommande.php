<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LigneCommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: LigneCommandeRepository::class)]
#[ApiResource(
    collectionOperations: [
        "get" ,
        "post" => [
            'denormalization_context' => ['groups' => ['ligneCommande:write']]
        ]
    ]
)]
class LigneCommande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['ligneCommande:write'])]
    private $id;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['commande:write','ligneCommande:write','itemCommande:read','lire:commande','commande:writes','clentsSubressource:read','itemCommande:write'])]
    private $quanite;

    #[ORM\OneToMany(mappedBy: 'ligneCommande', targetEntity: LignecommandeTailleboisson::class, cascade:["persist"])]
    private $lignecommandeTailleboissons;

    #[ORM\ManyToOne(targetEntity: Commande::class, inversedBy: 'ligneCommande')]
    private $commande;

    #[ORM\ManyToOne(targetEntity: Produit::class, inversedBy: 'ligneCommandes')]
    #[Groups('commande:writes','itemCommande:read','ligneCommande:write','commande:write','clentsSubressource:read')]
    private $produit;

    public function __construct()
    {
        $this->lignecommandeTailleboissons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuanite(): ?int
    {
        return $this->quanite;
    }

    public function setQuanite(?int $quanite): self
    {
        $this->quanite = $quanite;

        return $this;
    }

    /**
     * @return Collection<int, LignecommandeTailleboisson>
     */
    public function getLignecommandeTailleboissons(): Collection
    {
        return $this->lignecommandeTailleboissons;
    }

    public function addLignecommandeTailleboisson(LignecommandeTailleboisson $lignecommandeTailleboisson): self
    {
        if (!$this->lignecommandeTailleboissons->contains($lignecommandeTailleboisson)) {
            $this->lignecommandeTailleboissons[] = $lignecommandeTailleboisson;
            $lignecommandeTailleboisson->setLigneCommande($this);
        }

        return $this;
    }

    public function removeLignecommandeTailleboisson(LignecommandeTailleboisson $lignecommandeTailleboisson): self
    {
        if ($this->lignecommandeTailleboissons->removeElement($lignecommandeTailleboisson)) {
            // set the owning side to null (unless already changed)
            if ($lignecommandeTailleboisson->getLigneCommande() === $this) {
                $lignecommandeTailleboisson->setLigneCommande(null);
            }
        }

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }


}
